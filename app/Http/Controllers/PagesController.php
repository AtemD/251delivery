<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\OrderType;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        $cities = City::orderBy('name', 'asc')->get();
        $order_types = OrderType::orderBy('name', 'asc')->get();

        return view('pages.welcome', compact('cities', 'order_types'));
    }
}
