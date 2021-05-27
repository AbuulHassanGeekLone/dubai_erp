@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
    <nav aria-label="breadcrumb" style="margin-left:10px">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor.index')}}">Vendor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="card-body" style="margin-top:-33px">
        @if (count($errors) > 0)
            <div class="card card-body alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" action="{{url('/vendorupdate')}}/{{$vendor->id}}" method="post">
            {{csrf_field()}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Vendor</h3>
                </div>

                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <div class="row">
                        <div class="col" style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are
                            required
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Name<span class="color-tomato"> * </span></label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                       value="{{old('name', $vendor->name)}}" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>TRN<span class="color-tomato"> * </span></label>
                                <input type="" class="form-control" placeholder="Enter TRN" name="rtn"
                                       value="{{old('rtn', $vendor->rtn)}}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>mobile <span class="color-tomato"> * </span></label>
                                <input type="phone" class="form-control" placeholder="Enter mobile" name="mobile"
                                       value="{{old('rtn', $vendor->mobile)}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Region<span class="color-tomato"> * </span></label>
                                <select
                                    class="form-control select2"
                                    style="width: 100%;"
                                    name="region_id"
                                    id="vendor_reg"
                                    required

                                >
                                    <option value="">Select Region</option>
                                    @foreach ($regions as $region)
                                        @php
                                            $region_name=ucfirst($region->name);

                                        @endphp
                                        <option @if(old('region_id', $vendor->region_id) == $region->id) selected
                                                @endif value="{{$region->id}}"> {{$region_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>City<span class="color-tomato"> * </span></label>
                                <select
                                    class="form-control select2"
                                    style="width: 100%;"
                                    name="city_id"
                                    id="city_select"
                                    required
                                >
                                    <option value="">Select City</option>
                                    @if(old('region_id'))
                                        @foreach($regionCities[old('region_id')] as $city)
                                            @php
                                                $city_name = ucfirst($city->name)
                                            @endphp
                                            <option @if(old('city_id') == $city->id) selected
                                                    @endif value="{{$city->id}}">{{$city_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($regionCities[$vendor->region_id] as $city)
                                            @php
                                                $city_name = ucfirst($city->name)
                                            @endphp
                                            <option @if($vendor->city_id == $city->id) selected
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
                                       value="{{old('opening_balance', $vendor->opening_balance)}}"
                                       name="opening_balance">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                       value="{{$vendor->email}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Enter Address" name="address"
                                       value="{{old('address', $vendor->address)}}"></input>
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
                    <button type="submit" id="b12" class="btn btn-primary">Save</button>
                    <a type="button" href="{{ route('vendor.index') }}" class="btn btn-secondary" style="color:white">Close</a>
                </div>

            </div>
        </form>

    </div>
@endsection
