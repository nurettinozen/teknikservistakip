<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Customer;
use App\Device;
use App\Modelling;
use App\Service;
use peal\barcodegenerator\BarCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DeviceController extends Controller
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
        //$devices = DB::table('devices')->where('status', 0)->orderBy('id','DESC')->paginate(20);

        $devices = DB::table('devices')
            ->join('customers','devices.customer_id','=','customers.id')
            ->join('brands','devices.brand_id','=','brands.id')
            ->join('modellings','devices.model_id','=','modellings.id')
            ->where('status', '=',0)
            ->orderBy('devices.id','DESC')
            ->paginate(20);


        return view('devices.index', compact(['devices']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $customers = Customer::all();
        $brands = Brand::all();
        $modellings = Modelling::all();
        return view('devices.create', compact(['brands', 'modellings', 'customers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Device::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'customer_id' => $request->customer_id,
                'pre_detection' => $request->pre_detection,
                'customer_request' => $request->customer_request,
                'repair_description' => $request->repair_description,
                'delivered_person' => $request->delivered_person,
                'serial_number' => $request->serial_number,
                'barcode' => $request->customer_id . time() . rand(0, 9999),
                'guarantee' => $request->guarantee,
                'guarantee_start' => $request->guarantee_start,
                'guarantee_finish' => $request->guarantee_finish,
                'status' => 0,
            ]);

            return Redirect::back()->with('success', 'Yeni Servis Formu Başarıyla Oluşturuldu. Barkod ve form yazdırmak için listeden yazdır butonuna tıklayınız.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Müşteri eklerken bir hata ile karşılaşıldı.']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * @param Request $request
     */
    public function showBarcode(Request $request)
    {
        try {
            $id = $request->id;
            $barcode = Device::where('barcode',$id)->get()->first();
            return response()->json($barcode);
        } catch (Exception $e) {
            dd($e);
        }

    }

    public function showForm(Request $request)
    {
        try {
            $id = $request->id;
            $data = array();
            $data['form'] = Device::where('barcode',$id)->get()->first();
            $data['customer'] = Customer::whereId($data['form']['customer_id'])->get()->first();
            $data['brand'] = Brand::whereId($data['form']['brand_id'])->get()->first();
            $data['model'] = Modelling::whereId($data['form']['model_id'])->get()->first();
            return response()->json($data);
        } catch (Exception $e) {
            dd($e);
        }

    }



    /**
     * Update the status.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        try{
            $device = Device::where('barcode', $request->barcode)->first();

            Service::create([
                'device_id' => $device->id,
                'brand_id' => $device->brand_id,
                'model_id' => $device->model_id,
                'customer_id' => $device->customer_id,
                'barcode' => $device->barcode,
                'service_status' => 1,
            ]);

            Device::where('barcode', $request->barcode)->update(['status' => 1]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde servis işlemi başlatıldı ve kabul edilen cihazlar listesinden düşüldü.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
