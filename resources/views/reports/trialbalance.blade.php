@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
<html>

<head>
    <title>

    </title>


</head>

<body>

    <div class="container">
    <div class="pt-2" id="collapseExample">
        <div class="card card-body">

            <form class="form-inline" action="{{route('trialbalance')}}" method="GET" style="margin: auto;">
                @csrf
                <label>Date to : </label>&nbsp;
                <input type="text" style="width:30% !important;" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class=" mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">

                <button type="submit" class="btn btn-primary" name="search" value="search">Generate Report</button>

            </form>
        </div>
    </div>
    {{-- Balance Sheet Start from here   --}}
    @if($search === 1)
    <div class="invoice mt-5" id="invisibale">
        <div class="row" id="invioce2">
            <div class="col-sm-12">
                <p class="document-type text-center mt-5"><b>Trial Balance</b> <br><span>{{date("M-d-Y", strtotime($date_to))}}</span></p>

            </div>
        </div>
        @php
        $fdebit =  $data[2]->debit + $data[5]->debit + $data[10]->debit + $data[11]->debit;
        $fcredit = $data[2]->credit + $data[3]->credit + $data[5]->credit + $data[11]->credit;
        @endphp


        <table class="table table-borderless table-sm" style="width: 550px; margin:auto">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Debit</th>
      <th scope="col">Credit</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><b class="text-right">Account Receviable</b></td>
      <td></td>
      <td></td>
    </tr>
    @foreach($recievables as $recvable)
        @php

            $fdebit = $fdebit + $recvable->debit;
            $fcredit = $fcredit + $recvable->credit;
        @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$recvable->name}}</td>
            <td>{{number_format($recvable->debit,2)}}</td>
            <td>{{number_format($recvable->credit,2)}}</td>
        </tr>
    @endforeach
    @foreach($customers as $customer)
        @php
            $fdebit = $fdebit + $customer->debit;
            $fcredit = $fcredit + $customer->credit;
        @endphp
    <tr>
        <th scope="row"></th>
        <td>{{$customer->name}}</td>
        <td>{{number_format($customer->debit,2)}}</td>
        <td>{{number_format($customer->credit,2)}}</td>
    </tr>
    @endforeach
    <!-- Account Payable -->
    <tr>
      <th scope="row"></th>
      <td><b class="text-right">Account Payable</b></td>
      <td></td>
      <td></td>
    </tr>
    @foreach($payables as $payable)
        @php
            $fdebit = $fdebit + $payable->debit;
            $fcredit = $fcredit + $payable->credit;
        @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$payable->name}}</td>
            <td>{{number_format($payable->debit,2)}}</td>
            <td>{{number_format($payable->credit,2)}}</td>
        </tr>
    @endforeach
    @foreach($vendors as $vendor)
        @php
            $fdebit = $fdebit + $vendor->debit;
            $fcredit = $fcredit + $vendor->credit;
        @endphp
    <tr>
        <th scope="row"></th>
        <td>{{$vendor->name}}</td>
        <td>{{number_format($vendor->debit,2)}}</td>
        <td>{{number_format($vendor->credit,2)}}</td>
    </tr>
    @endforeach
     <!-- Expense -->
     <tr>
      <th scope="row"></th>
      <td><b class="text-right">Expenses</b></td>
      <td></td>
      <td></td>
    </tr>
    @foreach($expenses as $expense)
        @php
            $fdebit = $fdebit + $expense->debit;
            $fcredit = $fcredit + $expense->credit;
        @endphp
    <tr>
      <th scope="row"></th>
      <td>{{$expense->name}}</td>
      <td>{{number_format($expense->debit,2)}}</td>
      <td>{{number_format($expense->credit,2)}}</td>
    </tr>
    @endforeach
    <tr>
        <th scope="row"></th>
        <td><b>Other</b></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td>cash</td>
        <td>{{number_format($data[11]->debit,2)}}</td>
        <td>{{number_format($data[11]->credit,2)}}</td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td>inventry Asset</td>
        <td>{{number_format($data[2]->debit,2)}}</td>
        <td>{{number_format($data[2]->credit,2)}}</td>
    </tr>
    @foreach($banks as $bank)
        @php
            $fdebit = $fdebit + $bank->debit;
            $fcredit = $fcredit + $bank->credit;
        @endphp
    <tr>
        <th scope="row"></th>
        <td>{{$bank->name}}</td>
        <td>{{number_format($bank->debit,2)}}</td>
        <td>{{number_format($bank->credit,2)}}</td>
    </tr>
    @endforeach
    @foreach($equity as $eq)
        @php
            $fdebit = $fdebit + $eq->debit;
            $fcredit = $fcredit + $eq->credit;
        @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$eq->name}}</td>
            <td>{{number_format($eq->debit,2)}}</td>
            <td>{{number_format($eq->credit,2)}}</td>
        </tr>
    @endforeach
    @foreach($income as $in)
        @php
            $fdebit = $fdebit + $in->debit;
            $fcredit = $fcredit + $in->credit;
        @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$in->name}}</td>
            <td>{{number_format($in->debit,2)}}</td>
            <td>{{number_format($in->credit,2)}}</td>
        </tr>
    @endforeach
    <tr>
        <th scope="row"></th>
        <td>Cost of good sold</td>
        <td>{{number_format($data[5]->debit,2)}}</td>
        <td>{{number_format($data[5]->credit,2)}}</td>
    </tr>
    <!-- total -->
    <tr class="spaceUnder">
      <th scope="row"></th>
      <td><b>Total</b></td>
      <td style="border-bottom: double;border-top: solid;">{{number_format($fdebit,2)}}</td>
      <td style="border-bottom: double;border-top: solid;">{{number_format($fcredit,2)}}</td>
    </tr>
    <tr class="blank_row" style="height:40px">
    <td colspan="3"></td>
</tr>
  </tbody>
</table>

    </div>
    @endif
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $("#save").click(function(e) {
            e.preventDefault();
            $("#invisibale").toggle();
        });
    </script>
</body>

</html>


@endsection
