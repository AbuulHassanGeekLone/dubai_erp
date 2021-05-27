<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Session;
use JavaScript;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\AccountManagement;
use App\Models\Journal;
use App\Exports\journalExport;
use Maatwebsite\Excel\Facades\Excel;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->get('search');
        $date_from = date('Y-m-d');
        $date_to = date('Y-m-d');
        $s_p_am_type = null;
        $account_id = null;
        $account_type_id = null;
        $result = "";

        if ($search) {

            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');
            $string = $request->accountName;
            $account = explode(",", $string);


            if ($request->accountName) {

                $s_p_am_type = $account[1];
                $account_id = $account[0];
                $account_type_id = $account[2];

                if ($s_p_am_type == 1) {
                    $result = "debit";
                } else if ($s_p_am_type == 2) {
                    $result = "credit";
                } else {
                    if ($account_type_id == 11 || $account_type_id == 1) {
                        $result = "debit";
                    }
                }
            }


        }
        $s_p_am_type_where = "";
        if ($s_p_am_type) {
            $s_p_am_type_where = "and journals.s_p_am_type = $s_p_am_type";
        }
        $account_id_where = "";
        if ($account_id) {
            $account_id_where = "and journals.account_id = $account_id";
        }
        $account_type_id_where = "";
        if ($account_type_id) {
            $account_type_id_where = "and journals.account_type_id = $account_type_id";
        }

        $sql = "
            SELECT
            *,
            (
                CASE
                    WHEN s_p_am_type = 1 THEN (SELECT name FROM customers WHERE id =journals.account_id)
                    WHEN s_p_am_type = 2 THEN (SELECT name FROM vendors WHERE id =journals.account_id)
                ELSE
                    (SELECT account_name FROM account_management WHERE id =journals.account_id)
                END
            ) account_name
            FROM journals
            WHERE 1=1
                $s_p_am_type_where
                $account_id_where
                $account_type_id_where and
                journals.created_at BETWEEN '$date_from 00:00:00' AND '$date_to 23:59:59' and
                journals.advance_reverse = 0
            order by journal_uuid asc
        ";

        $journal = DB::select($sql);

        $customers = Customer::all();
        $customers->map(function ($row) {
            $row['account_name'] = ucfirst($row->name) . ' (C)';
            $row['account_type'] = 12;
            $row['account_type_ro'] = 0;
            $row['type'] = 1;

            return $row;
        });

        $vendors = Vendor::all();
        $vendors->map(function ($row) {
            $row['account_name'] = ucfirst($row->name) . ' (V)';
            $row['account_type'] = 13;
            $row['account_type_ro'] = 0;
            $row['type'] = 2;

            return $row;
        });

        $accountmanager = AccountManagement::all();
        $accountmanager->map(function ($row) {
            $row['account_name'] = ucfirst($row->account_name);
            $row['account_type_ro'] = $row['account_type'];
            $row['type'] = 3;

            return $row;
        });

        $accounts = $accountmanager->concat($customers)->concat($vendors);

        $debitAccounts = [];
        $creditAccounts = [];
        $creditAccounts[0] = [];
        $creditAccounts[1] = [];

        foreach ($accounts as $key1 => $value1) {
            if (in_array($value1->account_type, [1, 11])) {
                $debitAccounts[] = $value1;

                foreach ($accounts as $key2 => $value2) {
                    if (in_array($value2->account_type, [1, 3, 7, 10, 11, 12, 13])) {
                        $creditAccounts[0][$value2->account_type][$value2->id] = $value2;
                    }
                }
            } else if (in_array($value1->account_type, [3, 6, 7, 10, 12, 13])) {
                $debitAccounts[] = $value1;

                foreach ($accounts as $key2 => $value2) {
                    if (in_array($value2->account_type, [1, 11])) {
                        $creditAccounts[1][$value2->account_type][$value2->id] = $value2;
                    }
                }
            }
        }

        $newCredits = [];
        foreach ($creditAccounts as $k1 => $val1) {
            foreach ($val1 as $key => $value) {
                if (!is_array($value)) {
                    $newCredits[$k1][] = $value;
                } else {
                    foreach ($value as $k => $val) {
                        $newCredits[$k1][] = $val;
                    }
                }
            }
        }


        JavaScript::put([
            'accountParents' => $newCredits
        ]);


        $data['title'] = 'Journal';

        return view('account.index_journal', $data, compact('journal', 'accounts', 'debitAccounts', 'creditAccounts', 'result'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Journal Account';
        $account_type = DB::table('account_management')->select('id', 'account_name')->get();

        return view('account.journal', compact('account_type'), $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordered_uuid = (string)Str::orderedUuid();

        DB::transaction(function () use ($request, $ordered_uuid) {

            $string = $request->credit_account;
            $credit = explode(",", $string);
            $s_p_am_type1 = $credit[1];
            $account_id1 = $credit[0];
            $account_type_id1 = $credit[2];

            $string = $request->debit_account;
            $debit = explode(",", $string);
            $s_p_am_type = $debit[1];
            $account_id = $debit[0];
            $account_type_id = $debit[2];

            //journal
            $journal2 = new Journal();
            //1 for debit
            $journal2->transection_type_id = 1;
            $journal2->journal_uuid = $ordered_uuid;
            $journal2->s_p_am_type = $s_p_am_type;
            $journal2->account_id = $account_id;
            $journal2->amount = $request->amount;
            if ($s_p_am_type != 3) {
                $journal2->account_type_id = 0;
            } else {
                $journal2->account_type_id = $account_type_id;
            }

            $journal2->description = $request->description;
            $journal2->save();


            $journal = new Journal();
            //2 for credit
            $journal->transection_type_id = 2;
            $journal->journal_uuid = $ordered_uuid;
            $journal->s_p_am_type = $s_p_am_type1;
            $journal->account_id = $account_id1;
            $journal->amount = $request->amount;
            if ($s_p_am_type1 != 3) {
                $journal->account_type_id = 0;
            } else {
                $journal->account_type_id = $account_type_id1;
            }

            $journal->description = $request->description;

            $journal->save();

        });

        Session::flash('message', 'journal created Successfully');
        Session::flash('class', 'success');

        return redirect()->action('JournalController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journa2 = Journal::find($id);
        $journal = DB::table('journals')
            ->select('journals.*')
            ->where('journal_uuid', $journa2->journal_uuid)
            ->orderBy('journal_uuid', 'asc')
            ->get();

        return $journal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function journal_Edit($id)
    {

    }

    public function journal_update($id, Request $request)
    {

        $ordered_uuid = (string)Str::orderedUuid();

        DB::transaction(function () use ($request, $ordered_uuid) {

            $string = $request->credit_account;
            $credit = explode(",", $string);
            $s_p_am_type1 = $credit[1];
            $account_id1 = $credit[0];
            $account_type_id1 = $credit[2];

            $string = $request->debit_account;
            $debit = explode(",", $string);
            $s_p_am_type = $debit[1];
            $account_id = $debit[0];
            $account_type_id = $debit[2];

            //journal
            $journal2 = Journal::find($request->debit_id);
            //1 for debit
            $journal2->transection_type_id = 1;

            $journal2->s_p_am_type = $s_p_am_type;
            $journal2->account_id = $account_id;
            $journal2->amount = $request->amount;
            if ($s_p_am_type != 3) {
                $journal2->account_type_id = 0;
            } else {
                $journal2->account_type_id = $account_type_id;
            }

            $journal2->description = $request->description;
            $journal2->save();


            $journal = Journal::find($request->credit_id);
            //2 for credit
            $journal->transection_type_id = 2;
            $journal->s_p_am_type = $s_p_am_type1;
            $journal->account_id = $account_id1;
            $journal->amount = $request->amount;
            if ($s_p_am_type1 != 3) {
                $journal->account_type_id = 0;
            } else {
                $journal->account_type_id = $account_type_id1;
            }

            $journal->description = $request->description;

            $journal->save();

        });

        Session::flash('message', 'journal updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('JournalController@index');

    }

    public function delete($id)
    {
        $d_id = Journal::where('id', $id)->first();
        $journal = Journal::where('journal_uuid', $d_id->journal_uuid)->delete();

        return $d_id->journal_uuid;
    }

    public function export()
    {
        return Excel::download(new journalExport, 'journal.xlsx');
    }
}
