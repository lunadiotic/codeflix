<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function showPlans()
    {
        $plans = Plan::all();
        return view('subscribe.plans', compact('plans'));
    }
}
