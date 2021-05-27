@extends('layouts.app', ['title' => "Settings" ?? ''])

@section('content')
<div class="">
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb ml-2">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>

    <li class="breadcrumb-item active" aria-current="page">Settings</li>
  </ol>
</nav>
</div>
    <div class="card-body" style="margin-top: -37px;">
        <form class="form-horizontal" action="{{route('setting.store')}}" method="post">
            {{csrf_field()}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Settings</h3>
                    <!-- <h1 class="text-light float-right" style="margin-top: -17px;" data-toggle="collapse" href="#backdrop" role="button" aria-expanded="false" aria-controls="backdrop">+</strong></h1> -->
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="color-tomato">All fields are required .</div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  class="form-control"  placeholder="Company Name" name="company_name" value="{{$data[0]->title}}" required>
                            </div>
                        </div>
                        <!-- Add Debit Account -->
                        <div class="col-sm-4">
                           <label>Address</label>
                            <div class="input-group">
                           <input type="text"  class="form-control"  placeholder="Company Address" name="company_address" value="{{$data[1]->title}}" required>
                             </div>

                     </div>
                    <!-- Debit Amount -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=""> Email</label>

                                <input type="email" class="form-control" value="{{$data[2]->title}}" placeholder="Company Email" name="company_email" required>
                            </div>
                        </div>


                    </div>

                  {{--  ======Next Row=====  --}}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=""> Phone</label>
                                <input type="text"  class="form-control" placeholder="Company Phone" name="company_phone" value="{{$data[3]->title}}" required>
                            </div>
                        </div>
                        <!-- Credit Account -->
                     <div class="col-sm-4">
                           <label> TRN</label>
                            <div class="input-group">
                           <input type="text"  class="form-control"  placeholder="company Trn" name="company_trn" value="{{$data[4]->title}}" required>
                             </div>

                     </div>

                     <div class="col-sm-4">
                           <label> Vat</label>
                            <div class="input-group">
                           <input type="text"  class="form-control"  placeholder="company Vat" name="company_vat" value="{{$data[5]->title}}" required>
                             </div>

                     </div>


                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="b1" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="save and go to list">Save</button>

                </div>

            </div>
        </form>
            {{--=============  DropDown Model For New Add Account  ===========--}}

@endsection
