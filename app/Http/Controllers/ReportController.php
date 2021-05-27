<?php

namespace App\Http\Controllers;

use App\Models\AccountManagement;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Product;
use JavaScript;

class ReportController extends Controller
{
    public function inventry(Request $request)
    {
        $productds = Product::all();
        $categorys = Category::all();
        $search = $request->get('search');
        $date_to = $request->get('date_to');
        $product = $request->get('product');
        $cat = $request->get('category');
        $inventory_report = [];

        if ($search) {

            if ($date_to || $product || $cat) {
                $pd_join_where = '';
                if ($date_to) {
                    $pd_join_where .= " and purchase_details.created_at <= '$date_to  23:59:59' ";
                }
                if ($product) {
                    $pd_join_where .= " and purchase_details.product_id  = $product ";
                }

                $cat_where = '';
                if ($cat) {
                    $cat_where = " and category_id  = $cat ";
                }

                $sql = "
                    select category, category_id, product_name, Avgcost, sale_price, retail, total_qty, sold_qty, (total_qty - sold_qty) remaining_qty
                    from (
                        select
                            products.id as product_id,
                            products.name as product_name,
                            AVG(purchase_details.unit_price) as Avgcost,
                            AVG(purchase_details.sale_price) as sale_price,
                            SUM(purchase_details.sale_price) as retail,
                            ifNull( SUM(purchase_details.quantity) , 0) as total_qty,
                            (select ifNull( SUM(quantity), 0) from sale_details where sale_details.product_id = products.id) as sold_qty,
                            (select name from categories where categories.id = products.category_id) as category,
                            (select id from categories where categories.id = products.category_id) as category_id
                        from products
                        join purchase_details ON purchase_details.product_id = products.id $pd_join_where
                        where 1=1 $cat_where
                        group by products.id
                    ) tmp
                    having remaining_qty > 0
                ";

                $inventory_report = DB::select($sql);
            }
        }

        $data['title'] = 'Inventory Report';

        return view('reports.inventory', $data, compact('productds', 'categorys', 'inventory_report'));
    }

    public function purchaseorder(Request $request)
    {
        $detail = $request->get('detail');
        $search = $request->get('search');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $vendor = $request->get('vendor');
        // return date('d-M-y',strtotime($ali));
        $vendors = Vendor::orderBy('name', 'ASC')->get();

        $purchaseorder = [];

        // DB::enableQueryLog();
        $filterRequiredError = false;
        if ($search) {
            // if $detail == 1 it,s mean no detail
            if ($detail == 1) {
                if (($date_from && $date_to) || $vendor) {
                    $purchaseorder = DB::table('purchases')
                        ->select(
                            'purchases.id as order_no',
                            'purchases.created_at as date',
                            'vendors.id as vendor_id',
                            'vendors.name as vendor',
                            'purchases.total_amount as amount',
                            DB::raw('sum(purchase_details.quantity) as quantity')
                        )
                        ->join('purchase_details', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->join('vendors', 'vendors.id', '=', 'purchases.vendor_id')
                        ->groupBy('purchases.id');
                    // ->orderBy('vendors.name', 'ASC');
                    // ->orderBy('purchases.created_at', 'ASC');

                    if ($date_from && $date_to) {
                        $purchaseorder->whereBetween('purchases.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59']);
                    }

                    if ($vendor) {
                        $purchaseorder->where('purchases.vendor_id', '=', $vendor);
                    }

                    $purchaseorder = $purchaseorder->get();

                    // dd(DB::getQueryLog());
                } else {

                    $filterRequiredError = true;
                }
            } else {
                if (($date_from && $date_to) || $vendor) {
                    $purchaseorder = DB::table('purchase_details')
                        ->select(
                            'purchase_details.created_at as date',
                            'products.name as product',
                            'vendors.id as vendor_id',
                            'vendors.name as vendor',
                            'purchase_details.purchase_id as order_no',
                            'purchase_details.unit_price as p_price',
                            'purchase_details.sale_price as sale_price',
                            'purchase_details.quantity'
                        )
                        ->join('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->join('vendors', 'vendors.id', '=', 'purchases.vendor_id')
                        ->join('products', 'products.id', '=', 'purchase_details.product_id')
                        ->groupBy('purchase_details.id')
                        ->orderBy('vendors.name', 'ASC')
                        ->orderBy('purchase_details.created_at', 'ASC');

                    if ($date_from && $date_to) {
                        $purchaseorder->whereBetween('purchase_details.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59']);
                    }

                    if ($vendor) {
                        $purchaseorder->where('purchases.vendor_id', '=', $vendor);
                    }

                    $purchaseorder = $purchaseorder->get();
                } else {

                    $filterRequiredError = true;
                }
            }
        }
        $data['title'] = 'Purchase Order Report';

        return view('reports.purchaseOrderSummary', $data, compact('filterRequiredError', 'purchaseorder', 'vendors', 'detail'));
    }

