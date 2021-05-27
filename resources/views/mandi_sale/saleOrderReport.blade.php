@extends('layouts.app', ['title' => $title ?? '']) @section('content')


    <div class="pt-2" id="collapseExample">
        <div class="card card-body">


            <form class="form" action="" method="get">
            @csrf
            <!-- Start to -->
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="{{app('request')->input('date_from', Date('Y-m-d')) }}" class="form-control datepicker" placeholder="M d, Y" name="date_from">
                    </div>

                    <!-- Start From -->
                    <div class="col-sm-3">
                        <input type="text" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class="form-control mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">
                    </div>
                    <!-- Select Customer -->
                    <div class="col-sm-3">
                        <select
                            class="form-control select2"
                            name="customer"
                            id="customer"
                        >
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option
                                    @if(app('request')->input('customer') == $customer->id) selected @endif
                                value="{{$customer->id}}"
                                >{{ $customer->name }}</option
                                >
                            @endforeach
                        </select>

                    </div>
                    <div class="col-sm-3">
                        <button type="submit"  name="search" value="search" class="btn btn-primary ml-2 mb-4">Search Data</button>

                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Party Name</th>
                    <th>Item Name</th>
                    <th class="text-right">Order No</th>
                    <th class="text-right">purchase Price</th>
                    {{--                    <th class="text-right">Sale Price</th>--}}
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Sub total</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $temp = "Null";
                    $grandTotal = 0;
                    $invoiceTotal = 0;
                    $grandQuantity = 0;
                    $invoiceQuantity = 0;
                    $invoice_number  = 0;
                @endphp
                @foreach( $saleorder as $index => $posummary  )
                    @if($temp == 'Null')
                        @php
                            $temp =  $posummary->order_no;
                        @endphp
                    @endif
                    @if( empty($posummary->order_no))
                        <tr style="background-color: #fff7d6;" class="shadow-sm">
                            <th>Invoice  Total</th>
                            <th>Here</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">{{  $invoiceQuantity }}</th>
                            <th class="text-right">{{  number_format($invoiceTotal ,2)  }}</th>
                        </tr>
                        @php
                            $temp =  $posummary->order_no;
                            $invoiceQuantity = 0;
                            $invoiceTotal = 0;
                        @endphp
                    @endif
                    @php
                        $subt = $posummary->t_amt;
                        $grandTotal = $grandTotal + $subt;
                        $invoiceTotal = $invoiceTotal + $subt;
                        $grandQuantity = $grandQuantity + $posummary->weight;
                        $invoiceQuantity = $invoiceQuantity + $posummary->weight;

                        $invoice_number = $posummary->order_no;
                    @endphp
                    <tr id="#">
                        <td>{{date('d-M-y',strtotime($posummary->date))}}</td>
                        <td>{{$posummary->vendor}}</td>
                        <td>{{$posummary->product}}</td>
                        <td class="text-right">{{$posummary->order_no}}</td>
                        <td class="text-right">{{number_format($posummary->m_price  ,2)}}</td>
                        <td class="text-right">{{$posummary->weight}}</td>
                        <td class="text-right">{{ number_format($posummary->t_amt ,2)}}</td>
                    </tr>
                @endforeach

                <tfoot>
                {{--                <tr style="background-color: #fff7d6;" class="shadow-sm">--}}
                {{--                    <th>Invoice  Total</th>--}}
                {{--                    <th></th>--}}
                {{--                    <th></th>--}}
                {{--                    <th></th>--}}
                {{--                    <th></th>--}}
                {{--                    <th class="text-right">{{$invoiceQuantity}}</th>--}}
                {{--                    <th class="text-right">{{number_format($invoiceTotal  ,2)}} </th>--}}
                {{--                </tr>--}}
                <tr style="background-color: #db9b44;" class="text-light shadow-sm">
                    <th>{{'Grand Total :-'}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-right">{{ $grandQuantity  }}</th>
                    <th class="text-right">{{ number_format($grandTotal,2)}}</th>

                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>

@endsection

