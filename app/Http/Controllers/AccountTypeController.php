<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\transectionType;
use Illuminate\Http\Request;
use Session;
use DB;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tTypes = transectionType::orderBy('title', 'ASC')->get();
        $accountTypes = DB::table('account_types')
            ->select('account_types.*', 'transection_types.title as type', 'transection_types.id as tid')
            ->join('transection_types', 'transection_types.id', '=', 'account_types.transection_type_id')
            ->get();
        $data['title'] = 'Accounts Types';

        return view('Account.account_type', $data, compact('accountTypes', 'tTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $accountType = new AccountType();
        $accountType->name = $request->accountType;
        $accountType->save();
        $accountType = AccountType::orderBy('name', 'ASC')->get();

        return $accountType;
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
            'name' => 'required | unique:App\AccountType,name  ',
            'transection_type_id' => 'required',

        ]);
        $AccountType = new AccountType();
        $AccountType->name = $request->name;
        $AccountType->transection_type_id = $request->transection_type_id;
        $AccountType->save();
        Session::flash('message', 'Account Updated Successfully');
        Session::flash('class', 'success');

        return \redirect('accountType');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountType $accountType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountType $accountType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountType $accountType)
    {
        //
    }

    public function accounttypedelete($id)
    {
        $AccountType = AccountType::where('id', $id)->first();
        $AccountType->delete();

        return 'true';
    }

    public function accountupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required | unique:App\AccountType,name',
            'transection_type_id' => 'required',

        ]);

        $AccountType = AccountType::where('id', $id)->first();
        $AccountType->name = $request->name;
        $AccountType->transection_type_id = $request->transection_type_id;
        $AccountType->save();
        Session::flash('message', 'Account Updated Successfully');
        Session::flash('class', 'success');

        return \redirect('accountType');
    }
}
