@extends('layouts.app')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">@if($senddata->id == '') Add @else Edit @endif Employee</h4>
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
                <form action="{{$route}}" method="{{$method}}" id="employee_form" enctype="multipart/form-data">
                @csrf
                    @if($senddata->id)
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                  <div>
                    <div class="card-body">
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="control-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" value="@if($senddata->id)@if(isset($senddata->first_name)){{$senddata->first_name}}@endif @else{{old('first_name') ? old('first_name'):''}}@endif"/>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="control-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control form-control-danger" placeholder="Enter Last Name" value="@if(isset($senddata->last_name)){{$senddata->last_name}}@endif"/>                            
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Company</label>
                                    <select class="form-control form-select" data-placeholder="Choose a Company" tabindex="1" name="company_id">
                                        <option value="">Select Company</option>
                                        @if(isset($companies))
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}" @if($senddata->company_id == $company->id) selected @endif>{{$company->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control form-control-danger" placeholder="Enter Email" value="@if(isset($senddata->email)){{$senddata->email}}@endif"/>                            
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Phone</label>
                                    <input type="number" id="phone" name="phone" class="form-control form-control-danger" placeholder="Enter Phone" value="@if(isset($senddata->phone)){{$senddata->phone}}@endif"/>                            
                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <button type="submit" class="btn btn-success rounded-pill px-4 submit_employee_form" >
                          <div class="d-flex align-items-center">
                          @if($senddata->id == '') Save @else Update @endif
                          </div>
                        </button>
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
@section('javascript')
<script>
 $(document).ready(function () {
        $(document).on('click', '.submit_employee_form', function (e) {
            e.preventDefault();
            $("form#employee_form").validate({
                rules: {
                    first_name: { required: true },
                    last_name:{required:true,
                        },
                    company_id:{required:true},
                    email: { required: true,email:true},
                    phone: { required: true},                  
                    
                },
                messages: {
                    first_name:{
                        required:"Please enter First Name"
                    },
                    last_name:{
                        required: "Please enter Last Name"
                    },
                    company_id:{required:"Please select Company"},
                    email: { 
                        required: "Please enter Email",
                        email:"Please enter valid Email"
                    },
                    phone: { required: "Please enter Phone",},
                    
                },
                focusInvalid: true,
                invalidHandler: function () {
                    $(this).find(":input.error:first").focus();
                }
            });
            if ($("form#employee_form").valid()) {
                $("form#employee_form").submit();
            }
        });
    });
    </script>
@endsection