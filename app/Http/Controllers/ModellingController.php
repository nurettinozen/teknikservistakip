<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Modelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ModellingController extends Controller
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
        $modellings = DB::table('modellings')
            ->leftJoin('brands','modellings.brand_id','=','brands.id')
            ->paginate(20);
        return view('modellings.index', compact(['modellings']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('modellings.create', compact(['brands']));
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
            Modelling::create([
                'brand_id' => $request->brand_id,
                'model_name' => $request->model_name,
            ]);
            return Redirect::back()->with('success', 'Yeni Model Başarıyla Oluşturuldu.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Model eklerken bir hata ile karşılaşıldı.']]);
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
        //
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
