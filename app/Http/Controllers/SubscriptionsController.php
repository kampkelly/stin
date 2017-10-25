<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Subscription;

class SubscriptionsController extends Controller
{
	public function index()
    {
        return view('subscriptions.index');
    }

    public function store(Request $request)
    {
          $plan = Plan::findOrFail($request->plan);

		    if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
		        return redirect('/')->with('error', 'Unauthorised operation');
		    }

		    if (!$request->user()->subscribed('main')) {
		        $request->user()->newSubscription('main', $plan->braintree_plan)->trialDays(14)->create($request->payment_method_nonce);
		    } else {
		        $request->user()->subscription('main')->swap($plan->braintree_plan);
		    }

		    // redirect to home after a successful subscription
		    return redirect('/')->with('success', 'Subscribed to '.$plan->braintree_plan.' successfully');
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription('main')->cancel();

        return redirect()->back()->with('success', 'You have successfully cancelled your subscription');
    }

    public function resume(Request $request)
    {
        $request->user()->subscription('main')->resume();

        return redirect()->back()->with('success', 'You have successfully resumed your subscription');
    }
}
