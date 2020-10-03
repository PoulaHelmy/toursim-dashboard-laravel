<?php

namespace App\Http\Controllers\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Excursion;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function summery()
    {
        $all_users = User::count();
        $all_hotels = Hotel::count();
        $all_cats = Category::count();
        $all_excursions = Excursion::count();
        $all_pkgs = Package::count();
        $all_plans = Plan::count();
        $all_destinations = Destination::count();
        $all_roles = Role::all();
        $all_permissions = Permission::all();
        return view('dashboard.welcome', compact(
            'all_users',
            'all_hotels',
            'all_cats',
            'all_excursions',
            'all_pkgs',
            'all_plans',
            'all_destinations',
            'all_roles',
            'all_permissions'
        ));
    }//END OF SUMMERY
}//END OF CLASS
