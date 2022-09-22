<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function registerAdmin(StoreAdminRequest $request)
    {
        $admin_id = "ADMIN" . mt_rand(100000, 999999);
        $file = $request->hasFile('admin_avatar') ? $request->file('admin_avatar')->store('adminAvatar', 'public') : '';
        Admin::create($request->safe()->merge([
            'admin_id' => $admin_id,
            'user_avatar' => $file,
            'password' => Hash::make($request->password)
        ])->all());

        return  response()->json([
            'message' => 'Admin created successfully',
        ]);
    }
}
