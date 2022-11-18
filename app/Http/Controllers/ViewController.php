<?php

namespace App\Http\Controllers;

use App\Models\meal;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ViewController extends Controller
{
    public function dashboardView()
    {
        return view('admin.dashboard');
    }

    public function addUsersView()
    {
        return view('admin.add_users');
    }

    public function usersView()
    {
        // Staff::search(request(key: 'search'))
        $users = User::search(request(key: 'search'))->get();
        $users = $users->sortBy('created_at');
        return view('admin.all_users', ['users' => $users]);
    }

    public function vendorView()
    {

        $vendors = Vendor::search(request(key: 'search'))->get();
        $vendors = $vendors->sortBy('created_at');
        // dd($vendors);
        return view('admin.all_vendors', ['vendors' => $vendors]);
    }

    public function addVendorView()
    {
        return view('admin.add_vendors');
    }

    public function mealsview()
    {
        $meals = meal::search(request(key: 'search'))->get();
        $meals = $meals->sortBy('created_at');
        // $meals::with('vendordets');
        // dd($meals);
        return view('admin.all_meals', ['meals' => $meals]);
    }

    public function showOrders()
    {
        $orders = Order::search(request(key: 'search'))->get();
        $orders = $orders->sortBy('created_at');
        // foreach ($orders as $key => $value) {
        //     $decode = json_decode($value->meal);
        //     $meals = meal::find($decode);
        //     dd($meals);
        //     // foreach ($decode as $key => $meal) {
        //     //     $meal_name = meal::where('unique_id', $meal)->get();
        //     //     // dd($meal_name);
        //     // }
        // }
        // $dish =  Arr::map($orders->meal, function ($map, $key) {
        
        // });
        return view('admin.all_orders', ['orders' => $orders]); 
    }
}
