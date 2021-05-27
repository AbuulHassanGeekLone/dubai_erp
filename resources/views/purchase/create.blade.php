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
        <form>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Vendor Name</label>
                    <select
                        required
                        class="form-control select2"
                        style="width: 100%;"
                        name="vendor"
                        id="vendor"
                    >
                    <option value="">Select Vendor</option>
                        @foreach($vendors as $vendor)

                        @php
                        $vendor_name = ucfirst($vendor->name )
                        @endphp
                        <option value="{{$vendor->id}}">{{ $vendor_name }}
                            </option
                        >
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Product Name</label>
                    <select
                        class="form-control select2"
                        style="width: 100%;"
                        name="product"
                        id="product"

                         onchange="getpsPrice(this)"
                    >
                    <option value="" data-qty="0" data-pprice="0.00" data-sprice="0.00">Select Product</option>
                        @foreach ($products as $product)
                        @php
                        $product_name = ucfirst($product->name )
                        @endphp
                        <option data-pprice="{{ $product->last_purchase_price }}" data-sprice="{{ $product->last_sale_price }}"
                            data-qty="{{ $product->remaining }}"
                            value="{{$product->id}}"
                            >{{$product_name}}</option
                        >
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Quantity:</label><span class="mt-2 ml-2" id="qa" style="color:green;"></span>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="pquantity"
                        placeholder="Enter quantity"
                        name="quantity"
                        value="1"
                        onfocus="this.select();" onmouseup="return false;"
                        required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Unit Price</label>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="u_price"
                        placeholder="Enter uprice"
                        name="u_price"
                        onfocus="this.select();" onmouseup="return false;"
                        required

                    />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Sale Price</label>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="s_price"
                        placeholder="Enter Sale price"
                        name="s_price"
                        onfocus="this.select();" onmouseup="return false;"
                        required/>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Discount in %</label>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="discount"
                        placeholder="Enter Discount"
                        name="discount"
                        onfocus="this.select();" onmouseup="return false;"
                    >
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary mb-2" id="addproduct">
            Add product
        </button>
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
