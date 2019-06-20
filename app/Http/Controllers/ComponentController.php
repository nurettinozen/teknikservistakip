<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Component;
use App\Modelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ComponentController extends Controller
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
        $components = DB::table('components')
            ->join('brands','components.brand_id','=', 'brands.id')
            ->join('modellings','components.model_id','=','modellings.id')
            ->paginate(20);

        return view('components.index', compact(['components']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $modellings = Modelling::all();
        return view('components.create', compact(['brands', 'modellings']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Component::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'component_name' => $request->component_name,
                'stock' => $request->stock,
                'get_price' => $request->get_price,
                'sell_price' => $request->sell_price,
            ]);
            return Redirect::back()->with('success', 'Yeni Model Başarıyla Oluşturuldu.');
        }catch (Exception $e){
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Model eklerken bir hata ile karşılaşıldı.']]);
        }
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
        //
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

    public function getModels(Request $request)
    {
        $models = DB::table("modellings")->where("brand_id",$request->brand_id)->pluck("model_name", "id");
        return response()->json($models);
    }
}
