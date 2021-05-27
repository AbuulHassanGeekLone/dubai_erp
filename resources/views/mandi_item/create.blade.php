@extends('layouts.app', ['title' => $title ?? '']) @section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ml-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">Purchases</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="card" style="margin-top:-15px">
        <div class="card-body">
            <form action="{{ route('store_item') }}" method="post" >
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Item Name<span style="color:red">*</span></label>

                        <input type="text" class="form-control" onblur="duplicateItemName(this)" name="item_name" id="item_name" placeholder="Item Name">
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" id="save_item" style="margin-top: 7%;"  class="btn btn-primary">Add item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card mt-1" >
        <div class="card-body">
            <center><div><h1 id="status">Item List</h1></div></center>

            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th width="800">Name</th>
                    <th width="800">Created At</th>
                    <th width="800">Action</th>

                </tr>
                </thead>

                <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td class="text-left">{{$item->id}}</td>
                        <td class="text-left">{{$item->name}}</td>
                        <td class="text-left">{{$item->created_at}}</td>

                        <td class="table-actions"><a class="btn btn-primary btn-sm" style="margin-left:5px" onclick="editItem({{$item->id}})">
                                <i class="fa fa-edit"></i>
                            </a> <button type="button" onclick="$('#delete_id').val({{$item->id}})"
                                         class="btn btn-danger cutm_btn btn-sm d-none" data-toggle="modal"
                                         data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <input type="hidden" name="t_amount" id="t_amount" >
            <input type="submit" id="savebtn" class="btn btn-primary" value="Save Bill" hidden />
        </div>

    </div>



@endsection

