@extends("layouts.superAdmin")
@section('page_title')
{{ $category->name }} -
@endsection
@section('breadcrumb')

<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-md">
    <li class="breadcrumb-item">
        <a href="{{ route('categories') }}" class="text-muted">Categories</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted"> Users </a>
    </li>
</ul>
@endsection

@section('content')
<div class="card-body pt-4">
    <!--begin::Item-->
    <div class="card-header border-0" style="padding-top: 15px !important">
        <h3 class="card-title fw-bolder text-dark">Users of this Category</h3>
    </div>
    @foreach ($category->users as $category_user)
    <div class="d-flex align-items-center">
        {{ $loop->iteration }} |
        <div class="symbol symbol-80px me-5" style="padding-left:1px">
            <img src="{{ asset('user-image.png') }}" class="img-fluid" alt="">
        </div>
        <div class="flex-grow-1">
            <a class="text-dark fw-bolder text-hover-primary fs-6"><span style="font-weight: bolder">UserName :</span> {{
                $category_user->username }}</a><br>
            <a class="text-dark fw-bolder text-hover-primary fs-6"><span style="font-weight: bolder">E-Mail
                    :</span> {{ $category_user->email }}</a><br>
        </div>
    </div><br>
    @endforeach

</div>

<div class="card-body pt-4">
    <!--begin::Item-->
    <div class="card-header border-0" style="padding-top: 15px !important">
        <h3 class="card-title fw-bolder text-dark">Category Tasks</h3>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-bordered" id="tblAjax">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th width="2%">Task</th>
                            <th width="2%">Start Date</th>
                            <th width="2%">End Date</th>
                            <th width="2%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->tasks as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->task_name }}</td>
                            <td>{{ $item->start_date}}</td>
                            <td>{{ $item->end_date }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .card-header {
        padding: 0 !important
    }

    .symbol>img {
        max-width: 100px !important;
    }

    td {
        text-align: center;
    }
</style>
@endsection