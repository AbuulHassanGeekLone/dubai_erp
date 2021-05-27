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
                <table class="table table-sm"  >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th class="text-right">Order No</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $tquantity = 0; $gtotal = 0;
                    @endphp
                    @foreach( $saleorder as $index => $soreport  )
                        @php
                            $temp =  $soreport->customer_id;
                            $tquantity = $tquantity + $soreport->quantity ;
                            $gtotal = $gtotal + $soreport->amount ;
                        @endphp

                        <tr id="#">
                            <td>{{$index +1}}</td>
                            <td>{{date('d-M-y',strtotime($soreport->date))}}</td>
                            <td>{{$soreport->customer}}</td>
                            <td class="text-right">{{$soreport->order_no}}</td>
                            <td class="text-right">{{$soreport->quantity}}</td>
                            <td class="text-right">{{ number_format($soreport->amount,2)}}</td>
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr style="background-color: #db9b44;" class="text-light shadow-sm">
                        <th>{{'Total :-'}}</th>
                        <th></th>
                        <th></th>
                        <th></th>

                        <th class="text-right">{{ $tquantity  }}</th>
                        <th class="text-right">{{ number_format($gtotal,2)}}</th>
                    </tr>
                    </tfoot>


                </table>
            </div>
        </div>

@endsection

