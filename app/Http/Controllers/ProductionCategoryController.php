<?php

namespace App\Http\Controllers;


use App\ProductionCategory;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\ProductionSubCategory;

class ProductionCategoryController extends Controller
{


    public function production_categories(){

        $categories = ProductionCategory::paginate(25);
        return view('production.categories',compact('categories'));
    }


    public function production_categories_save(Request $request){

        $request->name = preg_replace('/\s+/', ' ', $request->name);
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('production_categories')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);

        $new = new ProductionCategory();
        $new->name = $request->name;
        $new->is_active = 1;
        $new->save();

        return redirect('production.categories')->with('message', 'Data inserted successfully');

    }

    public function production_sub_categories($id){
        $categories = ProductionSubCategory::wherecategory_id($id)->paginate(25);
        return view('production.subcategories',compact('categories','id'));
    }

    public function production_sub_categories_save(Request $request){

        $request->name = preg_replace('/\s+/', ' ', $request->name);
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('production_subcategories')->where(function ($query) use ($request){
                    return $query->where('is_active', 1)->where('category_id',$request->head_id);
                }),
            ],
        ]);

        $new = new ProductionSubCategory();
        $new->name = $request->name;
        $new->parent_id = $request->parent_id;
        $new->category_id = $request->head_id;
        $new->type = $request->input_type;
        $new->is_active = 1;
        $new->save();

        return redirect()->route('production.subcategories',['id'=>$request->head_id])->with('message', 'Data inserted successfully');

    }
    
}
