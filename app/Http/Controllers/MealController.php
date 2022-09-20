<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRequest;
use App\Models\meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class MealController extends Controller
{
    public function storeMeal(StoreMealRequest $request)
    {
        // dd($request);
        // $token = PersonalAccessToken::findToken($hashedTooken);
        $vendor_id = Auth::user()->vendor_id;
        $meal_id = "M" . mt_rand(1000, 9999);
        $file = $request->hasFile('meal_avatar') ? $request->file('meal_avatar')->store('mealAvatar', 'public') : '';
        meal::create($request->safe()->merge([
            'meal_id' => $meal_id,
            'meal_avatar' => $file

        ])->all());
        // Alert::success('Course Created Successfully');
        return response()->json([
            'message' => 'Meal Created Successfully'
        ]);
    }

    public function showMeal(){
        return meal::all();
    }

    public function searchMeal($id)
    {
        return meal::where('id', $id)->first();
    }
}
