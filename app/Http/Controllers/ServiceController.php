<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Customer;
use App\Device;
use App\Modelling;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = DB::table('services')
            ->join('devices','services.device_id','=','devices.id')
            ->join('customers','services.customer_id','=','customers.id')
            ->join('brands','services.brand_id','=','brands.id')
            ->join('modellings','services.model_id','=','modellings.id')
            ->where('service_status', '!=',255)
            ->orderBy('services.id','DESC')
            ->paginate(20);

        return view('services.index', compact(['services']));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::where('barcode', $id)->first();
        $data = array();
        $data['service'] = Service::where('barcode', $id)->first();
        $data['device'] = Device::whereId($service['device_id'])->first();
        $data['customer'] = Customer::whereId($service['customer_id'])->first();
        $data['brand'] = Brand::whereId($service['brand_id'])->first();
        $data['modellings'] = Modelling::whereId($service['model_id'])->first();



        return view('services.edit', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Finish Service
     */
    public function finish()
    {
        $services = DB::table('services')
            ->join('devices','services.device_id','=','devices.id')
            ->join('customers','services.customer_id','=','customers.id')
            ->join('brands','services.brand_id','=','brands.id')
            ->join('modellings','services.model_id','=','modellings.id')
            ->where('service_status', '=',255)
            ->orderBy('services.id','DESC')
            ->paginate(20);

        return view('services.finish', compact(['services']));
    }

}
