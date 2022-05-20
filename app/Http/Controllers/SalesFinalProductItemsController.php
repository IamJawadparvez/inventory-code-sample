<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesFinalProduct;
use App\SalesFinalProductItems;
use App\Production;
use App\Warehouse;
use App\Customer;
use App\Biller;
use App\ProductionCategory;
use App\ProductionSubCategory;
use NumberToWords\NumberToWords;

class SalesFinalProductItemsController extends Controller
{
    public function sales_print($id)

    {
    	//dd($id); 
    	$data=SalesFinalProduct::where('id',$id)->first();
    	$items=SalesFinalProductItems::where('sales_id',$id)->with('production_details')->get();

    	$warehouse=Warehouse::where('id',$data->warehouse_id)->first();
    	$customer=Customer::where('id',$data->customer_id)->first();
    	$biller=Biller::where('id',$data->biller_id)->first();

    	$categories = SalesFinalProductItems::where('sales_id',$id)->groupBy('category_id')->with('production_details')->get();

			 $numberToWords = new NumberToWords();
        if(\App::getLocale() == 'ar' || \App::getLocale() == 'hi' || \App::getLocale() == 'vi')
            $numberTransformer = $numberToWords->getNumberTransformer('en');
        else
            $numberTransformer = $numberToWords->getNumberTransformer(\App::getLocale());
        $numberInWords = $numberTransformer->toWords($data->grand_total);

    	$array = [];	
    	$i=0;
    	$j=0;
    	foreach($categories as $cat){
    		$subcat = ProductionSubCategory::where('category_id',$cat->category_id)->whereparent_id(NULL)->get();
    		foreach($subcat as $sb){
    		$array[$j]['caid']=$cat->category_id;
    		$array[$j]['catname'][$i]=$sb->name;
    		$i++;			
    		}
    		$j++;
    	}



    		
    	//dd($array);
    	return view('sale.print_form',compact('data','items','array','warehouse','customer','biller','numberInWords'));
    }
}
