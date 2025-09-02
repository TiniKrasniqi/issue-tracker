<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function showDashboard(Request $request){
        $users = [];
        $roles = [];
        $user = $request->user(); // or Auth::user();

        if ($user->hasPermissionTo('user.view-all')) {
            $users = User::all();
        }

        if ($user->hasPermissionTo('role.view-all')) {
            $roles = Role::all();
        }
       
        return view('dashboard.home', 
        [
            'users'=> $users,
            'roles' => $roles,
            'name1'=>'Dashboard', 
            'name2'=>'Home', 
            'name3'=>'Dashboard'
        ]);
    }
}
