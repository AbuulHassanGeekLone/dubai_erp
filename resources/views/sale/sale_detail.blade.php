@extends('layouts.app', ['title' => $title ?? '']) @section('content')

<div class="card mt-2">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sale ID</th>
                    <th width="200">Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Net Price</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saledetails as $index => $saledetail)
                <tr id="tblrow_{{$saledetail->id}}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{$saledetail->sale_id}}</td>
                    <td>{{$saledetail->product}}</td>
                    <td>{{$saledetail-> quantity}}</td>
                    <td>{{$saledetail->unit_price}}</td>
                    <td>{{$saledetail-> discount}}</td>
                    <td>
                         @php
                            $net = $saledetail->unit_price * $saledetail->discount;
                            $net = $net/100;
                            $net = $saledetail->unit_price - $net;
                            echo $net;
                        @endphp
                    </td>
                    <td>{{$net * $saledetail->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
