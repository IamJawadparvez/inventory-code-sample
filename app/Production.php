<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'productions';

	public function category_name()
    {
    	return $this->hasOne('App\ProductionCategory','id','category');
    }

    public function color_name()
    {
    	return $this->hasOne('App\ProductionSubCategory','id','color');
    }

     public function gcm_name()
    {
        return $this->hasOne('App\ProductionSubCategory','id','gsm');
    }

    public function subcategory_name()
    {
    	return $this->hasOne('App\ProductionSubCategory','id','subcategory');
    }
}
