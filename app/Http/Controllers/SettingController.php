<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use DB;
use Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::all();

        return view('setting.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'company_email' => 'required',
            'company_phone' => 'required',
            'company_trn' => 'required|min:0',
            'company_vat' => 'required|min:0',

        ]);

        DB::table('settings')
            ->where('id', 1)
            ->update(['title' => $request->company_name]);
        DB::table('settings')
            ->where('id', 2)
            ->update(['title' => $request->company_address]);
        DB::table('settings')
            ->where('id', 3)
            ->update(['title' => $request->company_email]);
        DB::table('settings')
            ->where('id', 4)
            ->update(['title' => $request->company_phone]);
        DB::table('settings')
            ->where('id', 5)
            ->update(['title' => $request->company_trn]);
        DB::table('settings')
            ->where('id', 6)
            ->update(['title' => $request->company_vat]);

        Session::flash('message', 'Setting changed Successfully');
        Session::flash('class', 'success');

        return redirect()->action('SettingController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
