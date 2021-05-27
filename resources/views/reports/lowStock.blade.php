@extends('layouts.app', ['title' => $title ?? '']) @section('content')

    <div class="pt-2" id="collapseExample">
        <div class="card card-body">

            <form class="form-inline" action="{{url('/lowStock')}}" method="get">
                @csrf
                <div class="ml-2">
                <select
                    class="form-control select2"
                    name="product_id"
                    id=""
                >
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option
                            @if(app('request')->input('product_id') == $product->id) selected @endif
                        value="{{$product->id}}"
                        >{{ $product->name }}</option
                        >
                    @endforeach
                </select>
                </div>
                <div class="ml-4">
                <select
                    class="form-control select2"
                    name="category_id"
                    id="vendor"
                >
                    <option value="">Select Vendor</option>
                    @foreach($categories as $category)
                        <option
                            @if(app('request')->input('category_id') == $category->id) selected @endif
                        value="{{$category->id}}"
                        >{{ $category->name }}</option
                        >
                    @endforeach
                </select>
                </div>
                <button type="submit"  name="search" value="search" class="btn btn-primary ml-sm-4">Search Data</button>


        </form>
    </div>

    <!-- DataTable Start from here -->
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th class="text-right">Remaining Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $lowstock as $index => $ls  )
                    <tr id="#">
                        <td>{{$index + 1}}</td>
                        <td>{{$ls->product}}</td>
                        <td>{{$ls->category}}</td>
                        <td class="text-right">{{$ls->remaining}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
