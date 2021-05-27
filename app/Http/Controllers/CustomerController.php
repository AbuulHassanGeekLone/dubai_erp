<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Session;
use Illuminate\Http\Request;
use DB;
use JavaScript;
use App\Models\City;
use App\Models\Journal;
use App\Models\Region;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = DB::table('customers')
            ->select('customers.*', 'regions.name as region', 'cities.name as city')
            ->join('regions', 'regions.id', '=', 'customers.region_id')
            ->join('cities', 'cities.id', '=', 'customers.city_id')
            ->get();
        $data['title'] = 'Customer';

        return view('customer.index', compact('customers'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::orderBy('name', 'ASC')->get();
        $cities = City::all();

        $regionCities = [];
        foreach ($cities as $key => $value) {
            $regionCities[$value->region_id][] = $value;
        }

        JavaScript::put([
            'regionCities' => $regionCities
        ]);

        $data['title'] = 'Customer';

        return view('customer.create', $data, compact('regions', 'regionCities'));
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
            'region' => 'required',
            'city_id' => 'required',
        ]);


        $ordered_uuid = (string)Str::orderedUuid();

        DB::beginTransaction();

        $opening_balance = $request->opening_balance;
        if (!$opening_balance) {
            $opening_balance = 0;
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->opening_balance = $opening_balance;
        $customer->email = $request->email;
        $customer->ordered_uuid = $ordered_uuid;
        $customer->address = $request->address;
        $customer->region_id = $request->region;
        $customer->city_id = $request->city_id;
        $customer->rtn = $request->rtn;

        try {
            $customer->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            $errorCode = $e->errorInfo[1];
            $errorMsg = $errorCode = $e->errorInfo[2];

            if ($errorCode == 1062) {
                Session::flash('message', 'Customer name already exists');
                Session::flash('class', 'danger');
            } else {
                Session::flash('message', $errorMsg);
                Session::flash('class', 'danger');
            }

            return redirect()->back()->withInput($request->all());
        }

        $journal2 = new Journal();
        //1 for debit
        $journal2->transection_type_id = 1;
        $journal2->journal_uuid = $ordered_uuid;
        $journal2->s_p_am_type = 1;
        $journal2->account_id = $customer->id;
        $journal2->amount = $opening_balance;
        $journal2->account_type_id = 0;
        $journal2->description = 'Opening balance';

        $journal2->save();

        $journal = new Journal();
        //2 for credit
        $journal->transection_type_id = 2;
        $journal->journal_uuid = $ordered_uuid;
        $journal->s_p_am_type = 3;
        $journal->account_id = 38;
        $journal->amount = $opening_balance;
        $journal->account_type_id = 4;
        $journal->description = 'Opening balance';

        $journal->save();

        DB::commit();

        Session::flash('message', 'customer added Successfully');
        Session::flash('class', 'success');

        if ($request->num == 1) {
            return redirect()->action('CustomerController@index');
        } else {
            return redirect()->action('CustomerController@create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function customeredit(Request $request, $customer)
    {
        $customer = Customer::findOrFail($customer);

        if (!$customer) return abort(404);

        $regions = Region::orderBy('name', 'ASC')->get();
        $cities = City::all();

        $regionCities = [];
        foreach ($cities as $key => $value) {
            $regionCities[$value->region_id][] = $value;
        }

        JavaScript::put([
            'regionCities' => $regionCities
        ]);

        $data['title'] = 'Customer';

        return view('customer.edit', compact('customer', 'regions', 'regionCities'), $data);
    }

    public function customerupdate($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'region' => 'required',
            'city_id' => 'required'
        ]);

        $opening_balance = $request->opening_balance;
        if (!$opening_balance) {
            $opening_balance = 0;
        }

        $customer = Customer::find($id);

        $customer->name = $request->name;
        $customer->mobile = $request->mobile;

        $customer->opening_balance = $opening_balance;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->rtn = $request->rtn;
        $customer->region_id = $request->region;
        $customer->city_id = $request->city_id;

        try {
            $customer->save();
        } catch (\Illuminate\Database\QueryException $e) {

            $error = $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Customer name already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        $affected = DB::table('journals')
            ->where('journal_uuid', $customer->ordered_uuid)
            ->update(['amount' => $opening_balance]);

        Session::flash('message', 'customer Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('CustomerController@index');
    }

    public function customerdelete($id)
    {
        $customer = Customer::where('id', $id)->first();
        $affected = DB::table('journals')
            ->where('journal_uuid', $customer->ordered_uuid)
            ->delete();
        $customer->delete();

        return 'true';
    }
}
