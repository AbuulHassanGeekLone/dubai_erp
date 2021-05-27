@extends('layouts.app', ['title' => $title ?? ''])
@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-1">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Accounts Management</li>
  </ol>
</nav>
{{--    Modal Start  from here--}}
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
                <button type="button" id="dlt_vendor" class="btn btn-primary cutm_btn">Yes</button>
            </div>
        </div>
    </div>
</div>

{{--   Next DataTable Start From here--}}
    <div class="card" style="margin-top:-15px">

        <div class="card-body">
            <a class="btn btn-primary mb-3" href="{{route('accountManagement.create')}}">Add New</a>
            <table id="amanager" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Account Name</th>
                    <th>Account Type</th>
                    <th>Account Description</th>
                    <th>Opening Balance</th>
                    <th class="table-actions">Action</th>
                </tr>
                </thead>
                <tbody>
         @foreach ($account as $index => $account)
            <tr  id="tblrow_{{$account->id}}">
                <td>{{$index + 1}}</td>
                <td>{{$account->account_name}}</td>
                <td>{{$account->account_type}}</td>
                 <td>{{$account->description}}</td>
                <td>{{number_format($account->opening_balance,2) }}</td>
                <td class="table-actions">
                    <a class="btn btn-primary btn-sm" style="margin-left:5px" href="{{url('/accountedit/')}}/{{$account->id}}">
                        <i class="fa fa-edit"></i></a>
                    <button type="button" onclick="$('#delete_id').val({{$account->id}})"
                              class="btn btn-danger cutm_btn btn-sm d-none" data-toggle="modal"
                              data-target="#deleteModal">
                          <i class="fa fa-trash"></i>
                      </button>
                </td>

            </tr>
             @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection
