<?php

namespace App\Http\Controllers;

use App\Models\AccountManagement;
use App\Models\transectionHistory;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

use Session;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\PurchaseDetail;
use App\Models\Journal;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Models\SPAMType;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = DB::table('purchases')
            ->join('vendors', 'purchases.vendor_id', '=', 'vendors.id')
            ->select('purchases.*', 'vendors.name as vendor')
            ->get();
        $data['title'] = 'Purchases';

        return view('purchase.index', compact('purchases'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // (select unit_price from purchase_details where unit_id=products.id order by date desc imit 1) as last_price
        $vendors = Vendor::orderBy('name', 'ASC')->get();

        $products = DB::select("
                select id, name, last_purchase_price,last_sale_price , tquantity, squantity, (tquantity - squantity) remaining
                from (
                    select
                        id, name,
                        (select unit_price from purchase_details where product_id=products.id order by created_at desc limit 1)
                         as last_purchase_price,
                        (select sale_price from purchase_details where product_id=products.id order by created_at desc limit 1)
                         as last_sale_price,
                        (select ifNull(sum(quantity), 0) from purchase_details where product_id = products.id) tquantity,
                        (select ifNull(sum(quantity), 0) from sale_details where product_id = products.id) squantity
                    from products
                ) temp
            ");

        $data['title'] = 'Purchase';

        return view('purchase.create', $data, compact('products', 'vendors'));
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

        $pid = DB::transaction(function () use ($request, $ordered_uuid) {

            $vendor_id = array_slice($request->po, 0, 1)[0]['v_id'];

            $purchase = new Purchase();
            $purchase->vendor_id = $vendor_id;
            $purchase->total_amount = $request->t_amount;
            $purchase->ordered_uuid = $ordered_uuid;
            $purchase->save();

            //journal
            $journal2 = new Journal();
            //1 for debit
            $journal2->transection_type_id = 1;
            $journal2->journal_uuid = $ordered_uuid;
            $journal2->s_p_am_id = $purchase->id;
            $journal2->s_p_am_type = SPAMType::ACCOUNT_MANAGER;
            $journal2->account_id = 26;
            $journal2->account_type_id = 2;
            $journal2->amount = $request->t_amount;
            $journal2->description = 'Purchase From Vendor';
            $journal2->save();


            $journal = new Journal();
            //2 for credit
            $journal->transection_type_id = 2;
            $journal->s_p_am_id = $purchase->id;
            $journal->journal_uuid = $ordered_uuid;
            $journal->s_p_am_type = SPAMType::PURCHASE;
            $journal->account_id = $vendor_id;
            $journal->account_type_id = 0;
            $journal->amount = $request->t_amount;
            $journal->description = 'Purchase From Vendor';

            $journal->save();

            foreach ($request->po as $key => $value) {
                $purchase_detail = new PurchaseDetail();
                $purchase_detail->purchase_id = $purchase->id;
                $purchase_detail->product_id = $value['p_id'];
                $purchase_detail->quantity = $value['p_quantity'];
                $purchase_detail->unit_price = $value['p_price'];
                $purchase_detail->sale_price = $value['s_price'];
                $purchase_detail->discount = $value['discount'];
                $purchase_detail->save();
            }

            return $purchase->id;
        });

        Session::flash('message', 'Purchase Added Successfully');
        Session::flash('class', 'success');

        return redirect()->action('PurchaseController@purchaseedit', ['id' => $pid]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function purchasedelete($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        DB::table('purchase_details')->where('purchase_id', $id)->delete();
        DB::table('journals')->where('ordered_uuid', $purchase->ordered_uuid)->delete();
        $purchase->delete();

        return 'true';
    }

    public function purchaseedit($id)
    {
        $purchase1 = Purchase::find($id);
        $vendor_id = $purchase1->vendor_id;
        $oCustomer = Vendor::find($vendor_id);
        if (!$purchase1) {
            abort(404);
        }
        $status = $purchase1->status;

        if (is_null($purchase1->paid_amount)) {
            $paid = 0;
        } else {
            $paid = $purchase1->paid_amount;
        }

        $acountblns = DB::select("
            SELECT id a_id, account_type as type, account_name as name,
            (
                SELECT sum(amount) amount
                FROM `journals`
                WHERE s_p_am_type = 3 and
                account_type_id = account_management.account_type and
                account_id = account_management.id and
                transection_type_id = 1
                group by transection_type_id
            ) debit,
            (
                SELECT sum(amount) amount
                FROM `journals`
                WHERE s_p_am_type = 3 and
                account_type_id = account_management.account_type and
                account_id = account_management.id and
                transection_type_id = 2
                group by transection_type_id
            ) credit
            FROM account_management WHERE account_type IN (1, 11)
        ");


        $banks = [];
        $cash = [];
        foreach ($acountblns as $key => $value) {
            if ($value->type == 1) {
                $banks[] = $value;
            } else {
                $cash[$value->type] = $value;
            }
        }


        $purchases = DB::table('purchase_details')
            ->join('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('vendors', 'purchases.vendor_id', '=', 'vendors.id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->select('purchases.id', 'vendors.id as v_id', 'vendors.name as vendor', 'purchase_details.quantity', 'purchase_details.unit_price', 'purchase_details.sale_price', 'purchase_details.discount', 'products.id as p_id', 'products.name as product')
            ->where('purchases.id', '=', $id)
            ->get();

        $vendors = Vendor::orderBy('name', 'ASC')->get();

        $products = DB::select("
                select id, name, last_purchase_price,last_sale_price , tquantity, squantity, (tquantity - squantity) remaining
                from (
                    select
                        id, name,
                        (select unit_price from purchase_details where product_id=products.id order by created_at desc limit 1)
                         as last_purchase_price,
                        (select sale_price from purchase_details where product_id=products.id order by created_at desc limit 1)
                         as last_sale_price,
                        (select ifNull(sum(quantity), 0) from purchase_details where product_id = products.id) tquantity,
                        (select ifNull(sum(quantity), 0) from sale_details where product_id = products.id) squantity
                    from products
                ) temp
            ");


        $debit = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
              s_p_am_id is null and
                s_p_am_type = 2 and
                transection_type_id = 1 and
                account_id = $vendor_id and
                account_type_id = 0 and
                advance_reverse = 0
                ) temp
        ");

        $credit = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
              s_p_am_id is null and
                s_p_am_type = 2 and
                transection_type_id = 2 and
                account_id = $vendor_id and
                account_type_id = 0 and
                advance_reverse = 0
            ) temp
        ");

        $creditReverse = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
              s_p_am_type = 2 and
              account_id = $vendor_id and
              account_type_id = 0 and
              advance_reverse = 1
              ) temp
        ");

        $vendorCredit = $credit[0]->amount + $creditReverse[0]->amount;
        $vendorCredit = $debit[0]->amount - $vendorCredit;

        $data['title'] = 'Purchase';

        $disabledProducts = [];
        foreach ($purchases as $key => $value) {
            $disabledProducts[] = $value->p_id;
        }

        return view('purchase.edit', $data, compact('products','oCustomer', 'vendorCredit', 'disabledProducts', 'acountblns', 'vendors', 'purchases', 'id', 'status', 'paid'));
    }

    public function purchaseupdate(Request $request, $id)
    {

        $tr = DB::transaction(function () use ($request, $id) {

            $vendor_id = array_slice($request->po, 0, 1)[0]['v_id'];

            DB::table('purchase_details')->where('purchase_id', $id)->delete();
            $p = Purchase::find($id);
            $ordered_uuid = $p->ordered_uuid;
            Purchase::where('id', $id)->delete();

            $purchase = new Purchase();
            $purchase->id = $id;
            $purchase->vendor_id = $vendor_id;
            $purchase->total_amount = $request->t_amount;
            $purchase->paid_amount = 0;
            $purchase->ordered_uuid = $ordered_uuid;
            $purchase->status = 0;

            $purchase->save();

            $affected = DB::table('journals')
                ->where('journal_uuid', $ordered_uuid)
                ->update(['amount' => $purchase->total_amount]);

            foreach ($request->po as $key => $value) {
                $purchase_detail = new PurchaseDetail();
                $purchase_detail->purchase_id = $purchase->id;
                $purchase_detail->product_id = $value['p_id'];
                $purchase_detail->quantity = $value['p_quantity'];
                $purchase_detail->unit_price = $value['p_price'];
                $purchase_detail->sale_price = $value['s_price'];
                $purchase_detail->discount = $value['discount'];
                $purchase_detail->save();
            }
        });

        Session::flash('message', 'Purchase Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('PurchaseController@purchaseedit', ['id' => $id]);
    }

    public function purchasepayupdate(Request $request, $id)
    {
        $string = $request->input('method');
        $credit = array_pad( explode(",", $string), 4, "");

        $method = 'Advance payment';
        if ($credit[3] != -1) {
            $account_id1 = $credit[0];
            $method1 = AccountManagement::find($account_id1);
            $method = $method1->account_name;
        }

        $ordered_uuid = (string)Str::orderedUuid();

        $id = DB::transaction(function () use ($request, $id, $ordered_uuid, $method, $credit) {

            $final_paid = $request->amount_paid;
            $total = $request->total_amount;
            if ($request->p_paid) {
                $final_paid = $request->p_paid + $request->amount_paid;
            }

            if ($total == $final_paid) {

                $status = 1;
            } else {

                $status = 2;
            }

            $affected = DB::table('purchases')
                ->where('id', $id)
                ->update(['status' => $status, 'type' => $method, 'pay_date' => $request->pay_date, 'paid_amount' => $final_paid, 'total_amount' => $request->total_amount]);

                $account_id = $credit[0];
                $s_p_am_type = $credit[1];
                $account_type_id = $credit[2];

            if ($credit[3] == -1) {

                $journal2 = new Journal();
                $journal2->transection_type_id = 1; //2 for credit
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_id = $id;
                $journal2->account_type_id = $account_type_id;
                $journal2->s_p_am_type = $s_p_am_type;
                $journal2->account_id = $account_id;
                $journal2->amount = $request->amount_paid;
                $journal2->description = 'Advance Reverse';
                $journal2->advance_reverse = 1;
                $journal2->save();

                $journal = new Journal();
                $journal->transection_type_id = 2; //1 for debit
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_id = $id;
                $journal->account_id = $request->v_id;
                $journal->s_p_am_type = SPAMType::PURCHASE;
                $journal->account_type_id = 0;
                $journal->amount = $request->amount_paid;
                $journal->description = 'Advance Reverse';
                $journal->advance_reverse = 1;
                $journal->save();

            }

                $journal2 = new Journal();
                $journal2->transection_type_id = 1; //1 for debit
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_id = $id;
                $journal2->s_p_am_type = SPAMType::PURCHASE;
                $journal2->account_id = $request->v_id;
                $journal2->account_type_id = 0;
                $journal2->amount = $request->amount_paid;
                if ($credit[3] == -1) {
                    $journal2->advance_reverse = 2;
                }
                $journal2->description = 'vender payment';
                $journal2->save();

                $journal = new Journal();
                $journal->transection_type_id = 2; //2 for credit
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_id = $id;
                $journal->s_p_am_type = $s_p_am_type;
                $journal->account_id = $account_id;
                $journal->account_type_id = $account_type_id;
                $journal->amount = $request->amount_paid;
                if ($credit[3] == -1) {
                    $journal->advance_reverse = 2;
                }
                $journal->description = 'vender payment';
                $journal->save();

                return $id;
        });

        return redirect()->action('PurchaseController@purchaseedit', ['id' => $id]);
    }

    // ============ Purchase Invoice Start From Here ===============
    public function purchaseinvoice($id)
    {

        $details = DB::select("
                            select  purchases.id as orderno, purchases.created_at as date, purchases.status as status,
                                    purchases.type as method, vendors.name as vendor,vendors.rtn as trn,
                                    vendors.mobile as mobile, vendors.email as email, vendors.address as address,
                                    regions.name as country, purchases.created_at as date,
                                    (select name from cities where cities.id = vendors.city_id) city,
                                    regions.name as region
                            from purchases
                            JOIN vendors on purchases.vendor_id = vendors.id
                            JOIN regions on vendors.region_id = regions.id
                            where purchases.id = $id
                    ");
        $details = $details[0];

        if (!$details) return abort(404);

        // For Getting Company Detail
        $sett = Setting::all();
        $setting = new \stdClass();
        $setting->company_name = $sett[0]->title;
        $setting->company_address = $sett[1]->title;
        $setting->company_email = $sett[2]->title;
        $setting->company_phone = $sett[3]->title;
        $setting->trn = $sett[4]->title;
        $setting->vat = $sett[5]->title;


        //  For Getting purchase detail
        $purchasedetails = DB::table('purchase_details')
            ->join('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('vendors', 'purchases.vendor_id', '=', 'vendors.id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->select('purchases.id',
                'vendors.id as v_id',
                'purchase_details.quantity',
                'purchase_details.unit_price',
                'purchase_details.sale_price',
                'purchase_details.discount',
                'products.id as p_id',
                'products.name as product')
            ->where('purchases.id', '=', $id)
            ->get();

        return view('purchase.purchase_invoice', compact('purchasedetails', 'details', 'setting'));
    }
}
