@extends('layouts.app', ['title' => $title ?? '']) @section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ml-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('CustomerList')}}">Mandi Purchases</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="card" style="margin-top:-15px">
        <div class="card-body">
            <form action="{{ url('/mandi_purchase_store/') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Customer Name<span style="color:red">*</span></label>
                        <select
                            required
                            class="form-control select2"
                            style="width: 100%;"
                            name="customer_id"
                            id="customer_id"
                        >
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" style="margin-top: 48%;margin-left: 20%; " class="btn btn-info" data-toggle="modal" data-target="#add_customer_model"><i class="fas fa-plus"></i></button>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="item_name">Item Name<span style="color:red">*</span></label>
                        <select
                            required
                            class="form-control select2"
                            style="width: 100%;"
                            name="item_id"
                            id="item_id"
                        >
                            <option value="">Select Item ( چاول , گندم , مکئی )</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" style="margin-top: 48%;margin-left: 20%; " class="btn btn-info" data-toggle="modal" data-target="#add_item_model"><i class="fas fa-plus"></i></button>
                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="weight_of_bag">Weight Of One Bag<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="weight_of_one_bag" id="weight_of_one_bag" placeholder="Weight Of One Bag">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="qty_of_total_bags">No. Of Total Bag's<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="total_bag" id="total_bag" placeholder="No. Of Bag's.">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rate">Rate Of (40 KG)<span style="color:red">*</span> </label>
                        <input type="number" class="form-control for_total_change" name="price" id="price" placeholder="Rate Of (40 KG).">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="katt">KATT / کاٹ (opetional )</label>
                        <input type="number" class="form-control" name="katt" value="0" id="katt" placeholder="No. Of Bag's.">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="total_weight">Total Weight In KG </label>
                        <input type="number" class="form-control" name="total_weight" id="total_weight"  readonly >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="total_amount">Total Amount</label>
                        <input type="number" class="form-control" name="total_amt" id="total_amt" readonly>
                    </div>
                </div>


                <span>Expences</span>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Filling Of Bag<span style="color:red">*</span></label>
                        <input type="number" class="form-control" name="filling_of_bag" id="filling_of_bag" placeholder="Filling Of One Bag">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Loading Of Bag<span style="color:red">*</span></label>
                        <input type="number" class="form-control" name="loading_of_bag" id="loading_of_bag" placeholder="Loading Of One Bag">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="item_name">Stitching<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="stitching_of_bag" id="stitching_of_bag" placeholder="Stitching Of One Bag">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="qty_of_total_bags">Market Fee<span style="color:red">*</span></label>
                        <input type="number" class="form-control" name="market_fee_of_bag" id="market_fee_of_bag" placeholder="One Bag Market Fee">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="weight_of_bag">Bag Price<span style="color:red">*</span></label>
                        <input type="number" class="form-control" name="bag_price" id="bag_price" placeholder="One Bag Price">
                    </div>
                </div>

                <button type="submit" id="submit_mandi_purcahse" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <!-- Customer Modal  -->
    <div class="modal fade" id="add_customer_model" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class=" text-left">Add Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="customer_form" >
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group ">
                                    <label>Customer Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="customer_name_short" id="customer_name_short" placeholder="Customer Phone">

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Customer Phone<span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="customer_phone_short" id="customer_phone_short" placeholder="Customer Phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="customer_address">Customer Address<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_address_short" id="customer_address_short" placeholder="Customer Address">
                            </div>
                        </div>

                        <button type="submit" id="shortcut_customer_add" class="btn btn-primary">Add Customer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </form>
                </div>

            </div>

        </div>
    </div>


    <!-- Item Modal  -->
    <div class="modal fade" id="add_item_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class=" text-left">Add Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="item_form" >
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group ">
                                    <label>Item Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="item_name_short" id="item_name_short" placeholder="Item Name ">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="shortcut_item_add" class="btn btn-primary">Add Item</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </form>
                </div>

            </div>

        </div>
    </div>


@endsection

