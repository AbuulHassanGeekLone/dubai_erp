@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
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
<form class="form-horizontal" action="{{url('/productupdate')}}/{{$product->id}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                  <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
                  <div class="row">
                    <div class="col-6">
                  <div class="form-group">
                    <label>Name<span class="color-tomato"> * </span></label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{old('name', $product->name)}}"  required>
                  </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group">
                    <label>Category<span class="color-tomato"> * </span></label>
                    <select class="form-control select2" style="width: 100%;" name="category" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        @php
                         $category_name = ucfirst($category->name);
                         @endphp
                        <option @if(old('category', $product->category_id) == $category->id ) selected @endif value="{{$category->id}}">{{ $category_name}}</option>

                        @endforeach
                  </select>
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
                  <img src="{{asset($product->picture)}}" alt=" " srcset="">
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
                <a type="button" href="{{ route('product.index') }}" class="btn btn-secondary" style="color:white">Close</a>
                </div>

            </div>
            </form>

</div>
@endsection
