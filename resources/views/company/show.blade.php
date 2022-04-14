@extends('layouts.app')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">View Company</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="{{route('home')}}" class="fw-normal">Dashboard</a></li>
                </ol>
                <a href="javascript:void(0)"
                    class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Company</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
<div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header bg-info">
                </div>
                <form  id="company_form" enctype="multipart/form-data">
                  <div>
                    <div class="card-body">
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" readonly value="@if($senddata->id)@if(isset($senddata->name)){{$senddata->name}}@endif @else{{old('name') ? old('name'):''}}@endif"/>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="control-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-danger" readonly placeholder="Enter Email" value="@if($senddata->id)@if(isset($senddata->email)){{$senddata->email}}@endif @else{{old('email') ? old('email'):''}}@endif"/>                            
                          </div>
                        </div>
                        <!--/span-->
                      </div>

                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" readonly placeholder="Enter Website" value="@if($senddata->id)@if(isset($senddata->website)){{$senddata->website}}@endif @else{{old('website') ? old('website'):''}}@endif"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Logo</label>
                                    <br>
                                        <img src="{{asset('/storage/app/public/company/'.$senddata->id.'/'.$senddata->logo)}}" />

                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <a href="{{route('company.index')}}" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                          Cancel
                        </a>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
@endsection