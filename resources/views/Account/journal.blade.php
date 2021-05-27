@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<div class="card-body">
    <form class="form-horizontal" action="{{route('journal.store')}}" method="post">
        {{csrf_field()}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Journal</h3>
                <h1 class="text-light float-right" style="margin-top: -17px;" data-toggle="collapse" href="#backdrop" role="button" aria-expanded="false" aria-controls="backdrop">+</strong></h1>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body" id="backdrop">
                <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date<span style="color: tomato;font-size:16px;"> * </span></label>
                            <input type="text" value="{{ app('request')->input('date_from', Date('Y-m-d')) }}" class="form-control datepicker" placeholder="M d, Y" name="date_to">
                        </div>
                    </div>
                    <!-- Add Debit Account -->
                    <div class="col-sm-4">
                        <label>Debit Account<span class="color-tomato"> * </span></label>
                        <div class="input-group">
                            <select class="custom-select select2" aria-label="Example select with button addon" name="debit_account">
                                <option value=""><small class="text-muted">Credit Account</small></option>
                                @foreach($account_type as $value)
                                <option value="{{$value->account_name}}"><small class="text-muted">{{$value->account_name}}</small></option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                            </div>
                        </div>
                    </div>
                    <!-- Debit Amount -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Debit Amount</label>
                            <span style="color: tomato;font-size:16px;"> * </span>
                            <input type="number" min="1" step=".01" class="form-control" placeholder="Debit Amount" name="d_amount" required>
                        </div>
                    </div>


                </div>

                {{-- ======Next Row=====  --}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Description</label>
                            <input type="text" class="form-control" placeholder="Description" name="description">
                        </div>
                    </div>
                    <!-- Credit Account -->
                    <div class="col-sm-4">
                        <label>Credit Account<span class="color-tomato"> * </span></label>
                        <div class="input-group">
                            <select class="custom-select select2" aria-label="Example select with button addon" name="credit_account">
                                <option value=""><small class="text-muted">Credit Account</small></option>
                                @foreach($account_type as $value)
                                <option value="{{$value->account_name}}">{{$value->account_name}}</small></option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Credit Amount<span style="color: tomato;font-size:16px;"> *</span></label>

                            <input type="text" class="form-control" placeholder="Credit Amount" name="c_amount" required>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="b1" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="save and go to list">Save</button>

            </div>

        </div>
    </form>
    {{--============= DropDown Model For New Add Account  ===========--}}

    <!--========================= Model Second======================== -->
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <!--========================== Form  =================-->
                    <form class="form-horizontal" action="" method="post">
                        {{csrf_field()}}
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Account</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body" id="backdrop">
                                <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control" id="Accout_Type">
                                                <label for="description"><small><b>Account Type:</b></small></label>
                                                <!-- <option class="text-muted" selected><small>Account Type</small></option> -->
                                                <option value="">Account Payable</option>
                                                <option value="">Account Receivable</option>
                                                <option value="">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Account Type   --}}

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description"><small><b>Account Name:</b></small></label>
                                            <input type="text" class="form-control" id="Accout_Name" name="Accout_Name" placeholder="Account Name">
                                        </div>
                                    </div>
                                    {{-- Description --}}

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description"><small><b>Description:</b></small></label>
                                            <textarea class="form-control" id="description" name="description" rows="1"></textarea>
                                        </div>
                                    </div>
                                    {{-- Account Type   --}}

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description"><small><b>Opening Balance:</b></small></label>
                                            <input type="text" class="form-control" id="Opening_Balance" name="Opening_Balance" placeholder="Opening Balance">
                                        </div>
                                    </div>

                                    {{-- Account Status  --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description"><small><b>Account Status:</b></small></label>
                                            <select class="form-control" id="Accout_Status">
                                                <option class="text-muted" selected><small>Enable</small></option>
                                                <option value="">Disable</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
