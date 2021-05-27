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
            <form action="{{ url('/customer_store/') }}" method="post" >
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Customer Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Customer Phone<span style="color:red">*</span></label>
                        <input type="number" class="form-control" name="customer_phone"  id="customer_phone" placeholder="Customer Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer_address">Customer Address<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="customer_address" id="customer_address" placeholder="Customer Address">
                </div>

                <button type="submit" id="save_customer" class="btn btn-primary">Add Customer</button>
            </form>
        </div>
    </div>


    <div class="card mt-1" >
        <div class="card-body">
            <center><div><h1 id="status">Customer List</h1></div></center>

                <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th width="400">Name</th>
                        <th>Phone</th>
                        <th>Address</th>
{{--                        <th>Action</th>--}}
                    </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $index => $customer)
                            <tr>
                                <td class="text-left">{{$customer->id}}</td>
                                <td class="text-left">{{$customer->name}}</td>
                                <td class="text-left">{{$customer->phone}}</td>
                                <td class="text-left">{{$customer->address}}</td>
{{--                                <td class="table-actionsPS">--}}
{{--                                        <a--}}
{{--                                            class="btn btn-primary btn-sm"--}}
{{--                                            style="margin-left: 5px;"--}}
{{--                                            href="{{ url('/purchaseedit/') }}/{{$customer->id}}"--}}
{{--                                        ><i class="fa fa-edit"></i--}}
{{--                                            ></a>--}}
{{--                                        <button--}}
{{--                                            class="btn btn-secondary btn-sm"--}}
{{--                                            style="margin-left: 5px;"--}}
{{--                                            onclick="p_printbtn({{$customer->id}});"--}}

{{--                                        ><i class="fa fa-print"></i--}}
{{--                                            ></button>--}}
{{--                                        <button--}}
{{--                                            type="button"--}}
{{--                                            onclick="$('#delete_id').val({{$customer->id}})"--}}
{{--                                            class="btn btn-danger cutm_btn btn-sm d-none"--}}
{{--                                            data-toggle="modal"--}}
{{--                                            data-target="#deleteModal"--}}
{{--                                        >--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </button>--}}

{{--                                        <a--}}
{{--                                            class="btn btn-primary btn-sm"--}}
{{--                                            style="margin-left: 5px;"--}}
{{--                                            href="{{ url('/purchaseedit/') }}/{{$customer->id}}"--}}
{{--                                        ><i class="fa fa-eye"></i--}}
{{--                                            ></a>--}}
{{--                                        <button--}}
{{--                                            class="btn btn-secondary btn-sm"--}}
{{--                                            style="margin-left: 5px;"--}}
{{--                                            onclick="p_printbtn({{$customer->id}});"--}}

{{--                                        ><i class="fa fa-print"></i--}}
{{--                                            ></button>--}}
{{--                                    --}}
{{--                                </td>--}}
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="t_amount" id="t_amount" >
                <input type="submit" id="savebtn" class="btn btn-primary" value="Save Bill" hidden />
        </div>

    </div>


@endsection

