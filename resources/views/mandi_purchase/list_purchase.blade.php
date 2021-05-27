@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ml-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchases</li>
        </ol>
    </nav>
    <div
        class="modal fade"
        id="deleteModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="deleteModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Delete purchase
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id"/>
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary cutm_btn"
                        data-dismiss="modal"
                    >
                        No
                    </button>
                    <button
                        type="button"
                        id="dlt_purchase"
                        class="btn btn-primary cutm_btn"
                    >
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top:-15px">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="{{url('mandi_purchase')}}">Add Purchase</a>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Bag Weight</th>
                    <th>Total Bag</th>
                    <th>Price (40 kg)</th>
                    <th>Total Weight</th>
                    <th>Total Amount</th>
                    <th>Beg Filling</th>
                    <th>Beg Loading</th>
                    <th>Beg Stitching</th>
                    <th>Market Fee</th>
                    <th>Beg Price</th>
                    <th class="table-actionsPS">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchases as $index => $purchase)
                    <tr id="tblrow_{{$purchase->id}}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{date("d-F-y", strtotime($purchase->created_at))}}</td>
                        <td>{{$purchase->customer}}</td>
                        <td>{{ $purchase->item }}</td>
                        <td>{{$purchase->weight_of_one_bag}}</td>
                        <td>{{$purchase->total_bag}}</td>
                        <td>{{$purchase->price}}</td>
                        <td>{{$purchase->total_weight}}</td>
                        <td>{{$purchase->total_amt}}</td>
                        <td>{{$purchase->filling_of_bag}}</td>
                        <td>{{$purchase->loading_of_bag}}</td>
                        <td>{{$purchase->stitching_of_bag}}</td>
                        <td>{{$purchase->market_fee_of_bag}}</td>
                        <td>{{$purchase->bag_price}}</td>
                        <td class="table-actionsPS">
                            <button
                                class="btn btn-secondary btn-sm"
                                style="margin-left: 5px;"
                                onclick="mandi_purchase_printbtn({{$purchase->id}});">
                                    <i class="fa fa-print"></i>
                            </button>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
