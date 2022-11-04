<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\http\Service\SessionService;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;


class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $user = SessionService::getUser($request);
        $data = $request->all();
        $request->validate($data, [
            'amount'  => 'required',            
        ]);

        $reference = Paystack::genTranxRef();
        $trans_id = "TRANS" . mt_rand(100000, 999999);
        // $description = 'Payment for'.$user->name;

        $data = [
            "amount" => $data['amount'] * 100,
            "reference" => $reference,
            "email" => $user->email,
            "currency" => "NGN",
            "orderID" => $request->order_id,
            
            // "description" => $description,
        ];

        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData(); 

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
