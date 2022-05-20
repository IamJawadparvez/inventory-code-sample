<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionCategory extends Model
{
    protected $table = 'production_categories';
 	
 	public function subcategory()
    {
    	return $this->hasMany('App\ProductionSubCategory','category_id','id')->where('parent_id',NULL);
    }


}
