@extends('layouts.app', ['title' => $title ?? '']) @section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">Purchases</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
@if($status == 0)
<div class="card" style="margin-top:-15px">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Vendor Name</label>
                    <select
                        class="form-control select2"
                        style="width: 100%;"
                        name="vendor"
                        id="vendor"
                        disabled
                    >
                        <option value="">Select Vendor</option>

                        @foreach($vendors as $vendor)
                            <option @if($purchases[0]->v_id == $vendor->id) selected @endif value="{{$vendor->id}}">{{$vendor->name}}</option>
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
                     <option value="">Select Product</option>
                        @foreach ($products as $product)
                        @php
                        $product_name = ucfirst( $product->name );
                        @endphp
                        <option @if(in_array($product->id, $disabledProducts)) disabled @endif data-pprice="{{ $product->last_purchase_price }}" data-sprice="{{ $product->last_sale_price }}"
                            value="{{$product->id}}"
                            >{{$product_name}}</option
                        >
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Quantity</label>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="pquantity"
                        placeholder="Enter quantity"
                        name="pquantity"
                        onfocus="this.select();" onmouseup="return false;"
                        value="1"
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
                        onfocus="this.select();" onmouseup="return false;"
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
                        value="0"
                        onfocus="this.select();" onmouseup="return false;"
                    />
                </div>
            </div>
        </div>
         @if($status === 0 || $status === 2)
            <button type="button" class="btn btn-primary mb-2" id="addproduct">
                  Add product
             </button>
            @endif
    </div>
</div>
@endif
<div class="card mt-1">
    <div class="card-body">
        @if($status === 0)
        <center><div><h2 id="status" style="color: red;"><b>UN Paid</b></h2></div></center>
        @elseif($status === 2)
            <span class="text-bold">Vendor : {{$oCustomer->name}}</span><center><div><h2 id="status" style="color: lightskyblue;"><b>Partialy Paid</b></h2></div></center>
        @else
            <span class="text-bold">Vendor : {{$oCustomer->name}}</span> <center><div><h2 id="status" style="color: green;"><b> Paid</b></h2></div></center>
        @endif
        <form action="{{url('/purchaseupdate')}}/{{$id}}" method="post">
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
                        @if($status === 0) <th></th>@endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchases as $index => $purchase)
                    <tr>
                        <td>
                            <input type="hidden" name="po[{{$index}}][v_id]" value="{{$purchase->v_id}}" />
                            <input type="hidden" name="po[{{$index}}][p_id]" value="{{$purchase->p_id}}" />
                            <input type="hidden" name="po[{{$index}}][p_name]" value="{{$purchase->product}}" />
                            {{$purchase->product}}
                        </td>
                        <td >
                            <input style="display: none" type="number" class="pqty_hidden form-control" name="po[{{$index}}][p_quantity]" value="{{$purchase->quantity}}" />
                            <span class="pqty_text"> {{$purchase->quantity}}</span>
                        </td>
                        <td>
                             <input style="display: none" type="number" class="pprice_hidden form-control" name="po[{{$index}}][p_price]" value="{{$purchase->unit_price}}" />
                            <span class="pprice_text"> {{$purchase->unit_price}}</span>
                        </td>
                        <td>
                             <input style="display: none" type="number" class="psale_hidden form-control" name="po[{{$index}}][s_price]" value="{{$purchase->sale_price}}" />
                            <span class="psale_text">  {{$purchase->sale_price}}</span>
                        </td>
                        <td >
                              <input style="display: none" type="number" class="pdiscount_hidden form-control" name="po[{{$index}}][discount]" value="{{$purchase->discount}}" />
                            <span class="pdiscount_text"> {{$purchase->discount}}</span>
                        </td>
                        <td>
                            <span class="psubtotal_text">

                                 @php
                                    $net = $purchase->unit_price * $purchase->discount;
                                    $net = $net/100;
                                    $net = $purchase->unit_price - $net;
                                    $subtotal = $net * $purchase->quantity;
                                    echo $subtotal;
                                    @endphp
                                 </span></td>
                         @if($status == 0)
                        <td style="min-width: 130px;">
                            <button type="button" onclick="editprow(this)"
                                    class="btn btn-info cutm_btn btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button style="display:none" type="button" onclick="updateprow(this)"
                                    class="btn btn-secondary btn-sm">
                                <i class="fa fa-check"></i>
                            </button>
                            <button type="button"
                                    data-prod_id="{{$purchase->p_id}}"
                                    class="btn btn-danger rmv btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="t_amount" id="t_amount" >
            @if($status === 0 || $status === 2)
{{--                {{route('purchaseeditlist',[$id])}}--}}
                 <input type="submit" id="updatebtn" class="btn btn-primary" value="Save Bill" hidden/>
            @endif
        </form>

    </div>
    <div class="row">
      @if($status === 0 || $status === 2)

        <div class="col-3 ml-4" id="hideprintPaybill">
            <button id="paybill" class="btn btn-danger mb-3" onclick="paybill()" data-toggle="modal" data-target="#exampleModal"><b>Pay Bill</b></button>
            <!-- Print Button -->
            <button id="print" onclick="p_printbtn({{$purchase->id}})" class="btn btn-secondary btn-md mb-3" style="margin-left: 5px;">
            <i class="fa fa-print"></i> Print
           </button>

        </div>
      @endif
    </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Items :</label> <span id="t_items"></span></div>
            <div class="col-3 ml-3"><label for="">Total : </label><span id="f_total">{{$paid}}</span></div>
        </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Quantity : </label> <span id="t_quantity"></span></div>
            <div class="col-3 ml-3"><label for="">Paid : </label> <span>{{$paid}}</span></div>
        </div>
    @if($paid)
        <div class="row">
                <div class="col-3 ml-3"><label for=""> </label> <span ></span></div>
                <div class="col-3 ml-3"><label for="">Balance : </label><span id="balance"></span></div>
         </div>
    @endif
    </div>
</div>

<!--==================== Model Area Start From here ========== -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/purchasepayupdate')}}/{{$id}}" id="payment_add" method="post">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date:</label>
            <input type="text"  class="form-control datepicker"  name="pay_date" value="{{ app('request')->input('pay_date', Date('Y-m-d')) }}">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Payment Method:</label>
            <select
                class="form-control select2"
                style="width: 100%;"
                name="method"
                id="method"
                required
            >
                @if($vendorCredit > 0)
                    <option data-dc="{{ $vendorCredit}}" value="27,3,11,-1" selected>{{$oCustomer->name}} ({{$vendorCredit}})</option>
                @endif
                @foreach($acountblns as $method)
                    @php
                        $value = "$method->a_id,3,$method->type";
                        $d_c = $method->debit - $method->credit;

                        if($d_c < 0) $d_c = 0;
                    @endphp

                    <option data-dc="{{ $d_c }}" value="{{ $value }}">{{$method->name}}({{ number_format($d_c, 2, '.', ',') }})</option>
                @endforeach

            </select>
          </div>
            <input type="text"  class="form-control" id="total_amount"  name="total_amount"  hidden>
            <input type="hidden" name="p_paid" id="p_paid" value="{{$paid}}"  onfocus="this.select();" onmouseup="return false;">
            <input type="hidden" name="v_id" id="v_id" value="{{$purchases[0]->v_id}}"  onfocus="this.select();" onmouseup="return false;">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Amount:</label>
                <input type="number"  class="form-control"  name="amount_paid"   onfocus="this.select();" onmouseup="return false;">
            </div>


        <div class="modal-footer">
            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="payment_btn" class="btn btn-primary">Add Payment</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
