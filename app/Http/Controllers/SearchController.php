<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function barcode(Request $request)
    {
        try {
            $response = DB::table('services')
                ->where('barcode', $request->barcode)
                ->first();

            if ($response) {

                if($response->service_status == 1)
                    $status = "Sıra Bekliyor";
                elseif($response->service_status == 2)
                    $status = "Onarım İşleminde";
                elseif($response->service_status == 3)
                    $status = "Merkeze Gönderildi";
                elseif($response->service_status == 4)
                    $status = "Parça Bekliyor";
                elseif($response->service_status == 5)
                    $status = "Onay Bekliyor";
                elseif($response->service_status == 6)
                    $status = "Cihazınız Hazır";
                elseif($response->service_status == 7)
                    $status = "Kargolandı";
                elseif($response->service_status == 255)
                    $status = "Teslim Edildi";


                return Redirect::back()->with('success', 'Cihaz' . ' (' . $status . ') Durumunda');
            } else {
                return Redirect::back()->with('success', 'Cihaz bulunamadı veya henüz servis durumunda değil!');
            }
        } catch (Exception $e) {

        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serial(Request $request)
    {
        try {
            $response = DB::table('services')
                ->join('devices','services.device_id','=','devices.id')
                ->where('serial_number', $request->serial_number)
                ->first();

            if ($response) {
                if($response->service_status == 1)
                    $status = "Sıra Bekliyor";
                elseif($response->service_status == 2)
                    $status = "Onarım İşleminde";
                elseif($response->service_status == 3)
                    $status = "Merkeze Gönderildi";
                elseif($response->service_status == 4)
                    $status = "Parça Bekliyor";
                elseif($response->service_status == 5)
                    $status = "Onay Bekliyor";
                elseif($response->service_status == 6)
                    $status = "Cihazınız Hazır";
                elseif($response->service_status == 7)
                    $status = "Kargolandı";
                elseif($response->service_status == 255)
                    $status = "Teslim Edildi";


                return Redirect::back()->with('success', 'Cihaz' . ' (' . $status . ') Durumunda');
            } else {
                return Redirect::back()->with('success', 'Cihaz bulunamadı veya henüz servis durumunda değil!');
            }
        } catch (Exception $e) {

        }


    }
}
