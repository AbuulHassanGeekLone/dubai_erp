@extends('layouts.app', ['title' => $title ?? '']) @section('content')

<div class="card mt-2">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Purchase ID</th>
                    <th width="200">Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchasedetails as $index => $purchasedetail)
                <tr id="tblrow_{{$purchasedetail->id}}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{$purchasedetail->purchase_id}}</td>
                    <td>{{$purchasedetail->product}}</td>
                    <td>{{$purchasedetail-> quantity}}</td>
                    <td>{{$purchasedetail->unit_price}}</td>
                    <td>{{$purchasedetail->sale_price}}</td>
                    <td>{{$purchasedetail-> discount}}</td>
                    <td>
                        @php
                            $net = $purchasedetail->unit_price * $purchasedetail->discount;
                            $net = $net/100;
                            $net = $purchasedetail->unit_price - $net;
                            echo $net*$purchasedetail-> quantity;
                        @endphp
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
