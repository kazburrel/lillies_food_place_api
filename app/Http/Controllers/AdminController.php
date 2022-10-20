<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\StoreUsersUpdateRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\StoreVendorUpdateRequest;
use App\Http\Requests\StorMealUpdateRequest;
use App\http\Service\SessionService;
use App\Models\Admin;
use App\Models\meal;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function registerAdmin(StoreAdminRequest $request)
    {
        $unique_id = "ADMIN" . mt_rand(100000, 999999);
        $file = $request->hasFile('admin_avatar') ? $request->file('admin_avatar')->store('adminAvatar', 'public') : '';
        Admin::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'user_avatar' => $file,
            'password' => Hash::make($request->password),
            'type' => 'admin'
        ])->all());

        return  response()->json([
            'message' => 'Admin created successfully',
        ]);
    }

    public function showAdminDetails(Request $request)
    {
        $user = SessionService::getUser($request);
        return $user;
    }

    // USER

    public function registerUser(StoreUsersRequest $request)
    {
        // $clientIP = request()->ip();
        // $data = request()->location();   

        //     dd($clientIP,$data );
        // $password = $request->password;
        // dd($password);
        $unique_id = "USER" . mt_rand(100000, 999999);
        $file = $request->hasFile('user_avatar') ? $request->file('user_avatar')->store('userAvatar', 'public') : '';
        User::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'user_avatar' => $file,
            'password' => Hash::make($request->password),
            'status' => 1,
            'type' => 'user'
        ])->all());

        Alert::success('User created successfully');
        return redirect()->back();
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        Alert::success('User deleted successfully');
        return redirect()->back();
    } 
    
   

    public function blockUser(User $user)
    {
        $user->status = !$user->status;
        $user->save();
        return redirect()->back();
    }

    public function updateUser(StoreUsersUpdateRequest $request, User $user)
    {

        $file = $request->hasFile('user_avatar') ? $request->file('user_avatar')->store('userAvatar', 'public') : $user->user_avatar;
        $user->update($request->safe()->merge([
            'user_avatar' => $file,
        ])->all());

        Alert::success('User updated Successfully');
        return redirect()->back();
    }
   

    // VENDORS

    public function registerVendor(StoreVendorRequest $request)
    {
        $unique_id = "VEN" . mt_rand(100000, 999999);
        $file = $request->hasFile('vendor_avatar') ? $request->file('vendor_avatar')->store('vendorAvatar', 'public') : '';
        Vendor::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'vendor_avatar' => $file,
            'password' => Hash::make($request->password),
            'status' => 1, 
            'type' => 'vendor'

        ])->all());

        Alert::success('Vendor created Successfully');
        return redirect()->back();
    }

    public function blockVendor(Vendor $vendor)
    {
        $vendor->status = !$vendor->status;
        $vendor->save();
        return redirect()->back();
    }

    public function destroyVendor(Vendor $vendor)
    {
        $vendor->delete();
        Alert::success('Vendor deleted successfully');
        return redirect()->back();
    }

    public function updateVendor(StoreVendorUpdateRequest $request, Vendor $vendor)
    {

        $file = $request->hasFile('vendor_avatar') ? $request->file('vendor_avatar')->store('vendorAvatar', 'public') : $vendor->vendor_avatar;
        // $unique_id = "USER" . mt_rand(100000, 999999);
        $vendor->update($request->safe()->merge([
            // 'unique_id' => $user->unique_id,
            'vendor_avatar' => $file,
            // 'password' => Hash::make($request->password),
            // 'status' => 1,
            // 'type' => 'user'
        ])->all());

        Alert::success('Vendor updated Successfully');
        return redirect()->back();
    }
    

    //MEALS

    public function status(meal $meal){
        // dd($meal);

        $meal->status = !$meal->status;
        $meal->save();
        return redirect()->back();
    }

    public function destroyMeal(meal $meal)
    {
        $meal->delete();
        Alert::success('Meal deleted successfully');
        return redirect()->back();
    } 

    public function updateMeal(StorMealUpdateRequest $request, meal $meal)
    {

        $file = $request->hasFile('meal_avatar') ? $request->file('meal_avatar')->store('mealAvatar', 'public') : $meal->meal_avatar;
        $meal->update($request->safe()->merge([
            'meal_avatar' => $file,
        ])->all());

        Alert::success('Meal updated successfully');
        return redirect()->back();
    }
}
