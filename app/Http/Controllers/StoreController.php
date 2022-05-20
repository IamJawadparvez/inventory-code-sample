<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Production;
use App\RawMaterial;
 use App\warehouse;
use App\ProductionCategory;
use App\ProductionRequests;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $all_permission[] = 'dummy text';
            $production = Production::where('status','1')->orderBy('id','desc')->paginate(15);


        $category = ProductionCategory::with('subcategory.cat_values')->whereparent_id(NULL)->get();
        return view('store.receivedstock',compact('production','all_permission','category'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        Store::insert([
               'name'=>$request->name,
                'phone'=>$request->phone,
                 'email'=>$request->email,
                  'address'=>$request->address

          ]);
        return view('store.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
          $store=Store::withCount('stock')->get();

        return view('store.storelist',compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $edit=Store::where('id',$id)->first();
        return view('store.editstore',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $user = Store::where('id',$id)->first();
        $user->name =$request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
          //dd($user);
        $user->save(); 

        return redirect()->route('storelist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      $del = Store::where('id',$id)->delete();
      return redirect()->route('storelist');      
    }

   public function change_status($id){


     //dd($store);  
      $status=Production::where('id',$id)->first();
        $status->store_status=1;
        $status->store_received_date=date('Y-m-d');

        $status->save();
        return redirect()->back();
    }

   public function change_shipment_status($id){


    // dd($store);  
      $status=Production::where('id',$id)->first();
        $status->shipment_status=1;

        $status->save();
        return redirect()->route('Send-Shipment',['id'=>$id]);
    }



    public function materaillist(){


         $data=ProductionRequests::with('warehouse','rawmaterial')->get();
 // dd($data);
        return view('store.requestform',compact('data'));
    }



     public function productionrequest($id){
        $warehouse=warehouse::all();
        $rawmaterial=RawMaterial::all();
        $order = ProductionRequests::find($id);
        //dd($order);
        $data=ProductionRequests::with('rawmaterial')->where('order_id',$order->order_id)->get();
       // dd($data);
        return view('store.productionrequest',compact('warehouse','rawmaterial','data','order'));
    }


    public function delete_production_request($id){
                $order = ProductionRequests::whereid($id)->delete();

                return redirect()->back();
    }

    public function store_update_issue_request(Request $request){


            foreach($request->old_id as $key => $r){

                    $new = ProductionRequests::where('id',$r)->first();

                    $new->warehouse_id = $request->warehouse;
                    $new->item_id = $request->old_product[$key];
                    $new->total = $request->old_quantity[$key];
                    $new->status = 0;
                    $new->save();               

            }


            foreach($request->product as $key => $r){
             
                    if(!empty($r)){

                    $new = new ProductionRequests();  
                    $new->warehouse_id = $request->warehouse;
                    $new->item_id = $r;
                    $new->order_id = $order_id;
                    $new->total = $request->total[$key];
                    $new->status = 0;
                    $new->save();               


                    }        

            }           

return redirect()->back();            

    }

}
