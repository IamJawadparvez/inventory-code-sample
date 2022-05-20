<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionSubCategory extends Model
{
    protected $table = 'production_subcategories';

 	public function cat_values()
    {
    	return $this->hasMany('App\ProductionSubCategory','parent_id','id');
    }

}
