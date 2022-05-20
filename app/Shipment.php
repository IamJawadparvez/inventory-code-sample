<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table='shipment';


    public function production_category(){


	 return $this->hasOne('App\ProductionCategory','id','productioncategory_id');


    }
    public function subcategory()
    {
    	return $this->hasMany('App\ProductionSubCategory','category_id','id')->where('parent_id',NULL);
    }

}
