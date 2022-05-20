<?php

namespace App\Http\Controllers;
use App\ShipmentAgent;
use App\Roles;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class ShipmentAgentController extends Controller
{
    public function shipmentagent(){

    	return view('shipmentagent.create');
    }




    public function shipmentagentindex()
    {
      //dd(Auth::user()->role_id);
    	$role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('shipmentagent-index')){            
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';

       $lims_shipmentagent_all= ShipmentAgent::where('is_active', true)->get();
     //  dd($lims_shipmentagent_all);
    	return view('shipmentagent.index',compact('lims_shipmentagent_all','all_permission'));
 	 }
 	  else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');


    }
}



