<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Production;
use App\Category;
use App\ProductionCategory;
use App\ProductionSubCategory;
use App\Purchase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Auth;
use App\Store;
use App\Warehouse;
use App\ProductionRequests;
use Illuminate\Support\Facades\Input;
use App\RawMaterial;
class ProductionController extends Controller
{

	public function create(){
		$category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();

		return view('production.create',compact('category'));
	}


	public function getcolordata($id){
		$pcategory = ProductionCategory::wherename('Color')->first();		
		$category = ProductionSubCategory::whereparent_id($pcategory->id)->get();

		return $category;
	}

	public function getgcmdata($id){
		$pcategory = ProductionCategory::wherename('GSM')->first();		
		$category = ProductionSubCategory::whereparent_id($pcategory->id)->get();

		return $category;
	}



	
    

	public function getgownsize($id){

		$pcategory = ProductionCategory::wherename('Gown Size')->first();		
		$category = ProductionSubCategory::whereparent_id($pcategory->id)->get();

		return $category;

	}


	public function show(){


/*$role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('production-index')){            
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))*/
                $all_permission[] = 'dummy text';
			$production = Production::orderBy('id','desc')->paginate(15);


		$category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();
		return view('production.index',compact('production','all_permission','category'));

       /* }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
*/

	}

   public function productshow(){

  $production=Production::all();
  return $production;

   }



   public function material($id){
   	$purchase=Purchase::where('warehouse_id',$id)->get();
  // 	dd($purchase);
 
    return view('rawmaterial.rawmaterial',compact('purchase'));

   }








	public function store(Request $request){

		$cat = $request->main_category;	
		$sub = Input::get('category'.$cat);//$request->category.();
		$values = Input::get('subcategory'.$cat);
		$production = new Production();
		$production->category = $request->main_category;
		$production->subcategory = serialize($sub);	
		$production->value = serialize($values);
		$production->save();

		return redirect()->route('productionlist');
	}




	public function rawmaterial(){

		$warehouses = Warehouse::all();
		return view('rawmaterial.index',compact('warehouses'));
	}
	

	public function request_raw_material (Request $request){

		$data = Purchase::where('warehouse_id',$request->warehouse_id)->where('item',$request->item_id)->first();
		if($data->total_qty < $request->requested_amount){

			return redirect()->back();

		}else{

			$new = new ProductionRequests();
			$new->warehouse_id = $request->warehouse_id;
			$new->item_id = $request->item_id;
			$new->total = $request->total;
			$new->production_id = 1;			
			$new->status = 0;
			$new->save();
			return redirect()->route();


		}
	}


	public function productionrequests(){
		$data = ProductionRequests::paginate(15);
		return view('rawmaterial.requests',compact('data'));


	}

	public function allproductionrequests(){
		$data = ProductionRequests::paginate(15);
		return view('rawmaterial.adminpurchaserequests',compact('data'));


	}	

public function allrequestform(){	
		$rawmaterial = RawMaterial::all();
		$warehouse = Warehouse::all();	
		return view('rawmaterial.requestform',compact('rawmaterial','warehouse'));
	}



	
	public function approverequest($id)
	{


		$data = ProductionRequests::where('id',$id)->first();

		$all=ProductionRequests::with('rawmaterial')->where('order_id',$data->order_id)->get();

		foreach($all as $a){

			$prod = ProductionRequests::where('id',$a->id)->first();			
			

		}

		$data->status = 1;
			$data->save();

		$purchase = RawMaterial::where('id',$data->item_id)->first();		
		$purchase->alert_quantity = $purchase->alert_quantity - $data->quantity;
		$purchase->save();



		
		return redirect()->back();
	}
    
	public function rejectrequest($value='')
	{
		$data = ProductionRequests::where('id',$id)->delete();
				return redirect()->back();
	}


	public function change_status($id){

	 $store = Store::first();
	 //dd($store);	
      $status=Production::where('id',$id)->first();
        $status->status=1;
        $status->production_date=date('Y-m-d');
     	$status->store_id = $store->id;
        $status->save();
        return redirect()->back();
    }


    public function save_issue_request(Request $request){
    	//dd($request);

		$order_id = md5(date('Y-m-d').microtime());
    		foreach($request->product as $key => $r){
    			
    		$new = new ProductionRequests();

  
			$new->warehouse_id = $request->warehouse;
			$new->item_id = $r;
			$new->order_id = $order_id;
			$new->quantity=$request->quantity[$key];
			$new->production_id=Auth::user()->id;
			$new->total = $request->total[$key];
			$new->status = 0;
			$new->save();    			

    		}

			return redirect()->back();


    }


}
