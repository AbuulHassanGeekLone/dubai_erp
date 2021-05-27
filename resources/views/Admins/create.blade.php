
@extends('layouts.app', ['title' => $title ?? ''])

@section('content')

    <div class="">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb ml-2">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">DashBoard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
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
            <form class="form" method="POST" action="{{ route('adminlist.store') }}">
            {{csrf_field()}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="color-tomato">All fields  are required</div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" >
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select
                                   class="form-control select select2 @error('role') is-invalid @enderror" name="role" required>

                                    <option value="">Select Role</option>
                                    <option @if(old('role') === "0") selected @endif value="0">Operator</option>
                                    <option @if(old('role') === "1") selected @endif value="1">Admin</option>

                                    </select>
                                </div>
                        </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select
                                        class="form-control select select2 @error('status') is-invalid @enderror" name="status" required>

                                        <option value="">Select Status</option>
                                        <option @if(old('status') === "1") selected @endif value="1">Active</option>
                                        <option @if(old('status') === "0") selected @endif value="0">Disabled</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </div>
            </form>

        </div>


    @endsection
