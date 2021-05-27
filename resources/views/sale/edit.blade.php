@extends('layouts.app', ['title' => $title ?? ''])
 @section('content')
 <nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('sale.index')}}">Sales</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>

@if($status == 0)
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
                        disabled
                    >
                        @foreach($customers as $customer)
                        <option
                            @if($sales[0]->c_id == $customer->id) selected @endif
                            value="{{$customer->id}}"
                            >{{ $customer->name }}</option
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
                    >
                     <option value="">Select Product</option>
                        @foreach ($products as $product)
                        @php
                        $product_name = ucfirst($product->name);
                        @endphp
                        <option @if(in_array($product->id, $disabledProducts)) disabled @endif  data-price="{{ $product->price }}" data-qty="{{ $product->tquantity }}" data-sold="{{ $product->squantity }}"
                            value="{{$product->id}}"
                            >{{$product_name}}</option
                        >
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Quantity :</label><span class="mt-2 ml-2" id="qa" style="color:red;"></span>
                    <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="quantity"
                        placeholder="Enter quantity"
                        name="quantity"
                        value="1"
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

        <button type="button" class="btn btn-primary mb-2" id="addsproduct">
            Add product
        </button>
    </div>
</div>
@endif

<div class="card mt-1">
    <div class="card-body">
        @if($status === 0)
        <center><h2 id="status" style="color: red;"><b>UN Paid</b></h2></center>
        @elseif($status === 2)
            <span class="text-bold">Customer : {{$oCustomer->name}}</span> <center><h2 id="status" style="color: lightskyblue;"><b>Partialy Paid</b></h2></center>
        @else
            <span class="text-bold">Customer : {{$oCustomer->name}}</span> <center><h2 id="status" style="color: green;"><b> Paid</b></h2></center>
        @endif

        <form action="{{url('/saleupdate')}}/{{$id}}" method="post">
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

                        @if($status == 0)
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($sales as $index => $sale)
                    <tr>
                        <td>
                            <input type="hidden" name="po[{{$index}}][customer_id]" value="{{$sale->c_id}}" />
                            <input type="hidden" name="po[{{$index}}][product_id]" value="{{$sale->p_id}}" />
                            <input type="hidden" name="po[{{$index}}][product_name]" value="{{$sale->product}}" />
                            {{$sale->product}}
                        </td>
                        <td  id="saleqtyEdit">
                            <input style="display: none" type="number" class="qty_hidden form-control" name="po[{{$index}}][quantity]" value="{{$sale->quantity}}" />
                            <span class="qty_text"> {{$sale->quantity}}</span>
                        </td>
                        <td>
                             <input type="hidden" name="po[{{$index}}][unit_price]" value="{{$sale->unit_price}}" />
                              <span class="price_text"> {{$sale->unit_price}}</span>
                        </td>
                        <td>
                              <input style="display: none" type="number" class="discount_hidden form-control " name="po[{{$index}}][discount]" value="{{$sale->discount}}" />

                              <span class="discount_text"> {{$sale->discount}}</span>
                        </td>
                        <td>
                             <span class="netprice_text">
                                  @php
                                    $net = $sale->unit_price * $sale->discount;
                                    $net = $net/100;
                                    $net = $sale->unit_price - $net;
                                    echo $net;
                                    @endphp
                             </span>

                        </td>
                        <td><span class="subtotal_text">{{$net * $sale->quantity}}</span></td>

                        @if($status == 0)
                        <td style="min-width: 130px;">
                            <button type="button" onclick="editrow(this)"
                                    class="btn btn-info cutm_btn btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button style="display:none" type="button" onclick="updatesrow(this,{{$sale->remaining}},{{$sale->quantity}})"
                                    class="btn btn-secondary btn-sm">
                                <i class="fa fa-check"></i>
                            </button>
                            <button type="button"
                                    data-prod_id="{{$sale->p_id}}"
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

            @if($status == 0)
            <input type="submit" id="updatebtn" class="btn btn-primary" value="Save Bill" hidden/>
            @endif
        </form>
    </div>
    <div class="row ml-3">
        <div class="col-3" id="hideprintPaybill">
            <!-- Not 1 means not fully paid, so unpaid or partial paid -->
            @if($status != 1)
            <button class="btn btn-danger mb-3" id="paybill" onclick="paybill()" data-toggle="modal" data-target="#exampleModalsale">
                <b>Pay Bill</b>
            </button>
            @endif

            <button id="print" class="btn btn-secondary mb-3" style="margin-left: 5px;" onclick="printbtn({{$sale->id}});">
            <i class="fa fa-print"></i> Print
           </button>
        </div>
    </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Items : </label> <span id="t_items"></span></div>
            <div class="col-3 ml-3"><label for="">Total : </label><span id="f_total"></span></div>
        </div>
        <div class="row">
            <div class="col-3 ml-3"><label for="">Total Quantity : </label> <span id="t_quantity"></span></div>
            <div class="col-3 ml-3"><label for="">Paid : </label> <span id="">{{$paid}}</span></div>
        </div>
        <div class="row">
            <div class="col-3 ml-3"><label for=""> </label> <span id="t_items"></span></div>
            <div class="col-3 ml-3"><label for="">Balance : </label><span id="balance"></span></div>
        </div>
    </div>
</div>
<!-- MOdel Section Start From Here Agiledata2020  -->
<div class="modal fade" id="exampleModalsale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/salepayupdate')}}/{{$id}}" id="sale_payment" method="post">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date:</label>
             <input type="text"  class="form-control datepicker" name="pay_date" value="{{ app('request')->input('pay_date', Date('Y-m-d')) }}">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Payment Method:</label>
            <select
                class="form-control select2"
                style="width: 100%;"
                name="method"
                id="method"
                required
            >
                @if($customerCredit > 0)
                <option data-dc="{{ $customerCredit}}" value="27,3,11,-1" selected>{{$oCustomer->name}} ({{$customerCredit}})</option>
                @endif

                @foreach($paymethod as $method)
                <option value="{{$method->id}},3,{{$method->account_type}}">{{$method->account_name}}</option>
                @endforeach

            </select>
          </div>

          <input type="text"  class="form-control" id="total_samount"  name="total_amount"  hidden>
          <input type="hidden" name="p_paid" id="p_paid" value="{{$paid}}">
              <input type="hidden" name="c_id" id="c_iiid" value="{{$sales[0]->c_id}}">

          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Amount:</label>
              <input type="text"  class="form-control"  name="amount_paid"   onfocus="this.select();" onmouseup="return false;">
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  type="button" id="sale_add" class="btn btn-primary">Add Payment</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
