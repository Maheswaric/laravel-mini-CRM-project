@extends('layouts.app')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">View Employee</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="{{route('home')}}" class="fw-normal">Dashboard</a></li>
                </ol>
                <a href="javascript:void(0)"
                    class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Employee</a>
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
                <formid="employee_form" enctype="multipart/form-data">
                
                  <div>
                    <div class="card-body">
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="control-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" readonly class="form-control" placeholder="Enter First Name" value="@if($senddata->id)@if(isset($senddata->first_name)){{$senddata->first_name}}@endif @else{{old('first_name') ? old('first_name'):''}}@endif"/>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="control-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" readonly class="form-control form-control-danger" placeholder="Enter Last Name" value="@if(isset($senddata->last_name)){{$senddata->last_name}}@endif"/>                            
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Company</label>
                                    <input type="text" id="company" name="company" readonly class="form-control form-control-danger" placeholder="Enter Email" value="@if(isset($senddata->company_name)){{$senddata->compnay_name}}@endif"/>  
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Email</label>
                                    <input type="text" id="email" name="email" readonly class="form-control form-control-danger" placeholder="Enter Email" value="@if(isset($senddata->email)){{$senddata->email}}@endif"/>                            
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Phone</label>
                                    <input type="number" id="phone" name="phone" readonly class="form-control form-control-danger" placeholder="Enter Phone" value="@if(isset($senddata->phone)){{$senddata->phone}}@endif"/>                            
                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <a href="{{route('employee.index')}}" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
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