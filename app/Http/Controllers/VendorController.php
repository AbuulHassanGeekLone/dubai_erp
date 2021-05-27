<?php

namespace App\Http\Controllers;

use DB;
use Session;
use JavaScript;
use App\Models\Region;
use App\Models\Vendor;
use App\Models\City;


use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Vendor';
        $vendors = DB::table('vendors')
            ->select('vendors.*', 'regions.name as region', 'cities.name as city')
            ->join('regions', 'regions.id', '=', 'vendors.region_id')
            ->join('cities', 'cities.id', '=', 'vendors.city_id')
            ->get();


        return view('vendor.index', compact('vendors'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $regions = Region::all();
        $cities = City::all();

        $regionCities = [];
        foreach ($cities as $key => $value) {
            $regionCities[$value->region_id][] = $value;
        }

        JavaScript::put([
            'regionCities' => $regionCities
        ]);

        $data['title'] = 'Vendor';

        return view('vendor.create', compact('regions', 'cities', 'regionCities'), $data);
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
            'mobile' => 'required',
            'region' => 'required',
            'city_id' => 'required',
            'rtn' => 'required',
        ]);

        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->region_id = $request->region;
        $vendor->city_id = $request->city_id;
        $vendor->address = $request->address;
        $vendor->rtn = $request->rtn;

        try {
            $vendor->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Vendor  already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }
        Session::flash('message', 'Vendor Added Successfully');
        Session::flash('class', 'success');
        if ($request->num == 1) {
            return redirect()->action('VendorController@index');
        } else {
            return redirect()->action('VendorController@create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function vendoredit($id)
    {
        $regions = Region::all();

        $cities = City::all();

        $regionCities = [];
        foreach ($cities as $key => $value) {
            $regionCities[$value->region_id][] = $value;
        }

        JavaScript::put([
            'regionCities' => $regionCities
        ]);

        $vendor = DB::table('vendors')
            ->select('vendors.*', 'regions.name as region', 'cities.name as city')
            ->join('regions', 'regions.id', '=', 'vendors.region_id')
            ->leftjoin('cities', 'cities.id', '=', 'vendors.city_id')
            ->where('vendors.id', $id)
            ->first();

        if (!$vendor) return abort(404);

        $data['title'] = 'Vendor';

        return view('vendor.edit', compact('vendor', 'regions', 'cities', 'regionCities'), $data);
    }

    public function vendorupdate($id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'region_id' => 'required',
            'city_id' => 'required',
            'rtn' => 'required|',

        ]);

        $vendor = Vendor::find($id);
        $vendor->name = $request->name;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->city_id = $request->city_id;
        $vendor->address = $request->address;
        $vendor->rtn = $request->rtn;

        try {
            $vendor->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Vendor  already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        Session::flash('message', 'Vendor Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('VendorController@index');
    }

    public function vendordelete($id)
    {
        $vendor = Vendor::where('id', $id)->first();
        $vendor->delete();

        return 'true';
    }
}
