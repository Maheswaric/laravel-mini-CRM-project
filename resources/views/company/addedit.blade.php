@extends('layouts.app')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">@if($senddata->id == '') Add @else Edit @endif Company</h4>
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
                <form action="{{$route}}" method="{{$method}}" id="company_form" enctype="multipart/form-data">
                @csrf
                    @if($senddata->id)
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                  <div>
                    <div class="card-body">
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" value="@if($senddata->id)@if(isset($senddata->name)){{$senddata->name}}@endif @else{{old('name') ? old('name'):''}}@endif"/>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="control-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-danger" placeholder="Enter Email" value="@if(isset($senddata->email)){{$senddata->email}}@endif"/>                            
                          </div>
                        </div>
                        <!--/span-->
                      </div>

                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" placeholder="Enter Website" value="@if($senddata->id)@if(isset($senddata->website)){{$senddata->website}}@endif @else{{old('website') ? old('website'):''}}@endif"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Logo</label>
                                    <input type="file" id="logo" name="logo" accept="image/*" class="form-control"/>

                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <button type="submit" class="btn btn-success rounded-pill px-4 submit_company_form" >
                          <div class="d-flex align-items-center">
                          @if($senddata->id == '') Save @else Update @endif
                          </div>
                        </button>
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
<script>
 $(document).ready(function () {
        $(document).on('click', '.submit_company_form', function (e) {
            e.preventDefault();
            $("form#company_form").validate({
                rules: {
                    name: { required: true },
                    email: { required: true,email:true},
                    website: { required: true},
                    <?php if($senddata->id==''){ ?>
                    logo:{required:true,
                        },
                    <?php } ?>
                    
                },
                messages: {
                    name:{
                        required:"Please enter Name"
                    },
                    email: { 
                        required: "Please enter Email",
                        email:"Please enter valid Email"
                    },
                    website: { required: "Please enter Website",},
                    logo:{
                        required: "Please Select Logo image"
                    }
                },
                focusInvalid: true,
                invalidHandler: function () {
                    $(this).find(":input.error:first").focus();
                }
            });
            if ($("form#company_form").valid()) {
                $("form#company_form").submit();
            }
        });
    });
    </script>
@endsection