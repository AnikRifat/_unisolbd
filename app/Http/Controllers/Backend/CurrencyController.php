<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::latest()->orderBy('id', 'DESC')->get();

        return view('backend.currency.currency', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'country' => 'required|unique:currencies,country,except,id',
            'currency' => 'required',
            'code' => 'required',
            'symbol' => 'required',
        ]);
        Currency::insert([
            'country' => $request->country,
            'currency' => $request->currency,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with(notification('Currency Add Successfully', 'success'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'country' => 'required',
            'country' => 'required|unique:currencies,country,'.$id,
            'currency' => 'required',
            'code' => 'required',
            'symbol' => 'required',
        ]);
        Currency::findOrFail($id)->update([
            'country' => $request->country,
            'currency' => $request->currency,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with(notification('Currency Update Successfully', 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currency::findOrFail($id)->delete();

        return redirect()->back()->with(notification('Currency Active Successfully', 'success'));
    }

    public function ActiveCurrency($id)
    {
        Currency::where('id', '=', $id)->update(['status' => 1]);
        Currency::where('id', '!=', $id)->update(['status' => null]);

        return redirect()->back()->with(notification('Currency Active Successfully', 'success'));
    }
}
