<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionRequests extends Model
{
    protected $table = 'production_requests';


     public function warehouse()
    {
    	return $this->hasOne('App\Warehouse','id','warehouse_id');
    }


     public function rawmaterial()
    {
    	return $this->hasOne('App\RawMaterial','id','item_id');
    }
}
