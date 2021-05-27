@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-1">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products</li>
  </ol>
</nav>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete product</h5>
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
                    <button type="button" id="dlt_product" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
<div class="card" style="margin-top:-15px">
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{route('product.create')}}">Create Product</a>
  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th width="200">Name</th>
                    <th>Category</th>
                    <th>Picture</th>
                    <th class="table-actions">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $index => $product)
                      @php
                        $product_name = ucfirst($product->name);
                        $category_name = ucfirst($product->category);
                        @endphp
                      <tr  id="tblrow_{{$product->id}}">
                      <td>{{$index+1}}</td>
                      <td>{{$product_name}}</td>
                      <td>{{  $category_name }}</td>
                      <td><img src="{{asset($product->picture)}}" alt="No Image" srcset=""></td>
                      <td class="table-actions"><a class="btn btn-primary btn-sm" style="margin-left:5px" href="{{url('/productedit/')}}/{{$product->id}}"><i class="fa fa-edit"
                          ></i></a> <button type="button" onclick="$('#delete_id').val({{$product->id}})"
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
