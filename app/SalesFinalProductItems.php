<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesFinalProductItems extends Model
{
    protected $table = 'sales_final_items';


    public function production_details()
    {
    	return $this->hasOne('App\Production','id','item_id');
    }

}
