<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $table='addrawmaterial';

		public function warehouse()
		    {
		    	return $this->hasOne('App\Warehouse','id','warehouse_id');
		    }

		    public function purchasecategory()
		    {
		    	return $this->hasOne('App\PurchaseCategory','id','purchasecategory_id');
		    }

		     public function brand()
		    {
		        return $this->hasOne('App\Brand','id','brand_id');
		    }

		    public function unit()
		    {
		    	return $this->hasOne('App\Unit','id','productunit_id');
		    }

		    public function purchasesubcategory()
		    {
		    	return $this->hasOne('App\PurchaseCategory','id','subcategory_id');
		    }

}
