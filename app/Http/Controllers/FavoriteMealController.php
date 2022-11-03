<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteMealRequest;
use App\http\Service\SessionService;
use App\Models\FavMeal;
use App\Models\FavVendor;
use App\Models\meal;
use Illuminate\Http\Request;

class FavoriteMealController extends Controller
{
    public function addFavMeal(StoreFavoriteMealRequest $request, $meal)
    {
        $user = SessionService::getUser($request);
        if (!$meal = meal::find($meal)) return abort(401, 'Meal not found.');
        $favourite = FavMeal::where('meal', $request->meal);
        if ($favourite->count() > 0) {
            $favourite->delete();
            return  response()->json([
                'message' => 'Meal deleted successfully',
            ]);
        } else {
            $unique_id  = "FAV" . mt_rand(100000, 999999);
            FavMeal::create($request->safe()->merge([
                'unique_id' => $unique_id,
                'user' => $user->unique_id,
            ])->all());
            return  response()->json([
                'message' => 'Meal added to favorites successfully',
            ]);
        }
    }

    public function listFavMeal(Request $request)
    {
        $user = SessionService::getUser($request);
        return FavMeal::where('user', $user->unique_id)->with('mealDets')->get();
    }
}
