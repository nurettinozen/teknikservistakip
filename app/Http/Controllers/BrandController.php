<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
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
        $brands = Brand::all();
        return view('brands.index', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
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
            Brand::create([
                'brand_name' => $request->brand_name,
            ]);
            return Redirect::back()->with('success', 'Yeni Marka Başarıyla Oluşturuldu.');
        }catch (Exception $e){
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Marka eklerken bir hata ile karşılaşıldı.']]);
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
        $brand = Brand::whereId($id)->firstOrFail();
        return view('brands.edit', compact(['brand']));
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
        try{
            $brand = Brand::findOrFail($id);
            $data = $request->except('_token');
            $arr  = collect([]);
            $arr = $arr->merge($data);
            $brand->update($arr->toArray());
            $brand->save();
            return Redirect::back()->with('success', 'Marka başarıyla güncellendi!');
        }catch (Exception $e){
            //dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Marka güncellenirken bir hata oluştu!']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return Redirect::back()->with('success', 'Marka sistemden başarıyla silindi, artık bu verileri geri alamayacaksınız.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['errors' => ['Marka silinirken bir hata ile karşılaşıldı.']]);
        }
    }
}
