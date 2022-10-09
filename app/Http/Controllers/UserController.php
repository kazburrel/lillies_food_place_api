<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\StoreUsersRequest;
use App\http\Service\SessionService;
use App\Models\Order;
use App\Models\Cart_item;
use App\Models\meal;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerUser(StoreUsersRequest $request)
    {
        $unique_id = "USER" . mt_rand(100000, 999999);
        $file = $request->hasFile('user_avatar') ? $request->file('user_avatar')->store('userAvatar', 'public') : '';
        User::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'user_avatar' => $file,
            'password' => Hash::make($request->password),
            'status' => 1,
            'type' => 'user'
        ])->all());

        return  response()->json([
            'message' => 'User created successfully',
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->first();
    }

    public function showUserdetails(Request $request)
    {
        $user = SessionService::getUser($request);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addOrder(StoreCartRequest $request)
    {
        // dd('hi');

        $getuser = SessionService::getUser($request);
        $user = $getuser->unique_id;
        $unique_id = "ORDER" . mt_rand(100000, 999999);
        $dish =  Arr::map($request->meal, function ($value, $key) {
            return $value['meal_id'];
        });
        $cart = Order::create($request->safe()->merge([
            'user' => $user,
            'unique_id' => $unique_id,
            'meal' => json_encode($dish),
        ])->all());
        try {
                foreach ($request->meal as $key => $value) {
                    
                    $meal = meal::find($value['meal_id']);
                    $qty = (int) $value['quantity'];
                    if (!$meal) throw new Exception("The Requested Meal does not exist", 400);
                    if ((int) $meal->quantity < $qty) throw new Exception("Sorry we do not have up to this quantity", 400);
                    $unique_id = "CART_ITEM" . mt_rand(100000, 999999);
                    OrderItem::create([
                        'unique_id' => $unique_id,
                        'meal_id' => $value['meal_id'],
                        'cart_id' => $cart->unique_id,
                        'meal_thumb' => $meal->meal_avatar,
                        'meal_name' => $meal->meal_name,
                        'meal_price' => $meal->meal_price,
                        'quantity' => $value['quantity'],
                        'sub_total' => $value['quantity'] * $meal->meal_price
                    ]);
                    $total = OrderItem::where('cart_id', $cart->unique_id)->sum('sub_total');
                    $order = Order::find($cart->unique_id);
                    // dd($order);
                    $order->update([
                        'total_price' => $total
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => $th->getMessage()
                ], $th->getCode());
            }
        
        return  response()->json([
            'message' => 'Order created successfully',
        ]);
    }
}