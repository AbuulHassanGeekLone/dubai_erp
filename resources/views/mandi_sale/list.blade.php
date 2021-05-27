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
                        Delete Sale
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
            <a class="btn btn-primary mb-3" href="{{url('CreateSale')}}">Add Purchase</a>
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
                    <th>Mandi Weight</th>
                    <th>Mill Weight</th>
                    <th>Bhaker weight</th>
                    <th>Bhaker Amount</th>
                    <th>Beg Amount</th>
                    <th>Total Amount</th>
                    <th>Beg Amount</th>
                    <th>vehical Rent</th>
                    <th>remaning Amount</th>
{{--                    <th>Bill No</th>--}}
{{--                    <th>Loading Area</th>--}}
                    <th class="table-actionsPS">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sales as $index => $sale)
                    <tr id="tblrow_{{$sale ->id}}">
                        <td>{{$sale ->id}}</td>
                        <td>{{date("d-F-y", strtotime($sale->created_at))}}</td>
                        <td>{{ $sale->customer }}</td>
                        <td>{{ $sale->item }}</td>
                        <td>{{$sale->weight_of_one_bag}}</td>
                        <td>{{$sale->total_bag}}</td>
                        <td>{{$sale->price}}</td>
                        <td>{{$sale->mandi_weight}}</td>
                        <td>{{$sale->mill_weight}}</td>
                        <td>{{$sale->bhakar_weight}}</td>
                        <td>{{$sale->bhakar_amt}}</td>
                        <td>{{$sale->total_amt}}</td>
                        <td>{{$sale->vehical_rent}}</td>
                        <td>{{$sale->remaning_amt}}</td>
                        <td>{{$sale->bill_no}}</td>
                        <td>{{$sale->loading_area}}</td>
                        <td class="table-actionsPS">
                            <button
                                class="btn btn-secondary btn-sm"
                                style="margin-left: 5px;"
                                onclick="mandi_sale_printbtn({{$sale->id}});">
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
