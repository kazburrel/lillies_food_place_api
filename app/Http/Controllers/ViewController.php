<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

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
        return view('admin.all_users', ['users' => $users]);
    }

    public function vendorView()
    {

        $vendors = Vendor::search(request(key: 'search'))->get();
        // dd($vendors);
        return view('admin.all_vendors', ['vendors' => $vendors]);
    }

    public function addVendorView(){
        return view('admin.add_vendors');
    }
}
