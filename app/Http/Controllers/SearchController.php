<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    /**
     * @param Request $request
     */
    public function barcode(Request $request)
    {
        $response = DB::table('services')
            ->where('barcode', $request->barcode)
            ->get();
        dd($response);
    }

    /**
     * @param Request $request
     */
    public function serial(Request $request)
    {

    }
}
