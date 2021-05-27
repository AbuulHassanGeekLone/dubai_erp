@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ml-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
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
                        Delete sale
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
                        id="dlt_sale"
                        class="btn btn-primary cutm_btn"
                    >
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="sale_invoice" style="margin-top:-15px">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="{{route('sale.create')}}">Add Sale</a>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="table-name">Customer</th>
                    <th>Payment Type</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th class="table-actionsPS">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sales as $index => $sale)
                    @php
                        $sale_customer = $sale->customer;
                    @endphp
                    <input type="hidden" value="{{$sale->status}}"/>
                    <tr id="tblrow_{{$sale->id}}" class="table_tr" data-table_row_id={{$sale->id}} >
                        <td>{{ $index + 1 }}</td>
                        <td>{{date("d-F-y", strtotime($sale->created_at))}}</td>
                        <td class="sale_status" data-table_sale_id={{$sale->status}}>
                            @if ($sale-> status === 1)
                                <h5><span class="badge badge-success">Paid</span></h5>
                            @elseif($sale-> status === 2)
                                <h6><span class="badge badge-primary">Partialy Paid</span></h6>
                            @else
                                <h6><span class="badge badge-danger">Un Paid</span></h6>
                            @endif
                        </td>
                        <td class="table-name">{{$sale_customer}}</td>
                        <td>{{$sale->type}}</td>
                        <td class="text-right">{{number_format($sale->total_amount,2)}}</td>
                        <td class="text-right">{{number_format($sale->paid_amount ,2)}}</td>
                        <td class="text-right">{{number_format($sale->total_amount - $sale->paid_amount,2)}}</td>
                        <td style="min-width: 130px">
                            @if($sale->status == 0)
                                <a
                                    class="btn btn-primary btn-sm"
                                    style="margin-left: 5px;"
                                    href="{{ url('/saleedit/') }}/{{$sale->id}}"
                                ><i class="fa fa-edit"></i
                                    ></a>

                                <button
                                    class="btn btn-secondary btn-sm"
                                    style="margin-left: 5px;"
                                    onclick="printbtn({{$sale->id}});"

                                ><i class="fa fa-print"></i
                                    ></button>
                                <button
                                    type="button"
                                    onclick="$('#delete_id').val({{$sale->id}})"
                                    class="btn btn-danger cutm_btn btn-sm d-none"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>
                            @else
                                <a
                                    class="btn btn-primary btn-sm"
                                    style="margin-left: 5px;"
                                    href="{{ url('/saleedit/') }}/{{$sale->id}}"
                                ><i class="fa fa-eye"></i
                                    ></a>
                                <button
                                    class="btn btn-secondary btn-sm"
                                    style="margin-left: 5px;"
                                    onclick="printbtn({{$sale->id}});"

                                ><i class="fa fa-print"></i
                                    ></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
