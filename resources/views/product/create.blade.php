@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>
<div class="card-body" style="margin-top:-41px">
    @if (count($errors) > 0)
        <div class = "card card-body alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form class="form-horizontal" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add product</h3>
        </div>
            <div class="card-body">
                <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name<span class="color-tomato"> * </span></label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
                        </div>
                    </div>
                    <div class="col-6">
                      <label>Category<span class="color-tomato"> * </span></label>
                    <div class="input-group">
                    <select class="custom-select select2" id="catselect" aria-label="Example select with button addon" name="category" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                      @php
                      $category_name = ucfirst($category->name )
                        @endphp
                  	  <option @if(old('category') == $category->id) selected @endif value="{{$category->id}}">{{$category_name}}</option>
                    	@endforeach
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                    </div>
                  </div>
                  </div>
                  </div>
                <div class="row">
                  <div class="col-6">
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" id="validationCustom01" id="avatar" placeholder="Enter Image"  name="avatar" >
                     </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <!-- <img id="blah" src="#" alt="your image" /> -->
                    </div>
                  </div>
                </div>

                  <div class="form-group">

                    <input type="number" class="form-control" id="num" placeholder="Enter Email" name="num"  hidden>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" id="b1" class="btn btn-primary">Save</button>
                <button type="submit" id="b2" class="btn btn-primary">Save & New</button>
                <a type="button" href="{{ route('product.index') }}" class="btn btn-secondary" style="color:white">Close</a>
                </div>
            </div>
    </form>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Add Category:</label>
            <input type="text" id="catval" class="form-control" id="recipient-name" required>
              <span id="categoryError" class="helping-text color-tomato" style="display:none">Region already exist!</span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="Addcategory" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
<div>
@endsection
