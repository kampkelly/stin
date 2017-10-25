<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Plan;
use App\Startup;

class PlansController extends Controller
{
    public function index()
    {
    	if(checkPermission(['innovator'])){
        	$plans = Plan::where('slug', 'starter')->orderBy('id', 'desc')->take(1)->get(); 
        	#$plans = Plan::orderBy('id', 'desc')->take(2)->get(); 
    	}
        else{
        	$plans = Plan::where('slug', 'professional')->orderBy('id', 'desc')->take(2)->get(); 
        }
    	#$plans = Plan::orderBy('id', 'desc')->take(2)->get(); 
        #return view('plans.index')->with(['plans' => Plan::get()]);
        return view('plans.index', compact('plans'));
    }

    public function show(Request $request, Plan $plan)
    {
    /*	if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
    		session()->flash('message', 'Unauthorised operation');
	      #  return redirect('/')->with('error', 'Unauthorised operation');
	        return redirect('/');
	    } */

        if(checkPermission(['innovator'])){
            if($plan->braintree_plan == 'starter'){
                if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
                session()->flash('message', 'Unauthorised operation');
              #  return redirect('/')->with('error', 'Unauthorised operation');
                return redirect('/');
                }
                 return view('plans.show')->with(['plan' => $plan]);
            }
        }

        if(checkPermission(['investor'])){
            if($plan->braintree_plan == 'professional'){
                if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
                session()->flash('message', 'Unauthorised operation');
              #  return redirect('/')->with('error', 'Unauthorised operation');
                return redirect('/');
                }
                 return view('plans.show')->with(['plan' => $plan]);
            }
        }
        return redirect('/');
    }
}
