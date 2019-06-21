<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Merkeze Gönderildi
    /**
     * @param Request $request
     * @return mixed
     */
    public function send_center(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 3]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Onarım İşleminde

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function repair_start(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 2]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Parça Bekliyor

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function components_waiting(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 4]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Onay Bekliyor

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm_waiting(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 5]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Cihazınız Hazır

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function device_ready(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 6]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Kargolandı

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shipping(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 7]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }

    // Teslim Edildi

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delivered(Request $request)
    {
        try {
            Service::where('barcode', $request->barcode)->update(['service_status' => 255]);
            return Redirect::back()->with('success', 'Başarılı bir şekilde güncellendi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! İşlem sırasında bir hata ile karşılaşıldı.']]);
        }
    }
}
