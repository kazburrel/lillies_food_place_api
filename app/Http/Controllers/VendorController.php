<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\http\Service\SessionService;
use App\Models\Vendor;
// use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
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

        return Response()->json([
            'message' => 'Vendor created successfully',
        ]);
    }

    public function showVendor()
    {
        return Vendor::all();
    }

    public function searchVendor($id)
    {
        return Vendor::where('id', $id)->first();
    }

    public function showVendorDetails(Request $request)
    {
        $user = SessionService::getUser($request);
        return $user;
    }
}
