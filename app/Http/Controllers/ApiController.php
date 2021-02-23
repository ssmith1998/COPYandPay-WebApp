<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Auth;
use DateTime;


class ApiController extends Controller
{

    public function getDetails(Request $request)
    {


        //validate
        $validated = $request->validate([
            'amount' => 'required',
            'reference' => 'required',
        ]);
        //retrieve amount and reference from $request

        //send api request
        $data = "entityId=8ac7a4ca759cd78501759dd759ad02df" .
            "&amount=" . $request->input('amount') . "" .
            "&currency=GBP" .
            "&paymentType=DB" .
            "&merchantTransactionId=" . $request->input('reference') . "";


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.oppwa.com/v1/checkouts');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ==',
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($ch);

        curl_close($ch);


        $jsonArrayResponse = json_decode($apiResponse, true);

        //needed for form generation
        $checkoutId = $jsonArrayResponse['id'];

        //return view with checkout id
        return view('paymentForm', ['checkoutId' => $checkoutId]);
    }

    public function paymentSuccess(Request $request)
    {

        if ($request->has('resourcePath')) {

            $resourcePath = $request->input('resourcePath');

            //send api request
            $url = "https://test.oppwa.com/" . $resourcePath . "";
            $url .= "?entityId=8ac7a4ca759cd78501759dd759ad02df";


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='
            ));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $data = json_decode($responseData, true);

            // dd($data);
            //response vars
            $resultCode =  $data['result']['code'];
            $resultDesc =  $data['result']['description'];
            $paymentAmount = $data['amount'];
            $paymentTimeStamp =  new DateTime($data['timestamp']);
            $paymentReference = $data['merchantTransactionId'];

            //save payment
            /** @var User $user */
            $user  = Auth::user();
            $newPayment = new Payment();

            $newPayment->amount = $paymentAmount;
            $newPayment->reference = $paymentReference;
            $newPayment->timestamp = $paymentTimeStamp;

            $user->payments()->save($newPayment);

            return view('paymentSuccess', ['code' => $resultCode, 'desc' => $resultDesc]);
        } else {
            return back();
        }
    }
}
