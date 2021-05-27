@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-1">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">Category</li>
  </ol>
</nav>
<div class="f" id="fm" hidden></div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete category</h5>
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
                    <button type="button" id="dltcategory" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
<div class="card" style="margin-top:-15px">
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

    <form class="form-horizontal" action="{{ route('category.store') }}" id="catform" method="post" >
        <!-- @method('PATCH') -->
        @csrf

        <!-- <input type="text" class="form-control" id="input_patch" name="tttt" value="{{ route('category.update', [1]) }}"> -->

        <div class="row">
            <div class="col-5">
            <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" id="getcategory" placeholder="Enter Name" name="name"  required>
                  </div>
                  <input type="number" class="form-control" placeholder="Enter Name" name="cid"  hidden>
            </div>
            </div>

            <button type="submit" id="catadd" class="btn btn-primary">Add Category</button>
            <button type="submit" id="catCancel" onclick="cenclecategory()" class="btn btn-secondary">Cancel</button>
            <button type="submit" id="catupdate" class="btn btn-primary" hidden>Update Category</button>

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
                    <th>Name</th>
                    <th class="table-actions">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($categories as $category)
                      <tr  id="tblrow_{{$category->id}}">
                      <td>{{$category->id}}</td>
                      <td>{{$category->name}}</td>
                      <td class="table-actions">
                      <button class="btn btn-primary btn-sm" type="button" onclick="editcategory({{$category->id}},'{{$category->name}}')"
                              class="btn btn-danger cutm_btn" ><i class="fa fa-edit"
                          ></i></button>
                           <button type="button" onclick="$('#delete_id').val({{$category->id}})"
                              class="btn btn-danger cutm_btn btn-sm" data-toggle="modal"
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
