@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('accountManagement.index')}}">Accounts Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Account Type</li>
  </ol>
</nav>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
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
                    <button type="button" id="dltaccountType" class="btn btn-primary cutm_btn">Yes</button>
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

            <div style="font-size: 14px;">Fields with <span class="color-tomato"> * </span> are required</div>
            <form class="form-horizontal" id="accountform" action="{{ route('accountType.store') }}" method="post" >
            <!-- @method('PATCH') -->
            @csrf

            <!-- <input type="text" class="form-control" id="input_patch" name="tttt" value="{{ route('accountType.update', [1]) }}"> -->

                <div class="row">
                    {{-- ===   Account Type        === --}}
                    <div class="col-3">
                        <div class="form-group">
                            <label for="account_type">Title</label>
                             <input type="text" class="form-control" id="getAccounname" placeholder="Enter Name" name="name"  required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" style="margin-top: 31px;">
                            <select
                                class="form-control select2"
                                style="width: 100%;"
                                name="transection_type_id"
                                id="transection_type_id"

                            >
                                <option value="">Select Type</option>
                                @foreach($tTypes as $index=> $ttype )
                                    <option value="{{$ttype->id}}">{{$ttype->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              {{--  Add & Update  Button  --}}
                <button type="submit" id="accountadd" class="btn btn-primary">Add Account</button>
                <button type="submit" id="accountupdate" class="btn btn-primary" hidden>Update Account</button>
            </form>
        </div>
    </div>

    </div>
    <div class="card mt-2">
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th >Account Name</th>
                    <th >Account Type</th>
                    <th class="table-actions">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($accountTypes as $index => $accountType)
                      <tr  id="tblrow_{{$accountType->id}}">
                      <td>{{$index + 1}}</td>
                      <td>{{$accountType->name}}</td>
                      <td>{{$accountType->type}}</td>
                      <td class="table-actions">
                      <button class="btn btn-primary btn-sm" type="button" onclick="editaccountType({{ $accountType->id }},'{{ $accountType->tid }}','{{ $accountType->name }}')"
                              class="btn btn-danger cutm_btn" ><i class="fa fa-edit"
                          ></i></button>
                           <button type="button" onclick="$('#delete_id').val({{$accountType->id}})"
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
