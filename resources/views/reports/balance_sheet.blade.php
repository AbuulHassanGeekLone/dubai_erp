@extends('layouts.app', ['title' => $title ?? ''])
@section('content')

<div class="pt-2" id="collapseExample">
    <div class="card card-body">

        <form class="form-inline" action="{{route('balance_sheet')}}" method="GET" style="margin: auto;">
            @csrf
            <label>Date to : </label>&nbsp;
            <input type="text" style="width:30% !important;" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class=" mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">

            <button type="submit" class="btn btn-primary" name="search" value="search">Generate Report</button>

        </form>
    </div>
</div>

{{-- Balance Sheet Start from here   --}}
@if($search)
<div class="invoice mt-3" id="invisibale">
    <div class="row mt-2 mb-0" id="invioce2">
        <div class="col-sm-12">
            <p class="document-type text-center mt-5"><b>Balance Sheet </b><br><span>{{date("M-d-Y", strtotime($date_to))}}</p>
        </div>
    </div>

    @php
    $assetTotal = 0;
    $assetTotal = $data[11]->debit - $data[11]->credit;
    $assetTotal = $assetTotal + $data[2]->debit - $data[2]->credit;
    $sale = 0;
    $account_payable = 0;
    $equityTotal = $account_payable;
    $eqTotal = 0;
    @endphp

    @foreach($customers as $customer)
        @php

            $accountRecivable = $accountRecivable + $customer->debit - $customer->credit;
        @endphp
    @endforeach

    @foreach($recievables as $recvable)
        @php

            $accountRecivable = $accountRecivable + $recvable->debit - $recvable->credit;
        @endphp
    @endforeach

    <table class="table table-borderless table-sm" style="width: 550px; margin:auto">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"></th>
            <td><b class="text-right">Assets</b></td>
        </tr>
        <tr>
            <th scope="row"></th>
            <td><b class="text-right">Cash</b></td>
            <td>{{number_format($data[11]->debit - $data[11]->credit,2)}}</td>
        </tr>
        <tr>
            <th scope="row"></th>
            <td><b class="text-right">Inventry Assets</b></td>
            <td>{{number_format($data[2]->debit - $data[2]->credit,2)}}</td>
        </tr>
        <tr>
            <th scope="row"></th>
            <td><b class="text-right">Bank</b></td>
            <td></td>

        </tr>
        @foreach($banks as $bank)
            @php
                $assetTotal = $assetTotal + $bank->debit  - $bank->credit;
            @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$bank->name}}</td>
            <td>{{number_format($bank->debit  - $bank->credit,2)}}</td>
        </tr>
        @endforeach

        <tr>
            <th scope="row"></th>
            <td><b class="text-right">Account Recievable</b></td>
            <td>{{ $accountRecivable }}</td>
        </tr>
        <tr>
            <th scope="row"></th>
            <td><b>Total</b></td>
            <td style="border-bottom: double;border-top: solid;">{{number_format($assetTotal + $accountRecivable,2)}}</td>
        </tr> <br>
        <!--=========== Liabilities and Equity ==========-->

        <tr>
            <th scope="row"></th>
            <td><b class="text-right">LIABILITIES & EQUITY</b></td>
        </tr>

        <tr>
            <th scope="row"></th>
            <td >Liabilities</td>
            <td></td>

        </tr>
        @foreach($vendors as $vendor)
            @php
                $equityTotal = $equityTotal + $vendor->credit - $vendor->debit;
                $account_payable = $account_payable + $vendor->credit - $vendor->debit;
            @endphp
        @endforeach
        @foreach($payables as $payable)
            @php
                $equityTotal = $equityTotal + $payable->credit - $payable->debit;
                $account_payable = $account_payable + $payable->credit - $payable->debit;
            @endphp
        @endforeach
        <tr>
            <th scope="row"></th>
            <td>Account Payable</td>
            <td>{{number_format($account_payable,2)}}</td>
        </tr>

        <tr>
            <th scope="row"></th>
            <td><b>Total Libilities</b></td>

            <td style="border-bottom: double;border-top: solid;">{{number_format($account_payable,2)}}</td>
        </tr> <br>
            <!-- Expense -->
            <!--=========== Liabilities and Equity ==========-->
            <tr>
            <th scope="row"></th>
            <td><b class="text-right">EQUITY</b></td>
        </tr>

        @foreach($equity as $eq)
            @php
                $equityTotal = $equityTotal + $eq->credit - $eq->debit;
                $eqTotal = $eqTotal + $eq->credit - $eq->debit;
            @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$eq->name}}</td>
            <td>{{number_format($eq->credit - $eq->debit,2)}}</td>
        </tr>
        @endforeach

        @foreach($income as $in)
            @php

                $equityTotal = $equityTotal + $in->credit - $in->debit;
                $eqTotal = $eqTotal + $in->credit - $in->debit;
            @endphp
        <tr>
            <th scope="row"></th>
            <td>{{$in->name}}</td>
            <td>{{number_format($in->credit - $in->debit,2)}}</td>
        </tr>
        @endforeach

        @php
            $profit = 0;
            $sale = $data[14]->credit - $data[14]->debit;
            $cgs = $data[5]->debit - $data[5]->credit;
            $profit = $sale - $cgs;
            $ex = 0;
        @endphp

        @foreach($expenses as $expense)
            @php
            $ex = $ex + $expense->debit - $expense->credit;
            @endphp
        @endforeach
        @php
        $profit = $profit - $ex;
        $equityTotal = $equityTotal + $profit;
        @endphp

            <tr>
                <th scope="row"></th>
                <td>Net Income</td>
                <td>{{number_format($profit,2)}}</td>
            </tr>

        <tr>
            <th scope="row"></th>
            <td>Total Equity</td>
            <td>{{number_format($eqTotal + $profit,2)}}</td>

        </tr>

        <tr>
            <th scope="row"></th>
            <td><b>Total Libilities & Equity</b></td>

            <td style="border-bottom: double;border-top: solid;">{{number_format($equityTotal,2)}}</td>
        </tr>
        <tr class="blank_row" style="height:40px">
        <td colspan="3"></td>
        </tr>
        </tbody>
    </table>
</div>
@endif

<script type="text/javascript">
    $("#save").click(function(e) {
        e.preventDefault();
        $("#invisibale").toggle();
    });
</script>
@endsection
