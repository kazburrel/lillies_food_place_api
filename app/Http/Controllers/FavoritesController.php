<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavVendorRequest;
use App\http\Service\SessionService;
use App\Models\FavVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function addFavVendor(StoreFavVendorRequest $request, $vendor)
    {
        $user = SessionService::getUser($request);
        if (!$vendor = Vendor::find($vendor)) return abort(401, 'Vendor not found.');
        $favourite = FavVendor::where('vendor', $request->vendor);
        if ($favourite->count() > 0) {
            $favourite->delete();
            return  response()->json([
                'message' => 'Vendor deleted successfully',
            ]);
        } else {
            $unique_id  = "FAV" . mt_rand(100000, 999999);
            FavVendor::create($request->safe()->merge([
                'unique_id' => $unique_id,
                'user' => $user->unique_id,
            ])->all());
            return  response()->json([
                'message' => 'Vendor added to favorites successfully',
            ]);
        }
    }

    public function listFavVendors(Request $request)
    {
        $user = SessionService::getUser($request);
        return FavVendor::where('user', $user->unique_id)->with('vendorDets')->get();
    }
}
