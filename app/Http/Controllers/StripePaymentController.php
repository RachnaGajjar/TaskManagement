<?php

namespace App\Http\Controllers;

use App\Models\Carddetail;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe;
use Spatie\Flash\Message;
use Stripe\Issuing\CardDetails;
use Stripe\Issuing\Transaction;
use Stripe\Token;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class StripePaymentController extends Controller
{
    public function addcards()
    {
        return view('Payment Gateway.carddetails');
    }
    public function addcardspost(Request $request)
    {
        $users=auth::user();
        $id=$users->id;
        $email=$users->email;
        $employee=Employee::where('user_id',$id)->first();
       // dd($employee);
        $name=$employee->name;
        $phonenumber=$employee->phonenumber;
        $address=$employee->address;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create
        ([
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phonenumber,
            "address"=>
            [
                'city'=>$address
            ],
        ]);
        $customer_id=$customer->id;
        $user=User::where('id',$id)->first();
        if($user)
        {

            $user->customer_id=$customer_id;
            $user->save();
        }
        $card_number=$request->card_number;
        $month=$request->expire_month;
        $year=$request->expire_year;
        $csv=$request->csv;

        $token = Token::create([
            'card' => [
                'number' => $card_number,
                'exp_month' => $month,
                'exp_year' => $year,
                'cvc' => $csv
            ],
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
           $stripe=$stripe->customers->createSource(
            $customer->id,
            ['source' => $token->id
        ]);
        $demo=$stripe->id;
        $request->validate([
                'card_name' => 'required',
                'card_number' => 'required',
                'csv' => 'required',
                'expire_month' => 'required',
                'expire_year' => 'required',
            ]);
            $cardnum=$request->card_number;
            $newstring = substr($cardnum, -4);
            $request['card_number']=$newstring;
            $request['card_token']=$demo;
            $request['user_id']=$id;
            $request['customer_id']=$customer_id;
            Carddetail::create($request->all());
            return redirect()->route('paymentprocess')
        ->with('success', 'Carddetails add successfully.');
    }
    public function paymentprocess()
    {
        $data=auth::user();
        $id=$data->id;
        $carduser=Carddetail::where('user_id',$id)->first();
        //$cardcollection=Carddetail::where('user_id',$id)->select('card_number')->limit(3)->get();
        $cardcollection =Carddetail::where('user_id',$id)->pluck('card_number','id');
        return view('Payment Gateway.paymentprocess',compact('carduser','cardcollection'));
    }
    public function postpaymentprocess(Request $request)
    {
        try
        {
            $user=auth::user();
            $id=$user->id;
            $name=$request->card_name;
            $card_number=$request->cardnumber;
            $carduser=Carddetail::where('user_id',$id)->where('id',$card_number)->first();
            $customerid=Carddetail::where('user_id',$id)->where('id',$card_number)->select('customer_id')->first();
            $cardtoken=$carduser->card_token;
            $customer_id=$customerid->customer_id;
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
              );
              $customer = $stripe->customers->retrieve(
                $customer_id,
                []
              );

            $stripe->charges->create([
                'customer' => $customer->id,
                'amount' => 100*100,
                'currency' => 'inr',
                'source' => $cardtoken,
                'description' => 'My First Test Charge (created for API docs)',

            ]);
              return redirect()->route('paymentprocess')
              ->with('success', 'Carddetails add successfully.');
        }
       catch(\Stripe\Exception\ApiErrorException $e)
        {
            $error = $e->getMessage();
            return redirect()->route('paymentprocess');
        }



    }
}
