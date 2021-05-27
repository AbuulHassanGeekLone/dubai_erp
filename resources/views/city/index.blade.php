@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">City</li>
  </ol>
</nav>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete City</h5>
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
                    <button type="button" id="dltcity" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: -15px">
        <div class="card-body">
            @if (count($errors) > 0)
                <div class = "card card-body alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal" id="cityform" action="{{route('city_store')}}" method="post" >
                {{csrf_field()}}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>City Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name"  required>
                        </div>
                    </div>
                        <div class="col-3">
                            <div class="form-group" style="margin-top: 31px;">
                            <select
                                class="form-control select2"
                                style="width: 100%;"
                                name="region_id"
                                id="region_id"

                            >
                                <option value="">Select Region</option>
                                @foreach ($region as $regions)
                                   @php
                                   $region_name = ucfirst($regions->name);

                                   @endphp
                                    <option value="{{$regions->id}}">{{$region_name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>



                </div>
                <button type="submit" id="cityadd" class="btn btn-primary">Add city</button>
                <button type="submit" id="cityupdate" class="btn btn-primary" hidden>Update city</button>

            </form>
        </div>
    </div>

    </div>
    <div class="card mt-2">
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>City Name</th>
                    <th>Region Name</th>

                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($joindata as $cities)
                    <tr  id="tblrow_{{$cities->city_id}}">
                        <td>{{$cities->city_id}}</td>
                        <td>{{$cities->city_name}}</td>
                        <td>{{$cities->region_name}}</td>
                        <td>
                            <button class="btn btn-primary" type="button" onclick="editCity({{$cities->city_id}},'{{$cities->city_name}}' ,'{{$cities->region_id}}')"
                                    class="btn btn-danger cutm_btn" ><i class="fa fa-edit"
                                ></i></button>
                            <button type="button" onclick="$('#delete_id').val({{$cities->city_id}})"
                                    class="btn btn-danger cutm_btn" data-toggle="modal"
                                    data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button></td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection


