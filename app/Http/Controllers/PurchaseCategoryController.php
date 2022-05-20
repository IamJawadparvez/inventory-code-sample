<?php

namespace App\Http\Controllers;
use App\PurchaseCategory;

use Illuminate\Http\Request;

class PurchaseCategoryController extends Controller
{
    public function index(){

     $purchasecategory=PurchaseCategory::all();
     $purchase=PurchaseCategory::where('parent_id',NULL)->get();

    	return view('purchase_category.index',compact('purchasecategory','purchase'));
    }

    public function store(Request $request)
    {
    	// dd($request);
     //    $request->name = preg_replace('/\s+/', ' ', $request->name);
      
     //    $store['name'] = $request->name;
     //    $store['parent_id'] = $request->parent_id;
     //    PurchaseCategory::create($store);
     //    return redirect('purchase_category')->with('message', 'Data inserted successfully');
//dd($request);
      PurchaseCategory::insert([

       'name'=>$request->name,
        'parent_id'=>$request->parent_id,

      ]);
      return redirect()->route('purchase_category');
    }

    public function edit($id)
    {
        $pur= PurchaseCategory::findOrFail($id);
        $purchase = PurchaseCategory::where('id', $purchase['parent_id'])->first();
        if($purchase)
            $purchase['parent'] = $purchase['name'];
        return $purchase;
    }





}
