@extends('layouts.app', ['title' => $title ?? '']) @section('content')
<!-- Filter Button for Toogle 7/7/2020-->
<div class="row">
<div class="col-sm-4 mt-3">
<a class="btn btn-primary" data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="filter">Filter</a>
</div>
</div>

<!-- Toggleable filter form start from here 7/7/2020 -->
<div class="row mt-3 collapse" id="filter">
<!-- === form first Field ====  -->
<div class="col-sm-3">
<form class="form-inline">
 <div class="form-group">
    <input type="password" class="form-control" id="product" placeholder="Product Name">
  </div>
</form>
</div>
<!-- === form Second Field ====  -->
<div class="col-sm-3">
<form class="form-inline">
 <div class="form-group">

    <input type="password" class="form-control" id="vendor" placeholder="Vendor Name">
  </div>
</form>
</div>
<!-- === form  third Field ====  -->
<div class="col-sm-3">
<form class="form-inline">
 <div class="form-group">
    <input type="password" class="form-control" id="purchase" placeholder="Catagory">
  </div>
</form>
</div>
<!-- === Filter Button ====  -->
<div class="col-sm-1">
<button class="btn btn-primary btn-block">Filter</button>
</div>

</div>
<!-- DataTable Start from here -->
<div class="card mt-3">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Catagory</th>
                    <th>Vendor Name</th>
                    <th>Total Purchases</th>
                    <th>Quantity Sold</th>
                    <th>Quantity Available</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Net Price</th>
                 </tr>
            </thead>
            <tbody>

                <tr id="#">
                    <td>1</td>
                    <td>Small Friedge</td>
                    <td>Dawlance</td>
                    <td>er</td>
                    <!-- <td>29000</td> -->
                    <td>100</td>
                    <td>30</td>
                    <td>70</td>
                    <td>100</td>
                    <td>30</td>
                    <td>70</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection
