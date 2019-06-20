<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $service = DB::table('services')->count();;
        $device = DB::table('devices')->where('status', 0)->count();
        $customer = DB::table('customers')->count();
        $service_sum = DB::table('services')->sum('order_total');

        return view('home', compact(['device','customer']));
    }
}
