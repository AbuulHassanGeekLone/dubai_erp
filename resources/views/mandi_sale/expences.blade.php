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
            <form action="{{ route('mandi_purchase.store') }}" method="post" >
                @csrf

                <span>Expences</span>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Filling Of Bag<span style="color:red">*</span></label>
                        <input type="number" class="form-control" id="filling_bag" placeholder="Filling Of One Bag">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Loading Of Bag<span style="color:red">*</span></label>
                        <input type="number" class="form-control" id="loading_bag" placeholder="Loading Of One Bag">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="item_name">Stitching<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="stitching_bag" placeholder="Stitching Of One Bag">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="qty_of_total_bags">Market Fee<span style="color:red">*</span></label>
                        <input type="number" class="form-control" id="market_fee" placeholder="One Bag Market Fee">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="weight_of_bag">Bag Price<span style="color:red">*</span></label>
                        <input type="number" class="form-control" id="bag_price" placeholder="One Bag Price">
                    </div>
                </div>


                <button type="submit" id="submit_purcahse" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <div class="card mt-1">
        <div class="card-body">
            <center><div><h1 id="status">Open Bill</h1></div></center>
            <form action="{{ route('purchase.store') }}" method="post">
                @csrf

                <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="400">Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Sale Price</th>
                        <th>Discount</th>
                        <th>Sub total</th>
                    </tr>
                    </thead>

                    <tbody></tbody>
                </table>
                <input type="hidden" name="t_amount" id="t_amount" >
                <input type="submit" id="savebtn" class="btn btn-primary" value="Save Bill" hidden />
            </form>
        </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Items : </label> <span id="t_items"></span></div>
            <div class="col-3"><label for="">Total : </label><span id="f_total"></span></div>
        </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Quantity : </label> <span id="t_quantity"></span></div>
        </div>
    </div>
    </div>

@endsection

