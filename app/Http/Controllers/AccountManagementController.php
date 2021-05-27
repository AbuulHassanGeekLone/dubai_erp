<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\AccountManagement;
use App\Models\AccountType;
use Illuminate\Support\Str;

class AccountManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Accounts Management';
        $account = DB::table('account_management')
            ->join('account_types', 'account_management.account_type', '=', 'account_types.id')
            ->select('account_management.*', 'account_types.name as account_type')
            ->get();

        $data['title'] = 'Accounts Management';

        return view('account.index', compact('account'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounttypes = AccountType::orderBy('name', 'ASC')->get();
        $data['title'] = 'Accounts Management';

        return view('account.create', $data, compact('accounttypes'));
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
            'account_type' => 'required| min:1',
            'account_name' => 'required',
            'opening_balanece' => 'numeric|min:0|nullable',
        ]);

        $ordered_uuid = (string)Str::orderedUuid();
        DB::beginTransaction();

        $account = new AccountManagement();
        $account->account_type = $request->account_type;
        $account->account_name = $request->account_name;
        $account->description = $request->account_description;
        $account->ordered_uuid = $ordered_uuid;
        $account->opening_balance = $request->opening_balanece ?: 0;

        try {
            $account->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Account name already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }
        switch ($request->account_type) {
            case 1:
                $journal2 = new Journal();
                //1 for debit
                $journal2->transection_type_id = 1;
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_type = 3;
                $journal2->account_id = $account->id;
                $journal2->amount = $request->opening_balanece;
                $journal2->account_type_id = 1;
                $journal2->description = 'Opening balance';

                $journal2->save();


                $journal = new Journal();
                //2 for credit
                $journal->transection_type_id = 2;
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_type = 3;
                $journal->account_id = 31;
                $journal->amount = $request->opening_balanece;
                $journal->account_type_id = 7;
                $journal->description = 'Opening balance';
                $journal->save();

                break;
            case 3:
                $journal2 = new Journal();
                //1 for debit
                $journal2->transection_type_id = 1;
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_type = 3;
                $journal2->account_id = $account->id;
                $journal2->amount = $request->opening_balanece;
                $journal2->account_type_id = 3;
                $journal2->description = 'Opening balance';

                $journal2->save();


                $journal = new Journal();
                //2 for credit
                $journal->transection_type_id = 2;
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_type = 3;
                $journal->account_id = 38;
                $journal->amount = $request->opening_balanece;
                $journal->account_type_id = 4;
                $journal->description = 'Opening balance';
                $journal->save();
                break;

            case 10:
                $journal2 = new Journal();
                //1 for debit
                $journal2->transection_type_id = 1;
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_type = 3;
                $journal2->account_id = 34;
                $journal2->amount = $request->opening_balanece;
                $journal2->account_type_id = 6;
                $journal2->description = 'Opening balance';
                $journal2->save();

                $journal = new Journal();
                //2 for credit
                $journal->transection_type_id = 2;
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_type = 3;
                $journal->account_id = $account->id;
                $journal->amount = $request->opening_balanece;
                $journal->account_type_id = 10;
                $journal->description = 'Opening balance';
                $journal->save();
                break;
            default:
                # code...
                break;
        }

        DB::commit();


        Session::flash('message', 'Account added Successfully');
        Session::flash('class', 'success');

        if ($request->num == 1) {
            return redirect()->action('AccountManagementController@index');
        } else {
            return redirect()->action('AccountManagementController@create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AccountManagement $accountManagement
     * @return \Illuminate\Http\Response
     */
    public function show(AccountManagement $accountManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AccountManagement $accountManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountManagement $accountManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AccountManagement $accountManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountManagement $accountManagement)
    {
        return 'hgfh';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AccountManagement $accountManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountManagement $accountManagement)
    {
        //
    }


    public function accountedit($id)
    {
        $account = AccountManagement::find($id);
        if (!$account) {
            abort(404);
        }
        $account_types = AccountType::orderBy('name', 'ASC')->get();
        $data['title'] = 'Account Management';

        return view('account.edit', compact('account', 'account_types'), $data);
    }

    public function accountupdate($id, Request $request)
    {
        $this->validate($request, [
            'account_type' => 'required',
            'account_name' => 'required',
            'opening_balanece' => 'numeric|min:0|nullable',
        ]);

        $account = AccountManagement::find($id);
        $account->account_type = $request->account_type;
        $account->account_name = $request->account_name;
        $account->description = $request->account_description;
        $account->opening_balance = $request->opening_balanece ?: 0;
        $account->status = $request->account_status;

        try {
            $account->save();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Account name already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        $affected = DB::table('journals')
            ->where('journal_uuid', $account->ordered_uuid)
            ->update(['amount' => $request->opening_balance]);

        Session::flash('message', 'Account Updated successfully');
        Session::flash('class', 'success');

        return redirect()->back()->withInput($request->all());
    }

    public function accountdelete($id)
    {
        $account = AccountManagement::where('id', $id)->first();
        DB::table('journals')->where('journal_uuid', $account->ordered_uuid)->delete();
        $account->delete();

        return 'true';
    }
}
