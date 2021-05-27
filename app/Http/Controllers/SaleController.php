<?php

namespace App\Http\Controllers;

use App\Models\AccountManagement;
use App\Models\Sale;
use App\Models\SPAMType;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Support\Str;
use Session;
use App\Models\SaleDetail;
use App\Models\Setting;
use App\Models\transectionHistory;
use App\Models\Journal;

class SaleController extends Controller
{

    // public function __construct()
    // {
    // $this->saleDetail = new SaleDetail();
    // parent::__construct();
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('sales.*', 'customers.name as customer')
            ->get();
        $data['title'] = 'Sales';

        return view('sale.index', compact('sales'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::orderBy('name', 'ASC')->get();

        $products = DB::select("
                select id,price, name, tquantity, squantity, (tquantity - squantity) remaining
                from (
                    select
                        products.id, products.name,
                        (select AVG(sale_price) from purchase_details where product_id = products.id) price,
                        (select sum(quantity) from purchase_details where product_id = products.id) tquantity,
                        (select ifNull(sum(quantity), 0) from sale_details where product_id = products.id) squantity
                    from products
                    join purchase_details on purchase_details.product_id = products.id
                    join purchases on purchases.id = purchase_details.purchase_id and purchases.status <> 0
                ) temp
                group by id
                having remaining > 0

            ");

        $data['title'] = 'sale';
        $data['products'] = $products;
        $data['customers'] = $customers;

        return view('sale.create', $data);
    }

    /**
     * Store a newly created resource in storage..
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ordered_uuid = (string)Str::orderedUuid();
        $ordered_uuid_cost = (string)Str::orderedUuid();

        $sid = DB::transaction(function () use ($request, $ordered_uuid, $ordered_uuid_cost) {

            $customer_id = array_slice($request->po, 0, 1)[0]['customer_id'];
            $sale = new Sale();
            $sale->total_amount = $request->t_amount;
            $sale->customer_id = $customer_id;
            $sale->ordered_uuid = $ordered_uuid;
            $sale->ordered_uuid_cost = $ordered_uuid_cost;
            $sale->save();

            foreach ($request->po as $key => $value) {
                $saleDetail = new saleDetail();
                $saleDetail->sale_id = $sale->id;
                $saleDetail->product_id = $value['product_id'];
                $saleDetail->quantity = $value['quantity'];
                $saleDetail->unit_price = $value['unit_price'];
                $saleDetail->discount = $value['discount'];
                $saleDetail->save();
            }

            $costGoods = 0;
            foreach ($request->po as $key => $value) {
                $query = DB::table('purchase_details')
                    ->select(DB::raw('AVG(purchase_details.unit_price) price'), DB::raw('AVG(purchase_details.discount) discount'))
                    ->where('product_id', $value['product_id'])
                    ->get();
                $price = round($query[0]->price);
                $discount = round($query[0]->discount);
                $fprice = $price * ($discount / 100);
                $fprice = $price - $fprice;
                $subtotal = $fprice * $value['quantity'];
                $costGoods = $costGoods + $subtotal;
            }

            //journal
            $journal2 = new Journal();
            $journal2->transection_type_id = 1; //1 for debit
            $journal2->journal_uuid = $ordered_uuid;
            $journal2->s_p_am_id = $sale->id;
            $journal2->s_p_am_type = SPAMType::SALE;
            $journal2->account_id = $customer_id;
            $journal2->account_type_id = 0;
            $journal2->amount = $request->t_amount;
            $journal2->description = 'Sale to Customer';
            $journal2->save();

            $journal = new Journal();
            $journal->transection_type_id = 2; //2 for credit
            $journal->s_p_am_id = $sale->id;
            $journal->journal_uuid = $ordered_uuid;
            $journal->account_id = 35;
            $journal->s_p_am_type = SPAMType::ACCOUNT_MANAGER;
            $journal->account_type_id = 4;
            $journal->amount = $request->t_amount;
            $journal->description = 'Sale to Customer';
            $journal->save();

            $journal3 = new Journal();
            $journal3->transection_type_id = 1;  //1 for debit
            $journal3->journal_uuid = $ordered_uuid_cost;
            $journal3->s_p_am_id = $sale->id;
            $journal3->s_p_am_type = SPAMType::ACCOUNT_MANAGER;
            $journal3->account_id = 28;
            $journal3->account_type_id = 5;
            $journal3->amount = $costGoods;
            $journal3->description = 'Sale to Customer';
            $journal3->save();

            $journal4 = new Journal();
            $journal4->transection_type_id = 2;  //2 for credit
            $journal4->journal_uuid = $ordered_uuid_cost;
            $journal4->s_p_am_id = $sale->id;
            $journal4->s_p_am_type = SPAMType::ACCOUNT_MANAGER;
            $journal4->account_id = 26;
            $journal4->account_type_id = 2;
            $journal4->amount = $costGoods;
            $journal4->description = 'Sale to Customer';
            $journal4->save();


//            //transection
//            $tansection = new transectionHistory();
//            $tansection->number = $sale->id;
//            $tansection->transection_type_id = 1;
//            $tansection->account_id = $customer_id;
//            $tansection->amount = $request->t_amount;
//            $tansection->paid = 0;
//            $tansection->description = 'Billed to Customer';
//            $tansection->save();

            return $sale->id;
        });
        Session::flash('message', 'Sale Added Successfully');
        Session::flash('class', 'success');

        return redirect()->action('SaleController@saleedit', ['id' => $sid]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function saleedit($id)
    {
        $Sale1 = Sale::find($id);
        if (!$Sale1) {
            abort(404);
        }
        $status = $Sale1->status;
        if (is_null($Sale1->paid_amount)) {
            $paid = 0;
        } else {
            $paid = $Sale1->paid_amount;
        }

//        $sales = DB::table('sale_details')
//            ->select(
//                'sales.id',
//                'customers.id as c_id',
//                'customers.name as customer',
//                'sale_details.quantity',
//                'sale_details.unit_price',
//                'sale_details.discount',
//                'products.id as p_id',
//                'products.name as product',
//                DB::raw('SUM(purchase_details.quantity) - SUM(IFNULL(sale_details.quantity, 0)) as remaining')
//            )
//            ->join('sales', 'sales.id', '=', 'sale_details.sale_id')
//            ->join('customers', 'sales.customer_id', '=', 'customers.id')
//            ->join('products', 'products.id', '=', 'sale_details.product_id')
//            ->join('purchase_details', 'purchase_details.product_id', '=', 'products.id')
//            ->groupby('sale_details.id')
//            ->where('sales.id', '=', $id)
//            ->get();

            $sales = DB::select("
                    SELECT id ,c_id, customer, quantity , unit_price, discount , p_id , product,
                        tq - (SELECT SUM(quantity) from sale_details WHERE sale_details.product_id = p_id ) as remaining
                        from(
                             select sales.id,customers.id as c_id,customers.name as customer ,
                                sale_details.quantity,
                                sale_details.unit_price,
                                sale_details.discount,
                                (SELECT id from products where products.id = sale_details.product_id) p_id,
                                (SELECT name from products where products.id = sale_details.product_id) product,
                                (SELECT SUM(quantity) from purchase_details where purchase_details.product_id = sale_details.product_id ) tq

                                from sale_details
                                JOIN sales on sales.id = sale_details.sale_id
                                JOIN customers on customers.id = sales.customer_id
                                WHERE sales.id = $id
                        )temp

                ");


        $customer_id = $Sale1->customer_id;
        $oCustomer = Customer::find($customer_id);

        $disabledProducts = [];
        foreach ($sales as $key => $value) {
            $disabledProducts[] = $value->p_id;
        }

        $customers = Customer::orderBy('name', 'ASC')->get();

        $products = DB::select("
                select id,price, name, tquantity, squantity, (tquantity - squantity) remaining
                from (
                    select
                        products.id, products.name,
                        (select AVG(sale_price) from purchase_details where product_id = products.id) price,
                        (select sum(quantity) from purchase_details where product_id = products.id) tquantity,
                        (select ifNull(sum(quantity), 0) from sale_details where product_id = products.id) squantity
                    from products
                    join purchase_details on purchase_details.product_id = products.id
                    join purchases on purchases.id = purchase_details.purchase_id and purchases.status <> 0
                ) temp
                group by id
                having remaining > 0

            ");

        // $customerCredit = DB::select("
        //         SELECT customer ,sum(credit) - sum(debit) customers_credit
        //         from
        //         (
        //             SELECT
        //                 (SELECT name from customers WHERE customers.id = account_id) customer,
        //                 transection_type_id,
        //                 IF(transection_type_id = 1, sum(amount),  0) debit,
        //                 IF(transection_type_id = 2, sum(amount),  0) credit
        //             from
        //             (
        //                 select transection_type_id, s_p_am_id, s_p_am_type, account_id, account_type_id, amount, ifNull(sale_status, 1) as sale_status
        //                 from
        //                 (
        //                     SELECT *,
        //                         (
        //                             CASE
        //                             WHEN s_p_am_type = 1 THEN (SELECT name FROM customers WHERE id =journals.account_id)
        //                             WHEN s_p_am_type = 2 THEN (SELECT name FROM vendors WHERE id =journals.account_id)
        //                             ELSE (SELECT account_name FROM account_management WHERE id =journals.account_id) END
        //                         ) account_name,
        //                         (
        //                             select status from sales where sales.id = journals.s_p_am_id
        //                         ) sale_status
        //                     FROM journals
        //                     WHERE 1=1 and
        //                         journals.account_id = $customer_id and
        //                         journals.s_p_am_type = 1
        //                     order by journal_uuid asc
        //                 ) tmp
        //             ) temp2
        //             group by transection_type_id, account_id, sale_status
        //         ) temp3
        //         GROUP by customer
        //     ");

//        $debit = DB::select("
//            SELECT *
//            from journals
//            where
//              s_p_am_id is null and
//                s_p_am_type = 1 and
//
//                account_id = $customer_id and
//                account_type_id = 0 and
//                advance_reverse = 0
//        ");
//        return $debit;
        $debit = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
              s_p_am_id is null and
                s_p_am_type = 1 and
                transection_type_id = 1 and
                account_id = $customer_id and
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
                s_p_am_type = 1 and
                transection_type_id = 2 and
                account_id = $customer_id and
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
              s_p_am_type = 1 and
              account_id = $customer_id and
              account_type_id = 0 and
              advance_reverse = 1
            ) temp
        ");

        $customerCredit = $debit[0]->amount + $creditReverse[0]->amount;
        $customerCredit = $credit[0]->amount - $customerCredit;

        $data['title'] = 'sale';

        $paymethod = AccountManagement::whereIn('account_type', [1, 11])->get();

        return view('sale.edit', $data, compact('disabledProducts', 'oCustomer', 'customerCredit', 'paymethod', 'products', 'customers', 'sales', 'id', 'status', 'paid'));
    }

    public function saleupdate(Request $request, $id)
    {

        $tr = DB::transaction(function () use ($request, $id) {

            $customer_id = array_slice($request->po, 0, 1)[0]['customer_id'];

            $sale = Sale::where('id', $id)->first();
            $ordered_uuid = $sale->ordered_uuid;
            $ordered_uuid_cost = $sale->ordered_uuid_cost;
//            //update transaction
//            $tansection = DB::table('transection_histories')
//                ->select(
//                    DB::raw('SUM(transection_histories.amount) as tamount'),
//                    DB::raw('SUM(transection_histories.paid) as tpaid'),
//                    'transection_histories.number as tnumber'
//                )
//                ->where('transection_type_id', 1)
//                ->where('number', $sale->id)
//                ->groupBy('transection_histories.number')
//                ->get();
//
//            $paidamt = $tansection[0]->tpaid;
//            $totalamt = $tansection[0]->tamount;
//            $tnumber = $tansection[0]->tnumber;
//
//            $tansection = DB::table('transection_histories')
//                ->where('transection_type_id', 1)
//                ->where('number', $sale->id)
//                ->delete();
//
//            $tansection = new transectionHistory();
//            $tansection->number = $sale->id;
//            $tansection->transection_type_id = 1;
//            $tansection->number = $tnumber;
//            $tansection->account_id = $customer_id;
//            $tansection->amount = $request->t_amount;
//            $tansection->paid = $paidamt;
//            $tansection->description = 'Sales to Customer updated';
//            $tansection->save();
            DB::table('sale_details')->where('sale_id', $id)->delete();
            $sale->delete();

            $sale = new sale();
            $sale->id = $id;
            $sale->customer_id = $customer_id;
            $sale->total_amount = $request->t_amount;
            $sale->paid_amount = 0;
            $sale->ordered_uuid = $ordered_uuid;
            $sale->ordered_uuid_cost = $ordered_uuid_cost;
            $sale->save();

            $costGoods = 0;
            foreach ($request->po as $key => $value) {
                $saleDetail = new saleDetail();
                $saleDetail->sale_id = $sale->id;
                $saleDetail->product_id = $value['product_id'];
                $saleDetail->quantity = $value['quantity'];
                $saleDetail->unit_price = $value['unit_price'];
                $saleDetail->discount = $value['discount'];
                $saleDetail->save();
                //cost of goods sold
                $query = DB::table('purchase_details')
                    ->select(DB::raw('AVG(purchase_details.unit_price) price'), DB::raw('AVG(purchase_details.discount) discount'))
                    ->where('product_id', $value['product_id'])
                    ->get();
                $price = round($query[0]->price);
                $discount = round($query[0]->discount);
                $fprice = $price * ($discount / 100);
                $fprice = $price - $fprice;
                $subtotal = $fprice * $value['quantity'];
                $costGoods = $costGoods + $subtotal;
            }



            $affected = DB::table('journals')
                ->where('journal_uuid', $ordered_uuid)
                ->update(['amount' => $sale->total_amount]);

            $affected2 = DB::table('journals')
                ->where('journal_uuid', $ordered_uuid_cost)
                ->update(['amount' => $costGoods]);

        });

        Session::flash('message', 'Sale Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('SaleController@saleedit', ['id' => $id]);
    }

    public function saledelete($id)
    {
        $sale = Sale::where('id', $id)->first();
        DB::table('sale_details')->where('sale_id', $id)->delete();
        DB::table('journals')->where('journal_uuid ', $sale->ordered_uuid)->delete();
        DB::table('journals')->where('journal_uuid ', $sale->ordered_uuid_cost)->delete();
        $sale->delete();

        return 'true';
    }

    public function salepayupdate(Request $request, $id)
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

            $affected = DB::table('sales')
                ->where('id', $id)
                ->update(['status' => $status, 'type' => $method, 'pay_date' => $request->pay_date, 'paid_amount' => $final_paid, 'total_amount' => $request->total_amount]);

            // if ($credit[3] == -1) return $id;

            $account_id = $credit[0];
            $s_p_am_type = $credit[1];
            $account_type_id = $credit[2];


            if ($credit[3] == -1) {
                $journal = new Journal();
                $journal->transection_type_id = 1; //1 for debit
                $journal->journal_uuid = $ordered_uuid;
                $journal->s_p_am_id = $id;
                $journal->account_id = $request->c_id;
                $journal->s_p_am_type = SPAMType::SALE;
                $journal->account_type_id = 0;
                $journal->amount = $request->amount_paid;
                $journal->description = 'Advance Reverse';
                $journal->advance_reverse = 1;
                $journal->save();

                $journal2 = new Journal();
                $journal2->transection_type_id = 2; //2 for credit
                $journal2->journal_uuid = $ordered_uuid;
                $journal2->s_p_am_id = $id;
                $journal2->account_type_id = $account_type_id;
                $journal2->s_p_am_type = $s_p_am_type;
                $journal2->account_id = $account_id;
                $journal2->amount = $request->amount_paid;
                $journal2->description = 'Advance Reverse';
                $journal2->advance_reverse = 1;
                $journal2->save();


                // if ($credit[3] == -1) return $id;
            }


//            $tansection = new transectionHistory();
//            $tansection->transection_type_id = 1;
//            $tansection->number = $id;
//            $tansection->account_id = $request->c_id;
//            $tansection->paid = $request->amount_paid;
//            $tansection->description = 'Payment by Customer';
//            $tansection->save();
            $journal2 = new Journal();
            $journal2->transection_type_id = 1; //1 for debit
            $journal2->journal_uuid = $ordered_uuid;
            $journal2->s_p_am_id = $id;
            $journal2->account_type_id = $account_type_id;
            $journal2->s_p_am_type = $s_p_am_type;
            $journal2->account_id = $account_id;
            $journal2->amount = $request->amount_paid;
            $journal2->description = 'Customer payment';
            if ($credit[3] == -1) {
                $journal2->advance_reverse = 2;
            }
            $journal2->save();

            $journal = new Journal();
            $journal->transection_type_id = 2; //2 for credit
            $journal->journal_uuid = $ordered_uuid;
            $journal->s_p_am_id = $id;
            $journal->account_id = $request->c_id;
            $journal->s_p_am_type = SPAMType::SALE;
            $journal->account_type_id = 0;
            $journal->amount = $request->amount_paid;
            $journal->description = 'Customer payment';
            if ($credit[3] == -1) {
                $journal->advance_reverse = 2;
            }
            $journal->save();

            return $id;
        });

        return redirect()->action('SaleController@saleedit', ['id' => $id]);
    }

    //===================== Sale Invoice Section =======================
    public function saleinvoice($id)
    {

        // For Getting Company Detail
        $sett = Setting::all();

        $setting = new \stdClass();
        $setting->company_name = $sett[0]->title;
        $setting->company_address = $sett[1]->title;
        $setting->company_email = $sett[2]->title;
        $setting->company_phone = $sett[3]->title;
        $setting->trn = $sett[4]->title;
        $setting->vat = $sett[5]->title;

//        $c_detail = DB::table('customers')
//            ->select(
//                'sales.id as order_no',
//                'sales.status',
//                'sales.type as payment',
//                'customers.id as c_id',
//                'customers.name as customer',
//                'customers.mobile as mobile',
//                'customers.rtn as TRN',
//                'customers.address as address',
//                'customers.email as email',
//                'customers.created_at as date',
//                'cities.name as city',
//                'regions.name as region'
//            )
//            ->join('sales', 'sales.customer_id', '=', 'customers.id')
//            ->join('cities', 'cities.id', '=', 'customers.city_id')
//            ->join('regions', 'regions.id', '=', 'customers.region_id')
//            ->where('sales.id', '=', $id)
//            ->first();

        $c_detail = DB::select("
                            select
                                sales.id as order_no, sales.status, sales.type as payment, customers.id as c_id, customers.name as customer,
                                customers.mobile as mobile, customers.rtn as TRN, customers.address as address, customers.email as email,
                                sales.created_at as date, (select name from cities where cities.id = customers.city_id) city,
                                regions.name as region
                            from sales
                            JOIN customers on sales.customer_id = customers.id
                            JOIN regions on customers.region_id = regions.id
                            where sales.id = $id
                        ");
        $c_detail = $c_detail[0];

        if (!$c_detail) return abort(404);

        $paymentMethod = strtok($c_detail->payment, ",");


        $sales = DB::select("
                    SELECT id ,c_id, customer, quantity , unit_price, s_date, discount , p_id , product,
                        tq - (SELECT SUM(quantity) from sale_details WHERE sale_details.product_id = p_id ) as remaining
                        from(
                             select sales.id,customers.id as c_id,customers.name as customer ,
                                sale_details.quantity,
                                sale_details.unit_price,
                                sales.created_at as s_date,
                                sale_details.discount,
                                (SELECT id from products where products.id = sale_details.product_id) p_id,
                                (SELECT name from products where products.id = sale_details.product_id) product,
                                (SELECT SUM(quantity) from purchase_details where purchase_details.product_id = sale_details.product_id ) tq

                                from sale_details
                                JOIN sales on sales.id = sale_details.sale_id
                                JOIN customers on customers.id = sales.customer_id
                                WHERE sales.id = $id
                        )temp

                ");

        if (!$sales) return abort(404);

        return view('sale.sale_invoice', compact('id', 'sales', 'paymentMethod', 'c_detail', 'setting'));
    }
}
