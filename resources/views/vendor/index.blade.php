@extends('layouts.app', ['title' => $title ?? ''])

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Vendor</h5>
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
                    <button type="button" id="dlt_vendor" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
<!-- BreadCrumb -->
<div><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Vendor</li>
  </ol>
</nav>
</div>
<div class="card" style="margin-top:-15px">
<div class="card-body">
    <a class="btn btn-primary mb-3" href="{{route('vendor.create')}}">Create Vendor</a>
    <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th class="table-name">Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>TRN</th>
                    <th>Address</th>
                      <th>Region</th>
                      <th>City</th>
                      <th class="table-actions">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($vendors as $vendor)
                          @php
                            $vendor_name=ucfirst($vendor->name);
                            $vendor_region=ucfirst($vendor->region);
                            $vendor_city=ucfirst($vendor->city);

                            @endphp
                      <tr  id="tblrow_{{$vendor->id}}">
                      <td>{{$vendor->id}}</td>
                      <td class="table-name">{{ $vendor_name}}</td>
                      <td>{{$vendor->mobile}}</td>
                      <td>{{$vendor->email}}</td>
                      <td>{{$vendor->rtn}}</td>
                      <td>{{$vendor->address}}</td>
                      <td>{{$vendor_region}}</td>
                      <td>{{$vendor_city}}</td>
                      <td class="table-actions"><a class="btn btn-primary btn-sm" style="margin-left:5px" href="{{url('/vendoredit/')}}/{{$vendor->id}}"><i class="fa fa-edit"
                          ></i></a> <button type="button" onclick="$('#delete_id').val({{$vendor->id}})"
                              class="btn btn-danger cutm_btn btn-sm d-none" data-toggle="modal"
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
