@extends('layouts.app', ['title' => $title ?? ''])

@section('content')
    <style>
        .dashboard.card-group .card a {
            margin-bottom: 10px;
        }
    </style>
    <!--==== DASHBOARD ===-->
    <div class="card-group dashboard">
        <!-- ============ vender  ====-->

        <div class="card" style="background-color: #f4f6f9; margin-top: 36px;  box-shadow: none">
            <div class="card-header" style="border-bottom:none"><h4 class="text-center" id="d_header"><b>Vendor</b></h4>
            </div>
            <span class="text-center">
                <i class="fas fa-5x fa-user-friends" id="vendors" style="color:orange"></i>
            </span>
            <div class="card-body text-center" id="vender2" hidden>
                <p class="card-text text-justify text-center" style="list-style:none">
                    <!-- Add vender  -->
                    <a href="{{ route('vendor.create') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">Add Vendor</b></a>

                    <!-- List vender  -->
                    <a href="{{ route('vendor.index') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">List Vendor</b></a>
                </p>
            </div>
        </div>
        <!--=====purchases==========-->
        <div class="card" style="background-color: #f4f6f9; margin-top: 36px;  box-shadow: none">
            <div class="card-header" style="border-bottom:none"><h4 class="text-center" id="d_header"><b>Purchase</b>
                </h4></div>
            <span class="text-justify text-center">
             <i class="fas fa-5x fa-file-invoice-dollar" id="purchase" style="color:orange"></i>
           </span>
            <div class="card-body text-center" id="purchase2" hidden>
                <p class="card-text text-justify text-center" style="list-style:none">
                    <!-- Add Purchase   -->
                    <a href="{{ route('purchase.create') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">Add Purchase</b></a>
                    <!-- List Purchases  -->
                    <a href="{{ route('purchase.index') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">List Purchases</b>
                    </a>
                </p>
            </div>
        </div>
        <!--==== Product =====-->
        <div class="card" style="background-color: #f4f6f9; margin-top: 36px;  box-shadow: none">
            <div class="card-header" style="border-bottom:none"><h4 class="text-center" id="d_header"><b>Product</b>
                </h4></div>
            <span class="text-center">
                 <i class="fas fa-5x fa-boxes" id="product" style="color:orange"></i>
            </span>
            <div class="card-body text-center" id="product2" hidden>
                <p class="card-text text-justify text-center" style="list-style:none">
                    <!-- Add Product  -->
                    <a href="{{ route('product.create') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">Add Product</b>
                    </a>

                    <!-- List Products -->
                    <a href="{{ route('product.index') }}" style="color:black;" class="d-block">
                        <b class="text-justify text-center mousetag">List Products</b>
                    </a>

                </p>
            </div>
        </div>
        <!--=== Sale =====-->
        <div class="card" style="background-color: #f4f6f9; margin-top: 36px;  box-shadow: none">
            <div class="card-header" style="border-bottom:none"><h4 class="text-center" id="d_header"><b>Sale</b></h4>
            </div>
            <span class="text-center">
                <i class="fas fa-5x fa-file-invoice-dollar" id="sale" style="color:#55e555"></i>
            </span>
            <div class="card-body text-center" id="sale2" hidden>
                <p class="card-text text-justify text-center" style="list-style:none">
                    <!-- Add Sale -->
                    <a href="{{ route('sale.create') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">Add Sale</b>
                    </a>
                    <!-- List Sales -->
                    <a href="{{ route('sale.index') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">List Sales</b></a>
                </p>
            </div>
        </div>
        <!--=== Customer ====-->
        <div class="card" style="background-color: #f4f6f9; margin-top: 36px;  box-shadow: none">
            <div class="card-header" style="border-bottom:none">
                <h4 class="text-center" id="d_header"><b>Customer</b></h4>
            </div>
            <span class="text-center">
                <i class="fas fa-5x fa-user-friends" id="customer" style="color:#55e555"></i>
            </span>
            <div class="card-body text-center" id="customer2" hidden>
                <p class="card-text text-justify text-center" style="list-style:none">
                    <!-- Add Customer -->
                    <a href="{{ route('customer.create') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">Add Customer</b>
                    </a>
                    <!-- List Customer  -->
                    <a href="{{ route('customer.index') }}" style="color:black" class="d-block">
                        <b class="text-justify text-center mousetag">List Customer</b>
                    </a>
                    <!-- List Region -->
                    <a href="{{ route('region.index') }}" style="color:black" class="d-none">
                        <b class="text-justify text-center mousetag">List Region</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
