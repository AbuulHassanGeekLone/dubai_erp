@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">DashBoard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Region</li>
  </ol>
</nav>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Region</h5>
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
                    <button type="button" id="dltregion" class="btn btn-primary cutm_btn">Yes</button>
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
        <form class="form-horizontal" id="regform" action="{{route('region.store')}}" method="post" >
              {{csrf_field()}}
        <div class="row">
            <div class="col-5">
            <div class="form-group">
                    <label>Region Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name"  required>
                  </div>
            </div>
            </div>
            <button type="submit" id="regadd" class="btn btn-primary">Add region</button>
            <button type="submit" id="regupdate" class="btn btn-primary" hidden>Update region</button>

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
                    <th >Name</th>
                    <th class="table-actions">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($regions as $region)
                      <tr  id="tblrow_{{$region->id}}">
                      <td>{{$region->id}}</td>
                      <td>{{$region->name}}</td>
                      <td class="table-actions">
                      <button class="btn btn-primary btn-sm" type="button" onclick="editRegion({{$region->id}}, '{{$region->name}}')"
                              class="btn btn-danger cutm_btn" ><i class="fa fa-edit"
                          ></i></button>
                           <button type="button " onclick="$('#delete_id').val({{$region->id}})"
                              class="btn btn-danger cutm_btn btn-sm" data-toggle="modal"
                              data-target="#deleteModal">
                          <i class="fa fa-trash"></i>
                      </button></td>

                      </tr>
                      @endforeach
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
</div>

@endsection
