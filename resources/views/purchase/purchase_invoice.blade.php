<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .f14 {
            font-size: 14px;
        }

        th, td {
            padding: 0 3px 0 5px;
        }
    </style>
</head>

<body>

<!-- for Heading Or Logo -->
<div class="container p-0" style="width: 210mm;">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-4 text-center">{{$setting->company_name}}</h1>
            <h3 class="text-center pb-">Purchase Invoice</h3>
        </div>
    </div>
    <div class="row" style="margin-top: -60px;">
        <div class="col-sm-12">
            <div class="text-right">Print Date <br>{{date('d-F-y')}}</div>
        </div>
    </div>
</div>

<div class="container border border-dark p-0" style="width: 210mm; height:297mm; position: relative">
    <!-- For Table Company info and customer Detail -->
    <div class="row p-2">
        <div class="col-sm-4">
            From: <br>
            {{$setting->company_name}} <br>
            {{$setting->company_address}}<br>
            {{$setting->company_email}}<br>
            {{$setting->company_phone}}<br>
            TRN :{{$setting->trn}}<br>
        </div>

        <div class="col-sm-4">
            To: <br>
            {{$details->vendor}} <br>
            {{$details->city}}, {{$details->country}}<br>
            {{$details->address}}<br>
            TRN :{{$details->trn}}<br>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-6">
                    <div>Invoice No.</div>
                    <div style="border-bottom: 2px solid;" class=""><b>{{$details->orderno}}</b></div>
                </div>
                <div class="col-6">
                    <div>Invoice Dated.</div>
                    <div style="border-bottom: 2px solid;" class=""><b>{{date('d-F-y', strtotime($details->date))}}</b></div>
                </div>
            </div>
            <div class="row">
                <div class="col mt-2">
                    <div>Mode / Term of Payment.</div>
                    <div><b>{{$details->method}}</b></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================== Next Row ============================= -->
    <!-- For Order info  -->
    <div class="row no-gutters mt-2">
        <div class="col-sm-12">
            <table rules="all" style="width:100%;border-top: 1px; border-bottom: 1px">
                <thead>
                <tr>
                    <th class="text-center">Sr<br>No</th>
                    <th class="text-left">Description Of Goods</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Amount</th>
                    <th class="text-right">Vat%</th>
                </tr>
                </thead>
                @php
                    $quantity = 0;
                    $total = 0;
                    $t_unit_price= 0;
                    $total_of_sub_total=0;
                @endphp

                @php
                    $actual_count = $purchasedetails->count();
                    $count = $actual_count;
                    if($count < 10 )
                    $count=15;
                @endphp
                @for ($i=0; $i < $count; $i++)
                    @if($i <=$actual_count - 1)
                        @php $details=$purchasedetails[$i];
             $net=$details->unit_price * $details->discount;
            $net = $net/100;
            $net = $details->unit_price - $net;
            $subtotal = $net * $details->quantity;

            $quantity = $quantity + $details->quantity;
            $t_unit_price= $t_unit_price +$details->unit_price;
            $total = $total + $subtotal;
            $total_of_sub_total = $total_of_sub_total + $total;
                        @endphp

                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$details->product}}</td>
                            <td class="text-right">{{$details->quantity}}</td>
                            <td class="text-right">{{number_format($details->unit_price,2)}}</td>
                            <td class="text-right">
                                {{ number_format($subtotal ,2) }}
                            </td>
                            <td class="text-right">{{$setting->vat}}%</td>
                        </tr>
                    @else
                        <tr class="blank-rows" style="border-style:hidden;">
                            <td style="border-style:none"><span style="opacity: 0">...</span></td>
                            <td><span style="opacity: 0">...</span></td>
                            <td><span style="opacity: 0">...</span></td>
                            <td><span style="opacity: 0">...</span></td>
                            <td><span style="opacity: 0">...</span></td>
                            <td><span style="opacity: 0">...</span></td>
                        </tr>
                    @endif

                @endfor
                <tr style="outline: thin solid">
                    <td class="text-center"></td>
                    <td class="text-right"><b>Total</b></td>
                    <td class="text-right"><b>{{$quantity}}</b></td>
                    <td class="text-right"></td>
                    <td class="text-right"><b>{{number_format( $t_unit_price,2)}}</b></td>
                    <td class="text-center"></td>
                </tr>

            </table>
        </div>
    </div>
    <!-- ================== 3rd Next Row ============================= -->
    <!-- For Table Company info -->
    <div class="row no-gutters" style="line-height:19px;margin: 9px;">
        <div class="col-sm-12">
            <table rules="all" style="width:100%">
                <tr style="border-style:hidden">
                    <td>
                        <div>Amount Changeable (in Words)</div>
                        @php
                            $number_f = ($t_unit_price);
                        @endphp
                        <div style="width: 274px;" class="f14"><b>{{ $number_f }} </b></div>
                    </td>
                    <td style="border-style:hidden">
                        <div class="text-right invisible">E & O.E</div>
                        <div class="text-right" style="text-decoration: underline;"> VAT {{$setting->vat}}%</div>
                        <div class="text-right" style="text-decoration: underline;"> {{number_format( $t_unit_price,2)}}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row no-gutters w-100" style="position: absolute; bottom: 0">
        <div class="col-sm-6">
            <div class="m-1">
                <div style="text-decoration: underline;"><b class="f14">Declaration</b></div>
                <div class="f14">1 Goods may be returned/exchanged in original condition
                    within 30 days from the dale of supply</div>
                <div class="f14">2 Signature of the customer on the delivery note is
                    evidence that the goods are received in good condition</div>
                <div class="f14">3 Payments by crossed cheque payable for Flair Global
                    FZE' and the cheques are sub A realization</div>
            </div>
        </div>
        <div class="col-sm-6 text-right">
            <div style="border-top: 1px solid; border-left: 1px solid; position: absolute; bottom: 0; width: 100%; height: 100px;">
                <b class="f14">For {{$setting->company_name}}<br><br><br>Authorized</b>
            </div>
        </div>
    </div>
</div>

<!-- End Wali Row for footer -->
<div class="row">
    <div class="col-sm-12">
        <div class="text-justify text-center mt-1">This is a Computer Generated Invoice</div>
        <div class="text-justify text-center"><b>{{$setting->company_name}}, {{$setting->company_address}}, {{$setting->company_email}}, {{$setting->company_phone}}</b></div>
    </div>
</div>

</body>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
</body>

</html>