    public  function saleorderreport(Request $request){
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $search = $request->input('search');
        $customer = $request->input('customer');
        $saleorder = [];

        if ($search) {

            $saleorder = DB::table('sales')
                ->select(
                    'sales.id as order_no',
                    'sales.created_at as date',
                    'customers.id as customer_id',
                    'customers.name as customer',
                    'sales.total_amount as amount',
                    DB::raw('sum(sale_details.quantity) as quantity')
                )
                ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
                ->join('customers', 'customers.id', '=', 'sales.customer_id')
                ->groupBy('sales.id');
            // ->orderBy('vendors.name', 'ASC');
            // ->orderBy('sales.created_at', 'ASC');

            if ($date_from && $date_to) {
                $saleorder->whereBetween('sales.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59']);
            }

            if ($customer) {
                $saleorder->where('sales.customer_id', '=', $customer);
            }

            $saleorder = $saleorder->get();
        }

        $customers = Customer::all();
        $data['title'] = 'Sale Order Report';

        return view('reports.saleOrderReport', $data,compact('customers', 'saleorder'));
    }

    public function sale_report(Request $request)
    {



        $search = $request->get('search');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $customers = $request->get('customer');
        $categorys = $request->get('category');
        $product_name = $request->get('Product_name');
        //  next filter logic
        $slaeresult = [];

        if ($search) {

            $sale_where = '';

            if ($product_name) {
                $sale_where .= " and products.id  = $product_name ";
            }

            if ($categorys) {
                $sale_where .= " and products.category_id  = $categorys ";
            }
            if ($customers) {
                $sale_where .= " and sales.customer_id  = $customers ";
            }

            $slaeresult = DB::select("
                select
                    sale_details.created_at as date,
                    products.name as product,
                    customers.name as customer,
                    sale_details.sale_id as sale_id,
                    sale_details.unit_price as sale_price,
                    sale_details.discount as discount,
                    (SELECT ifNull(avg(unit_price),0) from purchase_details where purchase_details.product_id = products.id) cost,
                    sale_details.quantity
                from sale_details
                inner join sales on sales.id = sale_details.sale_id
                inner join customers on customers.id = sales.customer_id
                inner join products on products.id = sale_details.product_id
                where 1=1 $sale_where and sale_details.created_at BETWEEN '$date_from 00:00:00' AND '$date_to 23:59:59'
                group by sale_details.id
                order by sales.id asc, sale_details.created_at asc");
        }

        $customer = Customer::orderBy('name', 'ASC')->get();
        $category = Category::orderBy('name', 'ASC')->get();
        $product = Product::orderBy('name', 'ASC')->get();

        $slaeresult = json_decode(json_encode($slaeresult), true);
        $data['title'] = 'Sale Report';

        return view('reports.sale_report', $data, compact('customer', 'category', 'slaeresult', 'product'));
    }


    public function lowStock(Request $request)
    {

        $search = $request->get('search');
        $product_id = $request->get('product_id');
        $category_id = $request->get('category_id');
        $lowstock = [];


        if ($search) {

            $product_where = '';

            if ($product_id) {
                $product_where .= " and products.id  = $product_id ";
            }

            $cat_where = '';
            if ($category_id) {
                $cat_where = " and category_id  = $category_id ";
            }

            $lowstock = DB::select("
                    select *, pq-sq as remaining
                        from(
                        SELECT products.name as product,
                        (SELECT name from categories where products.category_id = categories.id) category,
                        ( SELECT IFNULL(SUM(purchase_details.quantity),0) from purchase_details where products.id = purchase_details.product_id) as pq,
                        ( SELECT IFNULL(SUM(sale_details.quantity),0) from sale_details where products.id = sale_details.product_id) as sq
                        FROM
                        products
                        where 1=1 $product_where $cat_where
                        )temp
                        HAVING remaining <5
            ");

        }

        $products = Product::all();
        $categories = Category::all();

        $data['title'] = 'Low Stock Report';

        return view('reports.lowStock', $data, compact('lowstock', 'products', 'categories'));
    }

    public function balance_sheet(Request $request)
    {
        $bsheet = [];
        $date_to = $request->date_to;
        $search = 0;

        if ($request->search) {
            $search = 1;

            $bsheet = DB::select("
                select
                    account_type_id type,
                    (select account_name from account_management where id = account_id) name,
                    debit, credit
                    from(
                select account_id, sum(debit) debit, sum(credit) credit,account_type_id
                from(
                    select account_id,
                        IF(transection_type_id = 1, sum(amount),  0) debit,
                        IF(transection_type_id = 2, sum(amount),  0) credit,
                        account_type_id
                        from (
                            SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                            FROM `journals`
                            WHERE s_p_am_type = 3 and account_type_id IN (1, 2, 11)
                            and created_at <= '$date_to 23:59:59'
                        ) temp
                        group by transection_type_id,account_id,account_type_id
                        ) temp2
                        group by account_id, account_type_id
                    ) temp3
                union
                        select
                        12 type,
                        (select name from customers where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 1 and account_type_id = 0
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                            13 type,
                            (select name from vendors where id = account_id) name,
                            sum(debit) debit,
                            sum(credit) credit
                            from(
                                select account_id,
                                    IF(transection_type_id = 1, sum(amount),  0) debit,
                                    IF(transection_type_id = 2, sum(amount),  0) credit,
                                    account_type_id
                                    from (
                                        SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                        FROM `journals`
                                        WHERE s_p_am_type = 2 and account_type_id = 0
                                        and created_at <= '$date_to 23:59:59'
                                    ) temp
                                    group by transection_type_id,account_id,account_type_id
                                ) temp2
                            group by account_id, account_type_id
                union
                        select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 6
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 4 and account_id != 35
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        14 type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 4 and account_id = 35
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                        select
                        5 type,
                        'Cost of goods sold' name,
                        sum(amount) debit,
                        0 credit
                        from journals
                        WHERE s_p_am_type = 3 and account_type_id = 5
                        and created_at <= '$date_to 23:59:59'
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 7
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 3
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 10
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
            ");
            //  return $bsheet;

        }


        $banks = [];
        $data = [];
        $payables = [];
        $recievables = [];
        $equity = [];
        $income = [];
        $expenses = [];
        $vendors = [];
        $customers = [];
        $sales = [];
        $accountRecivable = 0;

        $obj2 = new \stdClass();
        $obj2->debit = 0;
        $obj2->credit = 0;
        $data[2] = $obj2;

        $obj5 = new \stdClass();
        $obj5->debit = 0;
        $obj5->credit = 0;
        $data[5] = $obj5;

        $obj10 = new \stdClass();
        $obj10->debit = 0;
        $obj10->credit = 0;
        $data[10] = $obj10;

        $obj11 = new \stdClass();
        $obj11->debit = 0;
        $obj11->credit = 0;
        $data[11] = $obj11;

        $obj14 = new \stdClass();
        $obj14->debit = 0;
        $obj14->credit = 0;
        $data[14] = $obj14;

        foreach ($bsheet as $key => $value) {
            if ($value->type == 1) {
                $banks[] = $value;
            } else if ($value->type == 4) {
                $income[] = $value;
            } else if ($value->type == 3) {
                $recievables[] = $value;
            } else if ($value->type == 6) {
                $expenses[] = $value;
            } else if ($value->type == 10) {
                $payables[] = $value;
            } else if ($value->type == 12) {
                $customers[] = $value;
            } else if ($value->type == 13) {
                $vendors[] = $value;
            } else if ($value->type == 7) {
                $equity[] = $value;
            } else {
                $data[$value->type] = $value;
            }
        }

        //      return [$customers, $data, $payables];
        $data['title'] = 'Balance Sheet';

        return view('reports.balance_sheet', $data, compact('recievables', 'payables', 'accountRecivable', 'banks', 'data', 'equity', 'expenses', 'customers', 'vendors', 'income', 'search', 'date_to', 'sales'));
    }

    public function trialbalance(Request $request)
    {
        $bsheet = [];
        $date_to = $request->date_to;
        $search = 0;

        if ($request->search) {
            $search = 1;

            $bsheet = DB::select("
                select
                    account_type_id type,
                    (select account_name from account_management where id = account_id) name,
                    debit, credit
                    from(
                select account_id, sum(debit) debit, sum(credit) credit,account_type_id
                from(
                    select account_id,
                        IF(transection_type_id = 1, sum(amount),  0) debit,
                        IF(transection_type_id = 2, sum(amount),  0) credit,
                        account_type_id
                        from (
                            SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                            FROM `journals`
                            WHERE s_p_am_type = 3 and account_type_id IN (1, 2, 11)
                            and created_at <= '$date_to 23:59:59'
                        ) temp
                        group by transection_type_id,account_id,account_type_id
                        ) temp2
                        group by account_id, account_type_id
                    ) temp3

                union
                        select
                        12 type,
                        (select name from customers where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 1 and account_type_id = 0
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                            13 type,
                            (select name from vendors where id = account_id) name,
                            sum(debit) debit,
                            sum(credit) credit
                            from(
                                select account_id,
                                    IF(transection_type_id = 1, sum(amount),  0) debit,
                                    IF(transection_type_id = 2, sum(amount),  0) credit,
                                    account_type_id
                                    from (
                                        SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                        FROM `journals`
                                        WHERE s_p_am_type = 2 and account_type_id = 0
                                        and created_at <= '$date_to 23:59:59'
                                    ) temp
                                    group by transection_type_id,account_id,account_type_id
                                ) temp2
                            group by account_id, account_type_id
                union
                        select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 6
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 4
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                        select
                        5 type,
                        'Cost of goods sold' name,
                        sum(amount) debit,
                        0 credit
                        from journals
                        WHERE s_p_am_type = 3 and account_type_id = 5
                        and created_at <= '$date_to 23:59:59'
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 7
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 3
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 10
                                    and created_at <= '$date_to 23:59:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
            ");
        }


        $banks = [];
        $data = [];
        $equity = [];
        $income = [];
        $expenses = [];
        $vendors = [];
        $customers = [];
        $recievables = [];
        $payables = [];
        $obj2 = new \stdClass();
        $obj2->debit = 0;
        $obj2->credit = 0;
        $data[2] = $obj2;

        $obj3 = new \stdClass();
        $obj3->debit = 0;
        $obj3->credit = 0;
        $data[3] = $obj3;

        $obj5 = new \stdClass();
        $obj5->debit = 0;
        $obj5->credit = 0;
        $data[5] = $obj5;

        $obj10 = new \stdClass();
        $obj10->debit = 0;
        $obj10->credit = 0;
        $data[10] = $obj10;

        $obj11 = new \stdClass();
        $obj11->debit = 0;
        $obj11->credit = 0;
        $data[11] = $obj11;

        foreach ($bsheet as $key => $value) {
            if ($value->type == 1) {
                $banks[] = $value;
            } else if ($value->type == 4) {
                $income[] = $value;
            } else if ($value->type == 3) {
                $recievables[] = $value;
            } else if ($value->type == 6) {
                $expenses[] = $value;
            } else if ($value->type == 10) {
                $payables[] = $value;
            } else if ($value->type == 12) {
                $customers[] = $value;
            } else if ($value->type == 13) {
                $vendors[] = $value;
            } else if ($value->type == 7) {
                $equity[] = $value;
            } else {
                $data[$value->type] = $value;
            }
        }
//        return [$data,$banks, $payables, $recievables];

        $data['title'] = 'Trial Balance';

        return view('reports.trialbalance', $data, compact('banks', 'payables', 'recievables', 'data', 'equity', 'expenses', 'customers', 'vendors', 'income', 'date_to', 'search'));
    }

    public function profitloss(Request $request)
    {
        $bsheet = [];
        $date_to = $request->date_to;
        $date_from = $request->date_from;

        $search = 0;

        if ($request->search) {
            $search = 1;
            $bsheet = DB::select("
                    select
                        14 type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 4 and account_id = 35
                                    and created_at BETWEEN '$date_from 00:00:00' AND '$date_to 23:23:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                union
                    select
                        5 type,
                        'Cost of goods sold' name,
                        sum(amount) debit,
                        0 credit
                        from journals
                        WHERE s_p_am_type = 3 and account_type_id = 5
                        and created_at BETWEEN '$date_from 00:00:00' AND '$date_to 23:23:59'
                union
                    select
                        account_type_id type,
                        (select account_name from account_management where id = account_id) name,
                        sum(debit) debit,
                        sum(credit) credit
                        from(
                            select account_id,
                                IF(transection_type_id = 1, sum(amount),  0) debit,
                                IF(transection_type_id = 2, sum(amount),  0) credit,
                                account_type_id
                                from (
                                    SELECT transection_type_id, s_p_am_type, account_id,amount, account_type_id
                                    FROM `journals`
                                    WHERE s_p_am_type = 3 and account_type_id = 6
                                    and created_at BETWEEN '$date_from 00:00:00' AND '$date_to 23:23:59'
                                ) temp
                                group by transection_type_id,account_id,account_type_id
                            ) temp2
                        group by account_id, account_type_id
                ");
        }


        $data = [];
        $expenses = [];


        $obj5 = new \stdClass();
        $obj5->debit = 0;
        $obj5->credit = 0;
        $data[5] = $obj5;

        $obj11 = new \stdClass();
        $obj11->debit = 0;
        $obj11->credit = 0;
        $data[14] = $obj11;

        foreach ($bsheet as $key => $value) {
            if ($value->type == 6) {
                $expenses[] = $value;
            } else {
                $data[$value->type] = $value;
            }
        }
        $data['title'] = 'Profit & loss Report';

        return view('reports.profitloss', $data, compact('search', 'data', 'expenses', 'date_to', 'date_from'));
    }

    public function  ledger(Request $request){

        $openingBalance = 0;
        $search = $request->get('search');
        $date_from = date('Y-m-d');
        $date_to = date('Y-m-d');
        $s_p_am_type = null;
        $account_id = null;
        $account_type_id = null;
        $result = "";
        $journal = [];
        $accountSetting = [];

        if ($search) {

            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');
            $string = $request->ledgerName;
            $account = explode(",", $string);


            if ($request->ledgerName) {

                $s_p_am_type = $account[1];
                $account_id = $account[0];
                $account_type_id = $account[2];

                if ($s_p_am_type == 1) {
                    $accountSetting = DB::table('customers')
                        ->select('customers.*', 'regions.name as region', 'cities.name as city')
                        ->join('regions', 'regions.id', '=', 'customers.region_id')
                        ->join('cities', 'cities.id', '=', 'customers.city_id')
                        ->where('customers.id', $account_id)
                        ->get();

                } else {
                    $accountSetting = DB::table('vendors')
                        ->select('vendors.*', 'regions.name as region', 'cities.name as city')
                        ->join('regions', 'regions.id', '=', 'vendors.region_id')
                        ->join('cities', 'cities.id', '=', 'vendors.city_id')
                        ->where('vendors.id', $account_id)
                        ->get();

                    }
                }
            $accountSetting = $accountSetting[0];

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

            $debit = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
                s_p_am_type = $s_p_am_type and
                transection_type_id = 1 and
                account_id = $account_id and
                account_type_id = $account_type_id and
                advance_reverse = 0 and
                journals.created_at < '$date_from 00:00:00'
                ) temp
        ");


            $credit = DB::select("
            select sum(amount) amount
            from (
            SELECT ifNull(sum(amount), 0) amount
            from journals
            where
                s_p_am_type = $s_p_am_type and
                transection_type_id = 2 and
                account_id = $account_id and
                account_type_id = $account_type_id and
                advance_reverse = 0 and
                journals.created_at < '$date_from 00:00:00'
            ) temp
        ");
            $openingBalance = $debit[0]->amount - $credit[0]->amount;

        }
        $customers = Customer::orderBy('name', 'ASC')->get();
        $vendors = Vendor::orderBy('name', 'ASC')->get();

        $accountNames = [];
        foreach ($customers as $key => $value) {
            $accountNames[1][] = $value;
        }

        foreach ($vendors as $key => $value) {
            $accountNames[2][] = $value;
        }

        // For Getting Company Detail
        $sett = Setting::all();

        $setting = new \stdClass();
        $setting->company_name = $sett[0]->title;
        $setting->company_address = $sett[1]->title;
        $setting->company_email = $sett[2]->title;
        $setting->company_phone = $sett[3]->title;
        $setting->trn = $sett[4]->title;

        JavaScript::put([
            'accountNames' => $accountNames
        ]);
        $data['title'] = 'Legder';

        return view('reports.ledger',$data, compact('journal', 'openingBalance', 'accountNames', 'accountSetting', 'setting','date_to', 'date_from'));
    }

}
