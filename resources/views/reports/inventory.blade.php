@extends('layouts.app', ['title' => $title ?? '']) @section('content')

    <div class="pt-2" id="collapseExample">
        <div class="card card-body">

            <form class="form-inline" action="{{url('/inventry')}}" method="get">
                @csrf
                <labe>Date To: &nbsp; </labe>
                <input type="text" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class="form-control mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">
                <div class="ml-3">
                <select
                    class="form-control select2"
                    name="category"
                    id="category"
                >
                    <option value="">Select Category</option>
                    @foreach($categorys as $category)
                        <option
                            @if(app('request')->input('category') == $category->id) selected @endif
                        value="{{$category->id}}"
                        >{{ $category->name }}</option
                        >
                    @endforeach
                </select>
                </div>
                <div class="ml-2">
                <select
                    class="form-control select2"
                    name="product"
                    id="product"
                >
                    <option value="">Select Product</option>
                    @foreach($productds as $productd)
                        <option
                            @if(app('request')->input('product') == $productd->id) selected @endif
                        value="{{$productd->id}}"
                        >{{ $productd->name }}</option
                        >
                    @endforeach
                </select>
                </div>
                <button type="submit"  name="search" value="search" class="btn btn-primary ml-sm-4">Search Data</button>

{{--                @if($filterRequiredError)--}}

{{--                    <h5 class="col-8 mt-2" style="color: tomato">Please select at least one filter!</h5>--}}
{{--                @endif--}}
            </form>
        </div>
    </div>

    <!-- DataTable Start from here -->
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>NAME</th>
                    <th class="text-right">ON HAND</th>
                    <th class="text-right">AVG COST</th>
                    <th class="text-right">ASSET VALUE</th>
                    <th class="text-right">SALE PRICE</th>
                    <th class="text-right">RETAIL VALUE</th>

                </tr>
                </thead>

                <tbody>
                @php
                    $temp = "Null";
                    $grandTotal = 0;
                    $grandAsset = 0;
                    $grandQuantity = 0;
                    $invoiceQuantity = 0;
                @endphp
                @foreach( $inventory_report as $report   )
                    @if($temp == 'Null')
                        @php
                            $temp =  $report->category_id;
                        @endphp
                    @endif

                    @php
                            $final_quentity = $report->total_qty - $report->sold_qty ;
                            $grandQuantity = $grandQuantity + ($final_quentity);
                            $grandTotal = $grandTotal + ($report->sale_price * $final_quentity);
                            $grandAsset = $grandAsset + ($final_quentity * $report->Avgcost);

                    @endphp
                    <tr>

                        <td>{{ucfirst($report->product_name)}}</td>
                        <td class="text-right">{{$final_quentity}}</td>
                        <td class="text-right">{{number_format($report->Avgcost, 2)}}</td>
                        <td class="text-right">{{number_format($report->Avgcost * $final_quentity, 2)}}</td>
                        <td class="text-right">{{number_format($report->sale_price, 2)}}</td>
                        <td class="text-right">{{number_format($report->sale_price * $final_quentity, 2)}}</td>

                    </tr>
                @endforeach

                <tfoot>
                <tr style="background-color: #fff7d6;" class="shadow-sm">
                    <th>{{'Total :-'}}</th>
                    <th class="text-right">{{$grandQuantity}} </th>
                    <th></th>
                    <th class="text-right">{{number_format($grandAsset ,2)}}</th>
                    <th></th>
                    <th class="text-right">{{number_format($grandTotal ,2)}}</th>
                </tr>
                </tfoot>

                </tbody>
            </table>
        </div>
    </div>

@endsection
