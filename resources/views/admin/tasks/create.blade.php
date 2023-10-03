@extends("layouts.superAdmin")
@section('page_title')
New Task
@endsection
@section('breadcrumb')

<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-md">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.index') }}" class="text-muted">Home Page</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">New Task </a>
    </li>
</ul>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                        <h3 class="card-label font-weight-bolder text-dark">New Task</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Set New Task</span>
                    </div>

                </div>

                <form action="{{ route('tasks.store') }}" method="POST" class="ajaxForm">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bold mb-6">Task Information</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Task Name</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" id="task_name"
                                    placeholder="Task Name" type="text" name="task_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Description</label>
                            <div class="col-lg-9 col-xl-6">
                                <textarea name="task_description" placeholder="Description" class="form-control" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Start Date</label>
                            <div class="col-lg-9 col-xl-6">
                                <input style="text-align: center"
                                    class="form-control form-control-lg form-control-solid" id="start_date" type="date"
                                    name="start_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">End Date</label>
                            <div class="col-lg-9 col-xl-6">
                                <input style="text-align: center"
                                    class="form-control form-control-lg form-control-solid" id="end_date" type="date"
                                    name="end_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Choose Category</label>
                            <div class="col-6">
                                <select class="form-control select2" id="category_id" name="category_id">
                                    <option selected disabled value="">Category</option>
                                    @foreach(App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Choose User</label>
                            <div class="col-6">
                                <select class="form-control select2 userbox" id="user_id" name="user_id">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Choose Project</label>
                            <div class="col-6">
                                <select class="form-control select2" id="project_id" name="project_id">
                                    <option selected disabled value="">Project</option>
                                    @foreach(App\Models\Project::all() as $project)
                                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-toolbar" style="text-align: right">
                            <button type="submit" data-refresh="true" class="btn green btn-primary">Send</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
    $('#summernote').summernote({
        height: 100, // set editor height
        toolbar: [
        [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    });
    
    $(".ajaxForm").ajaxForm({
    success: function(json) {
    $(".ajaxForm :submit").prop("disabled", false);
    if (json.status == 1) {
    $('.ajaxForm').resetForm();
    $('#category_id').val(null).trigger('change');
    $('#user_id').val(null).trigger('change');
    $('#project_id').val(null).trigger('change');
    $('#summernote').summernote('reset');
    ShowMessage(json.msg, "success", "TMS");
    // $('#password').val('');
    // $('#password_confirmation').val('');
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

    $(document).on('change','#category_id',function (){
    var category_id = $(this).val();
    $.ajax({
    url:'/dashboard/tasks/category_users/'+category_id,
    method:'get',
    data:{
    },
    success:function (response){
    if (response.status){
    $(".userbox").fadeIn();
    $('#user_id').html("")
    $.each(response.data,function (index,value){
    $('#user_id').append("<option value='"+value.id+"'>"+value.username+"</option>")
    $("#user_id").prepend("<option value='' selected='selected'></option>")
    });
    }else{
    $(".userbox").fadeOut();
    $('#user_id').html("")
  
    }
    }
    })
    })
    });
   
</script>
@endsection