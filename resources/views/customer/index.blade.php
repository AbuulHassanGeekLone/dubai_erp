@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<div class="">
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Customer</li>
  </ol>
</nav>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Customer</h5>
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
                    <button type="button" id="dlt_customer" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
<div class="card" style="margin-top:-15px">

<div class="card-body">
    <a class="btn btn-primary mb-3" href="{{route('customer.create')}}">Create Customer</a>
  <table id="myTable" class="customer table table-bordered table-striped">
                  <thead >
                  <tr>
                    <th>ID</th>
                    <th class="table-name">Name</th>

                    <th>Mobile</th>
                    <th>Email</th>
                    <th>TRN</th>
                    <th>Address</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Opening balance</th>
                    <th class="table-actions">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($customers as $customer)
                      @php
                     $customer_name=ucfirst($customer->name);
                     $customer_city=ucfirst($customer->city);
                     $customer_region=ucfirst($customer->region);
                     @endphp
                      <tr  id="tblrow_{{$customer->id}}">
                      <td>{{$customer->id}}</td>
                      <td class="table-name">{{$customer_name}}</td>

                      <td>{{$customer->mobile}}</td>
                      <td>{{$customer->email}}</td>
                      <td>{{$customer->rtn}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{  $customer_region}}</td>
                      <td>{{ $customer_city}}</td>
                      <td>{{$customer->opening_balance}}</td>
                      <td class="table-actions"><a class="btn btn-primary btn-sm" style=" width:50; margin-left:5px" href="{{url('/customeredit/')}}/{{$customer->id}}"><i class="fa fa-edit"
                          ></i></a> <button type="button" onclick="$('#delete_id').val({{$customer->id}})"
                              class="btn btn-danger cutm_btn btn-sm d-none" data-toggle="modal"
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
