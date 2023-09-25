<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\{Order,
    OrderDetails,
    Provider,
    OrderOffer};
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Paytabscom\Laravel_paytabs\Facades\paypage;
use App\Traits\GeneralTrait;

class PaytapsPaymentController extends Controller
{
    use GeneralTrait;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator,406);
        }
        $user = User::where('id',$request->user_id)->first();
//        dd($user);
        $transaction_type = 'sale';
//        $cart_id = uniq_id_number();
        $cart_id = $request->offer_id;
        $cart_amount = $request->amount;
        $cart_description = 'description';
        $name = 'customer name';
        $email = (isset($user->email)) ? $user->email : 'customer@example.com';
        $phone = $user->phone;
        $street1 = 'street';
        $city = 'SA';
        $state = 'SA';
        $country = '10';
        $zip = '10111';
        $ip = file_get_contents('https://ipecho.net/plain');
        $same_as_billing = uniq_id_number();
        $callback = url('/api/callback_paytabs');
        $return = url('/api/return_paytabs');

        $language = 'en';

        $pay =  paypage::sendPaymentCode('all')
            ->sendTransaction($transaction_type)
            ->sendCart($cart_id,$cart_amount,$cart_description)
            ->sendCustomerDetails($name, $email, $phone, 'street', 'Saudi', 'Saudi', 'SA', $user->id,$ip)
            ->sendShippingDetails($name, $email, $phone, 'street', 'Saudi', 'Saudi', 'SA', $user->id,$ip)
            ->sendURLs($return, $callback)
            ->sendLanguage($language)
            ->sendUserDetails()
            ->create_pay_page();

            $data['payment_url'] = $pay->getTargetUrl();

         return  helperJson($data);
    }

    public function callback_paytabs(Request $request)
    {
        return $request->status;
    }


    public function return_paytabs(Request $request)
    {
        $tran_ref =  $request->tranRef;
        $str_response =  json_encode(Paypage::queryTransaction($tran_ref));
//        dd($str_response);
        $transaction_response  = json_decode($str_response, true);
        $user = User::where('id',$transaction_response['customer_details']['zip'])->first();
        $payment = Payment::create([
                    'tran_ref' => $transaction_response['tran_ref'],
                    'reference_no' => $transaction_response['reference_no'],
                    'transaction_id' => $transaction_response['transaction_id'],
                    'user_id' => $user->id,
                    'status' => $transaction_response['success'],
                    'cart_amount' => $transaction_response['cart_amount'],
                    'tran_currency' => $transaction_response['tran_currency'],
                     ]);

        $offer = OrderOffer::find($transaction_response['reference_no']);
        $provider = Provider::find($offer->provider_id);
        $provider->balance = $provider->balance + $transaction_response['cart_amount'];
        $provider->save();

        return redirect()->to('/api/callback_paytabs?status='.$payment->status);
    }
}
