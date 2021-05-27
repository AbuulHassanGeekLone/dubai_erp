@extends('layouts.app', ['title' => $title ?? ''])

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Admin</h5>
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
                    <button type="button" id="dlt_admin" class="btn btn-primary cutm_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- BreadCrumb -->
    <div><nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="margin-top:-15px">
        <div class="card-body">

            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th class="table-actions">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($admins as $index => $admin)
                    <tr id="tblrow_{{$admin->id}}">
                        <td>{{ $index + 1 }}</td>
                        @php
                        $admin_name=ucfirst($admin->name)
                        @endphp
                        <td >{{$admin_name }}</td>
                        <td>{{$admin->email}}</td>
                        <td>
                        @if($admin->status == 1)
                                <h5> <span class="badge badge-success ">Active</span></h5>
                            @else
                                <h5> <span class="badge badge-primary ">Disabled</span></h5>
                        @endif
                        </td>
                        <td class="table-actions"><a class="btn btn-primary btn-sm" style="margin-left:5px" href="{{route('adminlist.edit', [$admin->id] )}}">
                                <i class="fa fa-edit"></i>
                            </a> <button type="button" onclick="$('#delete_id').val({{$admin->id}})"
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
