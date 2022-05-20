<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SalesFinalProduct;
use App\Production;
use App\SalesFinalProductItems;
class SalesFinalProductController extends Controller
{
   public function sales_save(Request $request){


   	$new = new SalesFinalProduct();
	$new->reference_no	= 'posr-' . date("Ymd") . '-'. date("his");
	$new->user_id = Auth::user()->id;	
	$new->customer_id= $request->customer_id;	
	$new->warehouse_id= $request->warehouse_id;	
	$new->biller_id= $request->biller_id;	
	$new->item = 0;	
	$new->total_qty = 0;	
	$new->total_discount= isset($request->total_discount)?$request->total_discount:0;	
	$new->total_tax= $request->customer_id;	
	$new->total_price	= isset($request->total_price)?$request->total_price:0;
	$new->grand_total	= 0;//isset($request->grand_total)?$request->grand_total:0;
	$new->order_tax_rate	= $request->order_tax_rate;
	$new->order_tax	= 0;//$request->order_tax;
	$new->order_discount	= $request->order_discount;
	$new->coupon_id	= $request->coupon_id;
	$new->coupon_discount	= $request->coupon_discount;
	$new->shipping_cost	= $request->shipping_cost;
	$new->sale_status	= $request->sale_status;
	$new->payment_status	= $request->payment_status;
	$new->document	= $request->document;
	$new->paid_amount	= $request->paid_amount;
	$new->sale_note	= $request->sale_note;
	$new->staff_note= $request->staff_note;
	$new->save();


	foreach($request->main_category as $key => $mn){

		$prod = Production::where('id',$request->selected_production[$key])->first();

		$prod->sales_status = 1;
		$prod->save();

		$newitem = new SalesFinalProductItems();
		$newitem->category_id = $mn;
		$newitem->sales_id = $new['id'];
		$newitem->item_id = $request->selected_production[$key];
		$newitem->price = $request->select_price[$key];		
		$newitem->save();



	}
		$id = $new['id'];
	return redirect()->route('sales-report',['id'=>$id]);

   }
}
