<?php

namespace App\Http\Controllers;
use App\ProductionCategory;
use App\ProductionSubCategory;
use App\Shipment;
use App\Production;
use App\ShipmentDetail;
use App\Warehouse;;
use App\ShipmentAgent;
use App\RawMaterial;
use Illuminate\Http\Request;

class shipmentController extends Controller
{
    public function create(){


  $productioncategories=ProductionCategory::where('parent_id',Null)->get();
   return view('sale.addshipment',compact('productioncategories'));
    }

  public function store(Request $request){
       //	dd($request);

        $user= Shipment::insert([
            'productioncategory_id'=>$request->production_id,
            'customer_name' => $request->customername, 
            'driver_name' => $request->drivername, 
            'vechile_no'=>$request->vechile_no,
            'driver_no'=>$request->driver_no,
             'quantity'=>$request->quantity
          ]);	

		return redirect()->back();


  }
     public function index()
     {

      $shipment=Shipment::with('production_category')->get();
  // dd($shipment);
   	 return view('sale.indexshiping',compact('shipment'));
    }


    public function shipment_list(){

                     $all_permission[] = 'dummy text';
      $production = Production::orderBy('id','desc')->where('shipment_status','1')->paginate(15);


    $category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();
    return view('Shipment.shipmentlist',compact('production','all_permission','category'));

    }

    public function send_shipment($id){

//dd($id);

      $data=Production::where('shipment_status',1,$id)->first();
     // dd($data);
return view('Shipment.shipmentdetail',compact('data'));


    }
    public function shipment_save(Request $request){
   // dd($request);
     ShipmentDetail::insert([
                'production_id'=>$request->production_id,
               'driver_name'=>$request->driver_name,
                'vechile_no'=>$request->vechile_no,
                 'challan_no'=>$request->delivery_no,
                  'gate_pass'=>$request->gate_pass

          ]);
        return redirect()->back();


    }
    public function add_shipment(){
      $warehouse=Warehouse::all();
      $rawmaterial=rawmaterial::all();
      // $production_category=ProductionCategory::all();
      $shipmentagent=ShipmentAgent::all();
      $category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();

      return view('Shipment.addnewshipment',compact('warehouse','rawmaterial','category','shipmentagent'));
    }


    public function add_shipment_data(Request $request){

            $value = $request->value;
            $all_values = $request->all_values;
            $category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();
            return view('Shipment.new_add_shipment',compact('category','value','all_values')); 
    }


    public function get_production_data(Request $request){

        $production = Production::where('category',$request->value)->where('store_status','1')->where('sales_status','0')->where('shipment_status',0)->get();

        $data = array();
        $i = 0;
        foreach($production as $prod){

          $subcat = unserialize($prod->subcategory);

          $values = unserialize($prod->value);          


            foreach ($subcat as $key => $sb) {  
            $cat = ProductionSubCategory::where('id',$sb)->first();
                $data[$i][$cat->name] = $values[$key];                
            }


            $data[$i]['id'] = $prod->id;   
            $i++;
        }  

            
            return $data;
    }



    public function save_issue_shipment(Request $request)
    {
     // dd($request);
    foreach ($request->selected_production as $key => $p) {
      $production=Production::where('id',$p)->first();
      $production->shipment_status=1;
      $production->save();
    }



      $main_category=serialize($request->main_category);
      $selected_production=serialize($request->selected_production);
      $new= new Shipment();
      $new->main_category=$main_category;
      $new->selected_production=$selected_production;
      $new->date=$request->date;
      $new->warehouse_id=$request->warehouse;
      $new->promotion=$request->promotion;
      $new->driver_name=$request->driver_name;
      $new->vechile_detail=$request->vechile_detail;
      $new->driver_no=$request->driver_contact;
      $new->shipment_agent_name=$request->shipmentagentname;
      $new->attach_document=$request->attach_document;
      $new->description=$request->description;
      $new->selected_product=$request->selected_product;
      $new->save();
      return redirect()->back();

    }


    public function search_production_data(Request $request){



      $production = Production::where('category',$request->value)->where('store_status','1')->where('sales_status','0')->where('shipment_status',0)->get();

      $xkeys =  json_decode($request->keys);   
      $xvalues =  json_decode($request->values);           
      
      $subcategory = ProductionSubCategory::where('category_id',$request->value)->where('parent_id',NULL)->get();
      $mtdata = [];
      foreach($xkeys as $key => $k){

           $sbcat = ProductionSubCategory::where('id',$k)->first();            
           
           if($sbcat->type=='text'){

              $mtdata[$key] = $xvalues[$key];

           }else{
              $key_value =  ProductionSubCategory::where('name',$xvalues[$key])->first();   
              if(!empty($key_value)){
                $mtdata[$key] = $key_value->id;                              
              }

           }


               
      } 

        $mt_cdata = array_filter($mtdata);
        $mt_cdata = array_values($mt_cdata);

        sizeof($mt_cdata);       
        $c_data = []; 
       
        foreach($production as $key_p => $st){
          $rg = 0;
           $subcat = unserialize($st->subcategory);
           $values = unserialize($st->value);      

           foreach($subcat as $key => $ts){


                if(isset($mtdata[$key])){

                  if($values[$key]==$mtdata[$key]){

                        if($rg==(sizeof($mt_cdata)-1))
                         {
                          $c_data[$key_p] = $st->id;                           
                         }else{
                           $rg++;                              
                         } 



                  }

                }


           }
            

        }

        $data = [];
        $c_data = array_values($c_data);  

        foreach($c_data as $key => $dt){

            $prd = Production::where('id',$dt)->first();

            $stc = unserialize($prd->subcategory);
            $stc_values = unserialize($prd->value);
            foreach($stc as $keysb => $s){

                $prdsb = ProductionSubCategory::where('id',$s)->first();
                $data[$key][$prdsb->name]=$stc_values[$keysb];
            }

            $data[$key]['id']=$prd->id;
        }

  

         return $data;   
    }


}
