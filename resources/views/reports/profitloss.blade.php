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

                <form class="form-inline" action="{{route('profitloss')}}" method="GET" style="margin: auto;">
                    @csrf
                    <label>Date from : </label>&nbsp;
                    <input type="text" style="width:30% !important;" value="{{ app('request')->input('date_from', Date('Y-m-d')) }}" class=" mr-sm-2 datepicker" placeholder="M d, Y" name="date_from">

                    <label>Date to : </label>&nbsp;
                    <input type="text" style="width:30% !important;" value="{{ app('request')->input('date_to', Date('Y-m-d')) }}" class=" mr-sm-2 datepicker" placeholder="M d, Y" name="date_to">

                    <button type="submit" class="btn btn-primary ml-1" name="search" value="search">Generate Report</button>

                </form>
            </div>
        </div>
        {{-- Balance Sheet Start from here   --}}
        @if($search)
            <div class="invoice mt-3" id="invisibale">

                <div class="row mt-2 mb-0" id="invioce2">
                    <div class="col-sm-12">
                        <p class="document-type text-center mt-5"><b>Profit & Loss Report</b><br><span>{{date("M-d-Y", strtotime($date_from))}} <b> to </b> {{date("M-d-Y", strtotime($date_to))}}</p>

                    </div>
                </div>
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
                    @php
                    $sale = $data[14]->credit - $data[14]->debit;
                    $cgs = $data[5]->debit - $data[5]->credit;
                    $texpense = 0;
                    @endphp
                    @foreach($expenses as $expense)
                        @php
                        $texpense +=  $expense->debit - $expense->credit;
                        @endphp
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td><b class="text-right">Ordinary Income/Expense</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Sales</td>
                        <td>{{number_format($sale,2)}}</td>

                    </tr>

                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td><b>Total</b></td>
                            <td style="border-bottom: double;border-top: solid;">{{number_format($sale,2)}}</td>

                        </tr> <br>
                        <!--=========== Liabilities and Equity ==========-->

                        <tr>
                            <th scope="row"></th>
                            <td><b class="text-right">Cost of goods Sold</b></td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td >Cost of goods Sold</td>
                            <td>{{number_format($cgs,2)}}</td>

                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td><b>Total Gross Profit</b></td>

                            <td style="border-bottom: double;border-top: solid;">{{number_format($sale - $cgs,2)}}</td>
                        </tr> <br>
                        <!-- Expense -->
                        <!--=========== Liabilities and Equity ==========-->
                        <tr>
                            <th scope="row"></th>
                            <td><b class="text-right">Expenses</b></td>
                        </tr>


                            <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                            </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Total expenses</td>
                            <td>{{number_format($texpense,2)}}</td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td><b>Net Income</b></td>

                            <td style="border-bottom: double;border-top: solid;">{{number_format($sale - $cgs - $texpense, 2)}}</td>
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

