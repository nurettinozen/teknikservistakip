<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Customer;
use App\Device;
use App\Modelling;
use peal\barcodegenerator\BarCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = DB::table('devices')->where('status', 0)->paginate(20);
        //$brands = DB::table('brands')->where('id',1)->get();
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
                'status' => 0,
            ]);

            return Redirect::back()->with('success', 'Yeni Servis Formu Başarıyla Oluşturuldu. Barkod yazdırmak için yazdır butonuna tıklayınız.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Müşteri eklerken bir hata ile karşılaşıldı.']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //            $bar = App::make('BarCode');
//            $barcontent = $bar->barcodeFactory("BarCode")
//                ->renderBarcode(
//                    $filepath = '',
//                    $text = $request->customer_id . time() . rand(0, 9999),
//                    $size = '50',
//                    $orientation = "horizontal",
//                    $code_type = "codabar",// code_type : code128,code39,code128b,code128a,code25,codabar
//                    $print = true,
//                    $sizefactor = 1
//                );
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
