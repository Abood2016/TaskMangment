@extends("layouts.superAdmin")
@section('page_title')
My Account
@endsection
@section('breadcrumb')

<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-md">
    <li class="breadcrumb-item">
        <a href="/" class="text-muted">Home Page</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted"> My Account </a>
    </li>
</ul>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Header-->
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark"> Personal Information |
                            {{ $profile->name }}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Edit Information</span>
                    </div>

                </div>

                <form action="{{ route('update.profile') }}" method="POST" class="ajaxForm">
                    {{-- @csrf --}}
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bold mb-6">Personal Information</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Name</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" id="username"
                                    placeholder="Name" type="text" name="username" value="{{ $profile->username }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">E-Mail</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="la la-at"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="email" id="email"
                                        class="form-control form-control-lg form-control-solid"
                                        value="{{ $profile->email }}" placeholder="E-Mail">
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $profile->id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Phone</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" id="phone" placeholder="الهاتف" type="text"
                                    name="phone" value="{{ $profile->phone }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Password</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Password Confirmation</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="Password Confirmation">
                                </div>
                            </div>
                        </div>


                        <div class="card-toolbar" style="text-align: right">
                            <button type="submit" data-refresh="true" class="btn green btn-primary">Save</button> <button
                                type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                    <!--end::Body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
   $(document).ready(function() {
    $(".ajaxForm").ajaxForm({
    success: function(json) {
    $(".ajaxForm :submit").prop("disabled", false);
    if (json.status == 1) {
    // $('.ajaxForm').resetForm();
    ShowMessage(json.msg, "success", "TMS");
    $('#password').val('');
    $('#password_confirmation').val('');
    if (json.redirect != null)
    setTimeout(function() {
    window.location = json.redirect
    }, 800);
    
    if ($(".ajaxForm :submit").data("refresh") == true) {
    // $('.ajaxForm').resetForm();
    }
    } else {
    ShowMessage(json.msg, "error", "TMS");
    }
    if (json.redirect != null)
    setTimeout(function() {
    window.location = json.redirect
    }, 800);
    
    },
    beforeSubmit: function() {
    $(".ajaxForm :submit").prop("disabled", true);
    },
    error: function(json) {
    $(".ajaxForm :submit").prop("disabled", false);
    errorsHtml = "<ul>";
        $.each(json.responseJSON, function(key, value) {
        console.log(value);
        errorsHtml += '<li>' + value[0] + '</li>';
        });
        errorsHtml += "</ul>";
    ShowMessage(errorsHtml, "error", "TMS");
    }
    });
    
    });
    // $(function () {
    //     $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    //     });
    //     var SITEURL = '{{URL::to('')}}';
    //         $(document).on('click','#EditsaveBtn',function() {
    //            let user_form = document.getElementById('profile_form');
    //            let form_data = new FormData(user_form);
    //            $.ajax({
    //             url:'/dashboard/update_profile',
    //             method:'post',
    //             data:form_data,
    //             dataType:'json',
    //            success:function (response){
    //             if (response.status == 504){
    //             Swal.fire({
    //             icon: 'error',
    //             title: 'خطأ',
    //             text: response.error,
    //             confirmButtonText:"حسناً"
    //             })
    //             }
    //             else if (response.status == 200) {
    //             Swal.fire({
    //             icon: 'success',
    //             title: 'تم',
    //             text: response.success,
    //             timer: 2000,
    //             showCancelButton: false,
    //             showConfirmButton: false
    //             })
    //             $('#password').val('');
    //             $('#password_confirmation').val('');
    //             }
    //              },
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             })
    //           })
    // });
</script>
@endsection