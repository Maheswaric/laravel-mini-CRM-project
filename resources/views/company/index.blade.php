@extends('layouts.app')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Company</h4>
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
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Company</h3>
                <div class="btn-block pull-right mb-10">
                <a href="{{route('company.create')}}" class="btn btn-danger pull-right text-white">Add Company </a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Logo</th>
                                <th class="border-top-0">Website</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key=>$val)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->email}}</td>
                                <td><img src="{{asset('/storage/app/public/company/'.$val->id.'/'.$val->logo)}}" width="50" height="50"/></td>
                                <td>{{$val->website}}</td>
                                <td>
                                    <a href="{{ route('company.edit', [$val->id])}}" target="blank"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a>
                                    <a href="{{ route('company.show',[$val->id] )}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity text-success"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                    <a href="javascript:void(0)" class="delete_company" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>
                                                
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center">No Records Found</td</tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {!! $data->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
$(document).on('click', '.delete_company', function (e) {
        var id = $(this).data("id");
        if(confirm('Are You Sure do you want to Delete')){
            $.ajax({
                type: 'POST',
                data: {
                    id: id,
                    '_token': '{{ csrf_token() }}'
                },
                url: "{{ route('company-delete') }}",
                success: function (data)
                {
                    if(data.success==true)
                    {
                        toastr.success(data.data.msg);
                        location.reload();                        
                    }else{
                        toastr.error(data.data.msg);
                    }
                },
                error: function (data)
                {
                    console.log(data);
                    toastr.error(data.data.msg);
                }
            });
        }
    });
</script>
@endsection