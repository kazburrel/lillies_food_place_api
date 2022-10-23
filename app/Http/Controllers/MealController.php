<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\StoreMealUpdateRequest;
use App\http\Service\SessionService;
use App\Models\meal;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class MealController extends Controller
{
    public function storeMeal(StoreMealRequest $request)
    {
        // auth()->shouldUse('vendor');
        $user = SessionService::getUser($request);
        //    dd($user->unique_id);
        $unique_id = "MEAL" . mt_rand(1000, 9999);
        $file = $request->hasFile('meal_avatar') ? $request->file('meal_avatar')->store('mealAvatar', 'public') : '';
        meal::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'meal_avatar' => $file,
            'vendor' => $user->unique_id,
            'status' => 1

        ])->all());
        // Alert::success('Course Created Successfully');
        return response()->json([
            'message' => 'Meal Created Successfully'
        ]);
    }

    public function updateMeal(StoreMealUpdateRequest $request,  $meal)
    {

        $meal = $this->searchMeal($meal);
        $file = $request->hasFile('meal_avatar') ? $request->file('meal_avatar')->store('mealAvatar', 'public') : $meal->meal_avatar;
        $meal->update($request->safe()->merge([
            'meal_avatar' => $file,
        ])->all());

        return response()->json([
            'message' => 'Meal updated successfully'
        ]);
    }

    public function destroyMeal(meal $meal)
    {
// dd($meal);
        $meal->delete();
        return response()->json([
            'message' => 'Meal deleted successfully'
        ]);
    }

    public function showMeal()
    {
        return meal::all();
    }

    public function searchMeal($id)
    {

        return meal::where('unique_id', $id)->first();
    }

    public function fetchSingleMeal(meal $request)
    {

        $meals = meal::search(request(key: 'search'))->get();
        $meals = $meals->sortBy('created_at');
        return $meals;
        // dd('hi');
        //    return meal::where('meal_name', 'like', '%' . $request->search() . '%');
        // return meal::filter(request(['search']));
    }
}
