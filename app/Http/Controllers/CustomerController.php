<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
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
        $customers = Customer::paginate(30);
        return view('customers.index',compact(['customers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            Customer::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'gsm' => $request->gsm,
                'address' => $request->address,
                'identity_number' => $request->identity_number,
                'type' => $request->type,
                'company_name' => $request->company_name,
                'tax_number' => $request->tax_number,
                'tax_authority' => $request->tax_authority,
            ]);

            return Redirect::back()->with('success', 'Yeni Müşteri Başarıyla Oluşturuldu.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Hay aksi! Müşteri eklerken bir hata ile karşılaşıldı.']]);
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
        $customer = Customer::whereId($id)->firstOrFail();
        return view('customers.edit', compact(['customer']));
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
            $customer = Customer::findOrFail($id);
            $data = $request->except('_token');
            $arr  = collect([]);
            $arr = $arr->merge($data);
            $customer->update($arr->toArray());
            $customer->save();
            return Redirect::back()->with('success', 'Müşteri başarıyla güncellendi!');
        }catch (Exception $e){
            //dd($e->getMessage());
            return Redirect::back()->withErrors(['error' => ['Müşteri güncellenirken bir hata oluştu!']]);
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
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return Redirect::back()->with('success', 'Müşteri sistemden başarıyla silindi, artık bu verileri geri alamayacaksınız.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withErrors(['errors' => ['Müşteri silinirken bir hata ile karşılaşıldı.']]);
        }
    }
}
