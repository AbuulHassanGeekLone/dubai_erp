@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
    <div class="">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb ml-2">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="card-body" style="margin-top:-41px">
        @if (count($errors) > 0)
            <div class="card card-body alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" id="customer_add" action="{{url('/customerupdate')}}/{{$customer->id}}"
              method="post">
            {{csrf_field()}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Customer</h3>
                </div>

                <!-- /.card-header -->

                <!-- form start -->

                <div class="card-body">
                    <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Name<span class="color-tomato"> * </span></label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                                       value="{{old('name', $customer->name)}}" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>TRN</label>
                                <input type="text" class="form-control" id="rtn" placeholder="Enter TRN" name="rtn"
                                       value="{{old('rtn', $customer->rtn)}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>mobile<span class="color-tomato"> * </span></label>
                                <input type="phone" class="form-control" id="mobile" placeholder="Enter mobile"
                                       name="mobile" value="{{old('mobile', $customer->mobile)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Region<span class="color-tomato"> * </span></label>
                                <div class="input-group">
                                    <select name="region" id="vendor_reg" class="custom-select select2"
                                            aria-label="Example select with button addon" required>

                                        <option value="">Select Region</option>
                                        @foreach($regions as $region)
                                            @php
                                                $region_name = ucfirst($region->name)
                                            @endphp
                                            <option @if(old('region', $customer->region_id) == $region->id) selected
                                                    @endif value="{{$region->id}}">{{ $region_name}}</option>

                                        @endforeach
                                    </select>
                                    {{-- <div class="input-group-append">--}}
                                    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>--}}
                                    {{-- </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>City<span class="color-tomato"> * </span></label>

                                <select name="city_id" id="city_select" class="form-control select2"
                                        style="width: 100%;" required>

                                    <option value="">Select City</option>
                                    @if(old('region'))
                                        @foreach($regionCities[old('region')] as $city)
                                            @php
                                                $city_name = ucfirst($city->name)
                                            @endphp
                                            <option @if(old('city_id') == $city->id) selected
                                                    @endif value="{{$city->id}}">{{$city_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($regionCities[$customer->region_id] as $city)
                                            @php
                                                $city_name = ucfirst($city->name)
                                            @endphp
                                            <option @if($customer->city_id == $city->id) selected
                                                    @endif value="{{$city->id}}">{{$city_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Opening Balance</label>
                                <input type="number" class="form-control" min="0" placeholder="Enter Balance"
                                       value="{{old('opening_balance', $customer->opening_balance)}}"
                                       name="opening_balance">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Address</label>
                                <input rows="3" type="text" class="form-control" placeholder="Enter Address"
                                       name="address" value="{{old('address',$customer->address)}}"></input>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                       value="{{old('email', $customer->email)}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="num" placeholder="Enter Email" name="num"
                               hidden>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="b1" class="btn btn-primary">Save</button>
                    <a type="button" href="{{ route('customer.index') }}" class="btn btn-secondary" style="color:white">Close</a>

                </div>

            </div>
        </form>

    </div>


@endsection
