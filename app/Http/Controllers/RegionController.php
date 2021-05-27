<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Region;
use Illuminate\Http\Request;
use Response;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Region';
        $regions = Region::orderBy('name', 'ASC')->get();

        return view('region.index', compact('regions'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $region = new Region();
        $region->name = $request->region;

        try {
            $region->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return Response::json(array(
                    'code' => 1062,
                    'message' => "Region already exists!"
                ), 400);
            }
        }

        return $region;
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
            'name' => 'required',
        ]);

        $region = new Region();
        $region->name = $request->name;

        try {
            $region->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Region already exists!');
                Session::flash('class', 'danger');

                return back()->withInput($request->all);
            }
        }

        Session::flash('message', 'Region Created Successfully');
        Session::flash('class', 'success');

        return redirect()->action('RegionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }

    public function regiondelete($id)
    {
        $region = Region::where('id', $id)->first();
        $region->delete();

        return 'true';
    }

    public function regionupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required | unique:App\Region,name',
        ]);

        $region = Region::where('id', $id)->first();
        $region->name = $request->name;
        $region->save();
        Session::flash('message', 'Region Updated Successfully');
        Session::flash('class', 'success');

        return \redirect('region');
    }
}
