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
        <form class="form-horizontal" id="customer_add" action="{{route('customer.store')}}" method="post">
            {{csrf_field()}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Customer</h3>
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
                                       value="{{old('name')}}" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>TRN</label>
                                <input type="text" class="form-control" id="rtn" placeholder="Enter TRN" name="rtn"
                                       value="{{old('rtn')}}">
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Mobile <small>Note: use ( , ) for multiple
                                        mobile numbers </small></label>
                                <input type="text" class="form-control" id="mobile" placeholder="Enter mobile"
                                       name="mobile" value="{{old('mobile')}}">
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
                                                $region_name=ucfirst($region->name)
                                            @endphp
                                            <option @if(old('region') == $region->id) selected
                                                    @endif value="{{$region->id}}">{{$region_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                                type="button">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">City<span class="color-tomato"> * </span></label>
                                <div class="input-group">
                                    <select class="form-control select2" name="city_id" id="city_select" required>
                                        <option value="">Select City</option>

                                        @if(old('region'))
                                            @foreach($regionCities[old('region')] as $city)
                                                @php
                                                    $city_name = ucfirst($city->name)
                                                @endphp
                                                <option @if(old('city_id') == $city->id) selected
                                                        @endif value="{{$city->id}}">{{$city_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModalcity" type="button">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Opening Balance</label>
                                <input type="number" class="form-control" min="0" placeholder="Enter Balance"
                                       name="opening_balance" value="{{old('opening_balance',0)}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Enter Address" name="address"
                                       value="{{old('address')}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                       value="{{old('email')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="num" name="num"
                               hidden required>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="b1" class="btn btn-primary">Save</button>
                    <button type="submit" id="b2" class="btn btn-primary">Save & New</button>
                    <a type="button" href="{{ route('customer.index') }}" class="btn btn-secondary" style="color:white">Close</a>
                </div>
            </div>
        </form>
    </div>
    <!-- Model for Region -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Add Region:</label>
                            <input type="text" id="regval" class="form-control" required>
                            <span id="region_error" class="helping-text color-tomato" style="display:none">Region already exist!</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="Addregion" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Model for city -->
    <div class="modal fade" id="exampleModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Add City:</label>
                            <input type="text" id="addcity" class="form-control" required>
                            <span id="city_error" class="helping-text color-tomato" style="display:none">City already exist!</span>
                            <span id="city_error1" class="helping-text color-tomato" style="display:none">Select region first!</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="Addcity" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
