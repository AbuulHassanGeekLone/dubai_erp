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
                            <select id="accountName" name="accountName" class="custom-select select2"
                                    aria-label="Example select with button addon">
                                <option value="">Select Account</option>
                                @foreach($accounts as $account)
                                    @php
                                        $accVal = $account->id.','.$account->type.','.$account->account_type_ro; @endphp
                                    <option @if(app('request')->input('accountName') == $accVal) selected
                                            @endif  value="{{ $accVal }}">{{ $account->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" name="search" value="search" class="btn btn-primary label-fix">Search
                            Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button id="addnew" class="btn btn-primary btn-link collapsed" style="color:white "
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                        + Add New
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                    <form id="journalform" class="form-horizontal" action="{{route('journal.store')}}" method="post">
                        {{csrf_field()}}
                        <input id="debit_id" name="debit_id" type="text" hidden>
                        <input id="credit_id" name="credit_id" type="text" hidden>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date<span style="color: tomato;font-size:16px;"> * </span></label>
                                    <input id="date" name="date_to" type="text"
                                           value="{{ app('request')->input('date_from', Date('Y-m-d')) }}"
                                           class="form-control datepicker" placeholder="M d, Y">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Debit Account<span class="color-tomato"> * </span></label>
                                <div class="form-group">
                                    <select id="debit" name="debit_account" class="custom-select select2"
                                            aria-label="Example select with button addon" required>
                                        <option value="">Select Account</option>
                                        @foreach($debitAccounts as $account)
                                            @php $accVal = $account->id.','.$account->type.','.$account->account_type; @endphp
                                            <option value="{{ $accVal }}">{{ $account->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="">Amount</label>
                                    <span style="color: tomato;font-size:16px;"> * </span>
                                    <input id="amount" type="number" min="1" step=".01" class="form-control"
                                           placeholder="Debit Amount" name="amount" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="">Description</label>
                                    <input id="description" type="text" class="form-control" placeholder="Description"
                                           name="description">
                                </div>
                            </div>
                            <!-- Credit Account -->
                            <div class="col-sm-4">
                                <label>Credit Account<span class="color-tomato"> * </span></label>
                                <div class="form-group">
                                    <select id="credit" name="credit_account" class="custom-select select2"
                                            aria-label="Example select with button addon" required>
                                        <option value="">Select Account</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary mt-2" style="min-width: 100px" type="submit"> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--   <a class="btn btn-primary ml-3" href="{{url('journal/create')}}" >Add New</a>--}}

    <div class="card mt-3">
        <div class="card-body">
            <table id="journal" class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice#</th>
                    <th>Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @php $debitObject = null; $tdebit = 0 ; $tcredit = 0 ;@endphp

                @foreach($journal as $index => $value)
                    <tr class="tblrow_{{$value->journal_uuid }}">
                        <td>{{$index +1}}</td>
                        @if($value->s_p_am_id)
                            <td>Inv-{{$value->s_p_am_id}}</td>
                        @else
                            <td>A/M-{{$value->id}}</td>
                        @endif
                        <td>{{$value->account_name}}</td>
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
                        <td>{{$value->description}}</td>
                        <td>{{date("d-F-y", strtotime($value->created_at))}}</td>
                        <td>
                            @if($value->transection_type_id == 1)
                                @php $debitObject = $value; @endphp
                            @elseif(!$value->s_p_am_id)
                                <a type="button"
                                   onclick="editJournal({{json_encode($debitObject)}}, {{json_encode($value) }})"
                                   class="btn btn-primary btn-sm"
                                   href="#accordion"
                                ><i class="fa fa-edit"></i>
                                </a>

                                <button type="button" onclick="$('#delete_id').val({{$value->id}})"
                                        class="btn btn-danger cutm_btn btn-sm" data-toggle="modal"
                                        data-target="#deleteModal"><i class="fa fa-trash"></i>
                                </button>

                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th class="text-right">Total :</th>
                    <th class="text-right">{{number_format($tdebit,2)}}</th>
                    <th class="text-right">{{number_format($tcredit,2)}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @if($result)
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th class="text-right">Final Total :</th>
                        <th class="text-right">@if($result == "debit"){{number_format($tdebit - $tcredit,2)}} @endif</th>
                        <th class="text-right">@if($result == "credit"){{number_format($tcredit - $tdebit,2)}} @endif</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    @endif
                    </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cutm_btn" data-dismiss="modal">No</button>
                    <button id="dlt_journal" type="button" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
