<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripeController extends Controller
{
    public function stripePage() {
        return view('stripe');
    }

    public function charge(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => 5000,
            'currency' =>'jpy',
            'source' =>request()->stripeToken,
        ]);
        return back();
    }
}
