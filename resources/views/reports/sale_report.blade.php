@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
    <div class="pt-2" id="collapseExample">
        <div class="card card-body">


            <form class="form" action="{{url('/sale_report')}}" method="get">
            @csrf
            <!-- Start to -->
                <div class="row">
                    <div class="col-sm-4">
                       <input type="text" value="{{ app('request')->input('date_from', Date('Y-m-d')) }}" class="form-control datepicker" placeholder="M d, Y" name="date_from">
                    </div>

                    <!-- Start From -->
                    <div class="col-sm-4">
                        <input type="text" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class="form-control mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">
                    </div>
                    <!-- Select Customer -->
                    <div class="col-sm-4">
                        <select
                            class="form-control select2"
                            name="customer"
                            id="customer"
                        >
                            <option value="">Select Customer</option>
                            @foreach($customer as $customer)
                                <option
                                    @if(app('request')->input('customer') == $customer->id) selected @endif
                                value="{{$customer->id}}">
                                    {{ $customer->name}}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <!-- Next Row  -->
                <!-- Select Category -->
                <div class="row mt-5">
                    <div class="col-sm-4">
                        <select
                            class="form-control select2"
                            name="category"
                            id="category"
                        >
                            <option value="">Select Category</option>
                            @foreach($category as $category)
                                <option
                                    @if(app('request')->input('category') == $category['id']) selected @endif
                                value="{{$category['id']}}">
                                    {{ $category['name']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Search By Name -->

                    <div class="col-sm-4">
                        <select
                            class="form-control select2"
                            name="Product_name"
                            id="Product_name"
                        >
                            <option value="">Select Product</option>
                            @foreach($product as $product)
                                <option
                                    @if(app('request')->input('Product_name') == $product['id']) selected @endif
                                value="{{$product['id']}}">
                                    {{ $product['name']}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"  name="search" value="search" class="btn btn-primary ml-2">Search Data</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Table==================== -->
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>product Name</th>
                    <th class="text-right">Sale Price</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Cost</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Revenue</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $revenue=0;
                    $invoice_number = 0;
                    $salePrice=0;
                    $cost = 0;
                    $grandTotal = 0;
                     $invoiceTotal = 0;
                     $grandQuantity = 0;
                     $invoiceQuantity = 0;
                     $discount=0;
                     $discount_percentage = 0;
                     $temp=0;
                @endphp
                @foreach($slaeresult as $sale_data)
                    @php
                        $discount_percentage = ($sale_data['sale_price'] * $sale_data['discount']/100);
                        $discount = $discount_percentage * $sale_data['quantity'];
                        $sale_Price = $sale_data['sale_price'];
                        $salePrice =   $sale_Price;
                        $cost = $sale_data['cost'];
                        $revenue =  $salePrice -  $cost;
                        $ravenue = $revenue * $sale_data['quantity'];
                        $ravenue = $ravenue - $discount;
                    @endphp
                    @if($temp == 'Null')
                        @php
                            $temp = $sale_data['sale_id'];
                            $saleID = $temp;
                        @endphp
                    @endif
                    @if($temp != $sale_data['sale_id'])
                        <tr style="background-color: #fff7d6;" class="shadow-sm">
                            <th>Invoice # {{$saleID}}  Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">{{$invoiceQuantity  }}</th>
                            <th class="text-right">{{ number_format( $invoiceTotal ,2) }}</th>
                        </tr>
                        @php
                            $temp = $sale_data['sale_id'];
                            $saleID = $temp;
                            $invoiceQuantity = 0;
                            $invoiceTotal = 0;
                        @endphp
                    @endif
                    @php
                        $subt = $ravenue;
                        $grandTotal = $grandTotal + $subt;
                        $invoiceTotal = $invoiceTotal + $subt;
                        $grandQuantity = $grandQuantity + $sale_data['quantity'];
                        $invoiceQuantity = $invoiceQuantity + $sale_data['quantity'];
                        $invoice_number = $sale_data['sale_id'];
                        $real_quantity = (int)$sale_data['quantity'];
                    @endphp
                    <tr id="#">
                        <td>{{date('d-M-y',strtotime($sale_data['date']))}}</td>
                        <td>{{$sale_data['product']}}</td>
                        <td class="text-right">{{number_format($salePrice,2) }}</td>
                        <td class="text-right">{{number_format($discount,2)}}</td>
                        <td class="text-right">{{number_format($cost,2)}}</td>
                        <td class="text-right">{{ $real_quantity }}</td>
                        <td class="text-right">{{number_format($subt ,2) }}</td>

                    </tr>
                @endforeach
                <tr style="background-color: #fff7d6;" class="shadow-sm">
                    <th>Invoice #{{$invoice_number }} Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-right">{{ $invoiceQuantity}}</th>
                    <th class="text-right">{{  number_format($invoiceTotal  ,2) }}</th>
                </tr>
                <tfoot>
                <tr style="background-color: #db9b44;" class="text-light shadow-sm">

                    <th>Total -:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-right">{{ $grandQuantity}}</th>
                    <th class="text-right">{{ number_format($grandTotal,2)}}</th>
                </tr>
                </tfoot>

                </tbody>
            </table>
        </div>
    </div>

@endsection
