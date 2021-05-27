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
            <a class="btn btn-primary mb-3" href="{{route('purchase.create')}}">Add Purchase</a>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
{{--                    <th>Status</th>--}}
                    <th class="table-name">Vendor</th>
                    <th>Payment Type</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th class="table-actionsPS">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchases as $index => $purchase)
                    @php
                        $vendor_name = ucfirst($purchase->vendor);
                    @endphp
                    <tr id="tblrow_{{$purchase->id}}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{date("d-F-y", strtotime($purchase->created_at))}}</td>
{{--                        <td>--}}
{{--                            @if ($purchase-> status === 1)--}}
{{--                                <h5><span class="badge badge-success ">Paid</span></h5>--}}
{{--                            @elseif($purchase-> status === 2)--}}
{{--                                <h6><span class="badge badge-primary">Partialy Paid</span></h6>--}}
{{--                            @else--}}
{{--                                <h6><span class="badge badge-danger">Un Paid</span></h6>--}}
{{--                            @endif--}}
{{--                        </td>--}}
                        <td class="table-name">{{ $vendor_name }}</td>
                        <td>{{$purchase->type}}</td>
                        <td class="text-right">{{number_format($purchase->total_amount,2) }}</td>
                        <td class="text-right">{{number_format($purchase->paid_amount,2)}}</td>
                        <td class="text-right">{{number_format($purchase->total_amount - $purchase->paid_amount,2)}}</td>
                        <td class="table-actionsPS">
                            @if($purchase-> status == 0)
                                <a
                                    class="btn btn-primary btn-sm"
                                    style="margin-left: 5px;"
                                    href="{{ url('/purchaseedit/') }}/{{$purchase->id}}"
                                ><i class="fa fa-edit"></i
                                    ></a>
                                <button
                                    class="btn btn-secondary btn-sm"
                                    style="margin-left: 5px;"
                                    onclick="p_printbtn({{$purchase->id}});"

                                ><i class="fa fa-print"></i
                                    ></button>
                                <button
                                    type="button"
                                    onclick="$('#delete_id').val({{$purchase->id}})"
                                    class="btn btn-danger cutm_btn btn-sm d-none"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>
                            @else
{{--                                <a--}}
{{--                                    class="btn btn-primary btn-sm"--}}
{{--                                    style="margin-left: 5px;"--}}
{{--                                    href="{{ url('/purchaseedit/') }}/{{$purchase->id}}"--}}
{{--                                ><i class="fa fa-eye"></i--}}
{{--                                    ></a>--}}
                                <button
                                    class="btn btn-secondary btn-sm"
                                    style="margin-left: 5px;"
                                    onclick="p_printbtn({{$purchase->id}});"

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
