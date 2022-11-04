<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\http\Service\SessionService;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;


class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function initiateTransactionPayment(Request $request)
    {
        $user = SessionService::getUser($request);
        $data = $request->all();
        $request->validate([
            'order_id'  => 'required|exists:orders,unique_id',
        ]);
        $getAmount = Order::where('unique_id', $request->order_id)->first();
        // $amount = $getAmount->amount;
        $reference = Paystack::genTranxRef();
        $trans_id = "TRANS" . mt_rand(100000, 999999);
        Transaction::create($request->safe()->merge([
            'unique_id' => $trans_id,
            'user' => $user->unique_id,
            'status' => 'Pending',
            'transaction_type' => 'Order',
            'type_id' => $request->order_id,
            'transaction_amount' => $getAmount->amount,
        ])->all());

        $data = [
            "amount" => $getAmount->amount * 100,
            "reference" => $trans_id,
            "email" => $user->email,
            "currency" => "NGN",
            "orderID" => $request->order_id,
        ];
        $payment = $this->redirectToGateway($data);
        if ($payment)
            return response()->json([
                'payment' => $payment,
            ]);

        return response()->json([
            'Transaction could not be initiated'
        ], 400);
    }
    public function redirectToGateway($data)
    {
        try {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                "Content-Type" => "application/json",
            ])->post('https://api.paystack.co/transaction/initialize', array_merge($data, ['callback_url' => route('paymentCallback')]));

            return json_decode($response, true);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Content-Type" => "application/json",
        ])->get('https://api.paystack.co/transaction/verify/' . $request->reference);

        if ($response['status'] === 'true') {
            $transaction = Transaction::find($request->reference);
            $transaction->update($request->safe()->merge([
                'status' => 'Successful',
            ])->all());
            return response()->json([
                'Payment' => 'Successful',
            ]);
        } else {
            $transaction = Transaction::find($request->reference);
            $transaction->update($request->safe()->merge([
                'status' => 'Failed',
            ])->all());
            return response()->json([
                'Payment' => 'Failed',
            ], 400);
        }

        return json_decode($response, true);
    }
}
