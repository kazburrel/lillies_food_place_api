<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function dashboardView(){
        return view('admin.dashboard');
    }
    
    public function usersView(){

        $users = User::all();
        return view('admin.all_users', ['users'=>$users]);
    }
}
