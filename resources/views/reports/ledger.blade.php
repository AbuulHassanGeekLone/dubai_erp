@extends('layouts.app', ['title' => $title ?? '']) @section('content')

    <div class="pt-2" id="collapseExample">
        <div class="card card-body">
            <form action="" method="get">
                @csrf
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="">Date from</label>
                            <input name="date_from" type="text"
                                   value="{{ app('request')->input('date_from', Date('Y-m-d')) }}"
                                   class="form-control datepicker" placeholder="M d, Y">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="">Date to</label>
                            <input name="date_to" type="text"
                                   value="{{ app('request')->input('date_to', Date('Y-m-d')) }}"
                                   class="form-control datepicker" placeholder="M d, Y">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group label-fix">
                            <select id="ledgerType" name="ledgerType" class="custom-select select2" required>
                                <option value="" >Select Account</option>
                                <option @if(app('request')->input('ledgerType') == 1) selected @endif value="{{1 }}">Customer</option>
                                <option @if(app('request')->input('ledgerType') == 2) selected @endif value="{{ 2 }}">Vendor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group label-fix">
                            <select id="ledgerName" name="ledgerName" class="custom-select select2"
                                    required>
                                <option value="">Account Name</option>
                            @if(app('request')->input('ledgerType'))
                                @foreach($accountNames[app('request')->input('ledgerType')] as $accountName)
                                        @php $a = 0; $pre = app('request')->input('ledgerType') ;
                                            $accVal = $accountName->id.','.$pre.','.$a; @endphp
                                        <option @if(app('request')->input('ledgerName') == $accountName->id) selected
                                            @endif value="{{ $accVal }}">{{$accountName->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" name="search" value="search" class="btn btn-primary label-fix">Search
                            Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            @if($accountSetting)
                <table>
                    <tr><th><h3>{{$accountSetting->name}}</h3></th></tr>
                    <tr><th>{{date("M-d-Y", strtotime($date_from))}} <b> to </b> {{date("M-d-Y", strtotime($date_to))}}</th></tr>
                </table>
            @endif
            <table id="ledger" class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Invoice#</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
                </thead>
                <tbody>
                @php $tdebit = 0 ; $tcredit = 0 ; $closingBalance = 0;@endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Opening Balance </b></td>
                    @if($openingBalance >=1)

                    <td class="text-right">{{number_format(abs($openingBalance),2)}}</td>
                    <td></td>
                        @php $tdebit = $tdebit + $openingBalance; @endphp
                    @else
                        @php $tcredit = $tcredit + $openingBalance;@endphp
                    <td></td>
                    <td class="text-right">{{number_format(abs($openingBalance),2)}}</td>
                    @endif
                    <td></td>
                </tr>
                @foreach($journal as $index => $value)
                    <tr>
                        <td>{{$index +1}}</td>
                        <td>{{date("d-F-y", strtotime($value->created_at))}}</td>
                        <td>{{$value->description}}</td>
                        @if($value->s_p_am_id)
                            <td>Inv-{{$value->s_p_am_id}}</td>
                        @else
                            <td>A/M-{{$value->id}}</td>
                        @endif
                        @if($value->transection_type_id == 1)
                            @php
                                $tdebit = $tdebit + $value->amount;
                            @endphp
                            <td class="text-right">{{number_format($value->amount,2)}}</td>
                            <td></td>
                        @else
                            @php
                                $tcredit = $tcredit + $value->amount;
                            @endphp
                            <td></td>
                            <td class="text-right">{{number_format($value->amount,2)}}</td>
                        @endif

                    </tr>
                @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-right">Total : </th>
                        <th class="text-right">{{number_format($tdebit,2)}}</th>
                        <th class="text-right">{{number_format($tcredit,2)}}</th>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    @php $closingBalance = $tdebit - $tcredit @endphp
                    @if($closingBalance >=1)
                        <th class="text-right">Recievable :</th>
                        <th class="text-right">{{number_format($closingBalance,2)}}</th>
                        <th class="text-right"></th>
                    @else
                        <th class="text-right">Payable :</th>
                        <th class="text-right"></th>
                        <th class="text-right">{{number_format(abs($closingBalance),2)}}</th>
                    @endif
                </tr>
                </tfoot>

            </table>
        </div>
    </div>

@endsection
