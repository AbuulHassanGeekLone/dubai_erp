@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb ml-2">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('accountManagement.index')}}">Accounts Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
<div class="card-body" style="margin-top: -41px">
    <form class="form-horizontal" action="{{url('/accountupdate')}}/{{$account->id}}" method="post">
        {{csrf_field()}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Account</h3>
            </div>

            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="card card-body alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                <div class="row">
                    {{-- Account Type --}}
                    <div class="col-6">
                        <label>Type<span class="color-tomato"> * </span></label>
                        <div class="input-group">
                            <select class="custom-select select2" id="accountTypeselect" name="account_type">
                                <option value=""> Select Account Type</option>
                                @foreach( $account_types as $account_type)
                                <option @if(old('account_type', $account->account_type) == $account_type->id) selected @endif value="{{$account_type->id}}">{{$account_type->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    {{--===== Account Name        ====--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="opening_balanec">Opening Balance</label>--}}
{{--                            <input type="number" class="form-control disabled" id="opening_balanec" name="opening_balanece" placeholder="Opening Balance" value="{{old('opening_balanece', $account->opening_balance)}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="account_name">Account Name<span class="color-tomato"> * </span></label>
                            <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{ old('account_name', $account->account_name) }}">
                        </div>

                    </div>
                </div>
                {{-- Next Row Start From Here   --}}
                <div class="row">
                    {{-- Account Description --}}

                    {{-- Opening Balance--}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="account_description">Account Description</label>
                            <input type="text" class="form-control" id="account_description" name="account_description" value="{{old('account_description', $account->description)}}" placeholder="Description">
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <input type="number" class="form-control" id="num" placeholder="Enter Email" name="num"  hidden>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a type="button" href="{{ route('accountManagement.index') }}" class="btn btn-secondary" style="color:white">Close</a>
            </div>

        </div>
    </form>
</div>
@endsection
