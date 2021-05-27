@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
 <div class="card card-body">
    <form class="form" action="" method="get">
        @csrf

            <div class="row">

                <div class="col-sm-2">
                    <select
                        class="form-control select select2"
                        name="modelType"
                        id="modelType"
                        >
                        <option value="">Select Type</option>
                        <option @if(app('request')->input('modelType') == 1) selected @endif
                         value="1">Customer</option>
                        <option  @if(app('request')->input('modelType') == 2) selected @endif
                         value="2">Vendor</option>
                        <option  @if(app('request')->input('modelType') == 3) selected @endif
                         value="3">Cash&Bank</option>

                    </select>
                </div>

                <div class="col-sm-2">
                    <select
                        class="form-control select select2"
                        name="model_name"
                        id="model_name"

                    >
                        <option value="">Select Name</option>
                    </select>
                </div>

                <div class="col-sm-1">
                  <lable>Date from:</lable>
                </div>
                <div class="col-sm-2">
                    <input type="text" value="{{ app('request')->input('date_from', Date('Y-m-d')) }}" class="form-control datepicker" placeholder="M d, Y" name="date_from">
                </div>

                 <div class="col-sm-1 float-right" >
                     <lable>Date to :</lable>
                 </div>

                <div class="col-sm-2">
                    <input type="text" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class="form-control mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">
                </div>

                <div class="col-sm-2">
                    <button type="submit"  name="search" value="search" class="btn btn-primary ml-2 mb-4">Search Data</button>
                </div>

            </div>
    </form>
</div>



    <div class="card mt-2">
        <div class="card-body">

            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Number</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th class="">Description</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                @php
                $temp = 0;
                @endphp
                @foreach ($transections as $index => $transaction)

                @php
                    $temp = $temp + $transaction->amount;
                    $temp = $temp - $transaction->paid;
                    $balance = $temp
                @endphp
                    <tr id="tblrow_{{$transaction->id}}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{date("d-F-y", strtotime($transaction->created_at))}}</td>
                        <td class="text-center">{{$transaction->number}}</td>
                        <td class="text-right">{{number_format($transaction->amount,2)}}</td>
                        <td class="text-right">{{number_format($transaction->paid,2)}}</td>
                        <td class="">{{$transaction->description}}</td>
                        <td>{{$balance}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
