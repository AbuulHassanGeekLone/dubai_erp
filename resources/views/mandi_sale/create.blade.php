@extends('layouts.app', ['title' => $title ?? '']) @section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ml-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('SaleList')}}">Mandi Sale</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="card" style="margin-top:-15px">
        <div class="card-body">
            <form action="{{ url('/MandiSaleStore/') }}" method="post">
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
                        <label for="weight_of_bag">Bilty No#<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="bilty_no" id="bilty_no" placeholder="Bilty NO">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="weight_of_bag">Vehical No#<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="vehical_no" id="vehical_no" placeholder="Vehical No">
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
                        <label for="mandi_weight">Mandi weight<span style="color:red">*</span> </label>
                        <input type="number" class="form-control for_total_change" name="mandi_weight" id="mandi_weight" placeholder="Mandi weight">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mill_weight">Mill Weight</label>
                        <input type="number" class="form-control" name="mill_weight" value="0" id="mill_weight" placeholder="Mill Weight">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="katt">KATT / کاٹ (opetional )</label>
                        <input type="number" class="form-control" name="katt" value="0" id="katt" placeholder="No. Of Bag's.">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bhakar_weight">Bhakar weight<span style="color:red">*</span> </label>
                        <input type="number" class="form-control for_total_change" name="bhakar_weight" id="bhakar_weight" placeholder="Bhakar weight">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bhakar_amt">Bhakar Amount<span style="color:red">*</span> </label>
                        <input type="number" class="form-control for_total_change" name="bhakar_amt" id="bhakar_amt" placeholder="Bhakar Amount">
                    </div>


                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rate">Rate Of (40 KG)<span style="color:red">*</span> </label>
                        <input type="number" class="form-control for_total_change" name="price" id="price" placeholder="Rate Of (40 KG) Given to Mill By Mandi">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="total_amount">Total Amount</label>
                        <input type="number" class="form-control" name="total_amt" id="total_amt" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vehical_rent">Vehical Rent<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="vehical_rent" id="vehical_rent" placeholder="Vehical Rent">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="remaning_amt">Remanig Amount<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="remaning_amt" id="remaning_amt" placeholder="Remanig Amount(amt - v rent)">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Bill No">Bill No#<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="bill_no" id="bill_no" placeholder="Bill No">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="loading_area">Loading Area<span style="color:red">*</span></label>
                        <input type="number" class="form-control for_total_change" name="loading_area" id="loading_area" placeholder="Loading Area">
                    </div>

                </div>
                <button type="submit" id="submit_mandi_sale" class="btn btn-primary">Save</button>
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

