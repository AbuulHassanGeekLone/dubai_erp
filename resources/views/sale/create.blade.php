@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('sale.index')}}">Sales</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>
<div class="card" style="margin-top:-15px">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Customer Name</label>
                    <select
                        class="form-control select2"
                        style="width: 100%;"
                        name="customer"
                        id="customer"
                        required
                    >
                    <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        @php
                        $customer_name = ucfirst($customer->name);
                        @endphp
                        <option
                            value="{{$customer->id}}"
                            >{{ $customer_name}}</option
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
                        onchange="getPrice(this)"
                        required>
                    <option value="">Select Product</option>
                        @foreach ($products as $product)
                        @php
                        $productr_name = ucfirst($product->name);
                        @endphp
                        <option data-price="{{ $product->price }}" data-qty="{{ $product->tquantity }}" data-sold="{{ $product->squantity }}"
                            value="{{ $product->id }}"
                            >{{ $productr_name }}</option
                        >
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Quantity :</label><span class="mt-2 ml-2" id="qa" style="color:#ff0000;"></span>
                    <input
                        type="number"
                        min="0"
                        max=""
                        class="form-control"
                        id="quantity"
                        placeholder="Enter quantity"
                        name="quantity"
                        onfocus="this.select();" onmouseup="return false;"
                    />
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
                        value="{{old('u_price')}}"
                        onfocus="this.select();" onmouseup="return false;"
                    />
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
                        value="{{ old('discount', 0) }}"
                        onfocus="this.select();" onmouseup="return false;"
                    />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary mb-2" id="addsproduct">Add product</button>
            </div>
        </div>
    </div>
</div>

<div class="card mt-1">
    <div class="card-body">
       <center><div><h1 id="status">Open Bill</h1></div></center>
        <form action="{{ route('sale.store')}}" method="post">
            @csrf

            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="400">Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Net Price</th>
                        <th>Sub total</th>

                    </tr>
                </thead>

                <tbody></tbody>
            </table>
            <input type="hidden" name="t_amount" id="t_amount" >
            <input type="submit" id="savesale" class="btn btn-primary" value="Save Bill"  hidden />
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
