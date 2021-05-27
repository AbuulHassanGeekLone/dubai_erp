@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<div class="card-body">
<form class="form-horizontal" action="{{url('journal_update')}}/{{$data->id}}" method="post" >
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

    <input type="text" value="{{$data->date}}" class="form-control datepicker" placeholder="M d, Y" name="date_to">
</div>
</div>
<!-- Add Debit Account -->
<div class="col-sm-4">
<label>Debit Account<span class="color-tomato"> * </span></label>
<div class="input-group">
    <select class="custom-select select2" aria-label="Example select with button addon" name="debit_account">
    <option value="{{$data->debit_account}}" selected><small class="text-muted">{{$data->debit_account}}</small></option>
    @foreach($account_type as  $value)
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
    <input type="number" min="1" step=".01" class="form-control" value="{{$data->debit_amount}}" placeholder="Debit Amount" name="d_amount" required>
</div>
</div>


</div>

{{--  ======Next Row=====  --}}
<div class="row">
<div class="col-sm-4">
<div class="form-group">
    <label class="">Description</label>
    <input type="text"  class="form-control" placeholder="Description" name="description" value="{{$data->description}}">
</div>
</div>
<!-- Credit Account -->
<div class="col-sm-4">
<label>Credit Account<span class="color-tomato"> * </span></label>
<div class="input-group">
    <select class="custom-select select2" aria-label="Example select with button addon" name="credit_account">
    <option value="{{$data->credit_account}}" selected><small class="text-muted">{{$data->credit_account}}</small></option>
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

    <input type="text" class="form-control" placeholder="Credit Amount" name="c_amount" value="{{$data->credit_amount}}" required>
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
</div>

@endsection
