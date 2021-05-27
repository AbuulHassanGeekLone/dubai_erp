<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region = Region::all();
        $data['title'] = 'City';
        $city = City::orderBy('name', 'ASC')->get();
        $joindata = [];
        $joindata = DB::table('cities')
            ->join('regions', 'regions.id', '=', 'cities.region_id')
            ->select(
                'regions.name as region_name',
                'regions.id as region_id',
                'cities.name as city_name',
                'cities.id as city_id'
            )
            ->get();


        return view('city.index', compact('city', 'region', 'joindata'), $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:App\City,name',
            'region_id' => 'required',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->region_id = $request->region_id;
        $city->save();
        $city = City::orderBy('name', 'ASC')->get();

        return redirect()->route('city_view');
    }

    public function citycreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'region_id' => 'required',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->region_id = $request->region_id;

        try {
            $city->save();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return Response::json(array(
                    'code' => 1062,
                    'message' => "Region already exists!"
                ), 400);
            } else {
                return Response::json(array(
                    'code' => 404,
                    'message' => "Region already exists!"
                ), 422);
            }
        }

        return $city;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->name;
        $city->region_id = $request->region_id;
        Session::flash('message', 'Region Created Successfully');
        Session::flash('class', 'success');
        $city->save();

        return redirect()->action('CityController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function citydelete($id)
    {
        $city = City::where('id', $id)->first();
        $city->delete();

        return 'true';
    }

    public function cityupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required | unique:App\City,name',
            'region_id' => 'required',
        ]);

        $city = City::where('id', $id)->first();
        $city->name = $request->name;
        $city->region_id = $request->region_id;
        $city->save();
        Session::flash('message', 'City Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->route('city_view');
    }

    public function cityRegion($region)
    {
        $city = City::where('region_id', $region)->get();

        return $city;
    }
}
