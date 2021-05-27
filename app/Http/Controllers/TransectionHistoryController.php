<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\transectionHistory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JavaScript;

class TransectionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $model_type = $request->get('modelType');
        $model_name = $request->get('model_name');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');

        $customers = Customer::all();
        $vendors = Vendor::all();

        JavaScript::put([
            'customers' => $customers,
            'vendors' => $vendors
        ]);

        $transections = [];

        if ($search) {
            $transections = DB::table('transection_histories')
                ->select('transection_types.title as aname',
                    'transection_histories.id', 'transection_histories.created_at', 'transection_histories.number', 'transection_histories.description',
                    'transection_histories.amount', 'transection_histories.paid')
                ->join('transection_types', 'transection_types.id', '=', 'transection_histories.transection_type_id');

            if ($date_from && $date_to) {
                $transections->whereBetween('transection_histories.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59']);
            }

            if ($model_type) {
                $transections->where('transection_histories.transection_type_id', '=', $model_type);
            }

            if ($model_name) {
                $transections->where('transection_histories.account_id', '=', $model_name);
            }

            $transections = $transections->get();


        }

        $data['title'] = 'Account Register';

        return view('register.register', $data, compact('transections'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\transectionHistory $transectionHistory
     * @return \Illuminate\Http\Response
     */
    public function show(transectionHistory $transectionHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\transectionHistory $transectionHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(transectionHistory $transectionHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\transectionHistory $transectionHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transectionHistory $transectionHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\transectionHistory $transectionHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(transectionHistory $transectionHistory)
    {
        //
    }
}
