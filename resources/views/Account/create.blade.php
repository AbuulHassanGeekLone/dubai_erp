@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-1">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('accountManagement.index')}}">Accounts Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>
<div class="card-body" style="margin-top: -41px">
  @if (count($errors) > 0)
  <div class="card card-body alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form class="form-horizontal" id="accmanagement" action="{{route('accountManagement.store')}}" method="post">
    {{csrf_field()}}
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Account</h3>
      </div>

      <!-- /.card-header -->
      <!-- form start -->
      <div class="card-body">
        <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
        <div class="row">
          {{-- Account Type --}}
          <div class="col-6">
            <label>Type<span class="color-tomato"> * </span></label>
            <div class="input-group">
              <select class="custom-select select2 sel-req"
                      id="accountTypeselect"
                      name="account_type"
                      required>
                <option value=""> Select Account Type</option>
                @foreach($accounttypes as $accounttype)
                <option @if(old('account_type') == $accounttype->id) selected @endif value="{{$accounttype->id}}">{{$accounttype->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          {{--===== Account Name        ====--}}
{{--          <div class="col-6">--}}
{{--            <div class="form-group">--}}
{{--              <label for="opening_balanec">Opening Balance</label>--}}
{{--              <input type="number" class="form-control" id="opening_balanec" name="opening_balanece" placeholder="Opening Balance" value="{{old('opening_balanece')}}" disabled>--}}
{{--            </div>--}}
{{--          </div>--}}
            <div class="col-6">
                <div class="form-group">
                    <label for="account_name">Account Name<span class="color-tomato"> * </span></label>
                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{old('account_name')}}" required>
                </div>
            </div>
        </div>
        {{-- Next Row Start From Here   --}}
        <div class="row">
          {{-- Account Description --}}

          {{-- Account Status--}}
          <div class="col-6">
              <div class="form-group">
                  <label for="account_description">Account Description</label>
                  <input type="text" class="form-control" id="account_description" name="account_description" value="{{old('account_description')}}" placeholder="Description">
              </div>
          </div>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="num" placeholder="Enter Email" name="num"  hidden>
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" id="b1" class="btn btn-primary" data-toggle="tooltip" data-placement="top">Save
        </button>
        <button type="submit" id="b2" class="btn btn-primary" data-toggle="tooltip" data-placement="top">Save & New
        </button>
        <a type="button" href="{{route('accountManagement.index')}}" class="btn btn-secondary" style="color:white">Close</a>
      </div>
    </div>
  </form>
</div>

<!-- Quick add model account type -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Add Account:</label>
            <input type="text" id="accountType" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="AddAccountType" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
<div>
  @endsection
