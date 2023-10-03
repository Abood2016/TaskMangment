@extends("layouts.superAdmin")
@section('page_title')
My Contacts
@endsection
@section('breadcrumb')

<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-md">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.index') }}" class="text-muted">Home Page</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted"> My Contacts </a>
    </li>
</ul>
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header">

                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">My Contacts</h3>
                </div>
            </div>

            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered" id="tblAjax">
                                    <thead>
                                    <tr>
                                            <th width="1%">#</th>
                                            <th width="3%">Contact Title</th>
                                            <th width="3%">Category</th>
                                            <th width="3%">Status</th>
                                            <th width="3%">Created Date</th>
                                            <th width="3%">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
</div>

@endsection
@section("css")

@include('include.dataTable_css')

@endsection()

@section('js')

@include('include.dataTable_scripts')
<script>
    var oTable;
  $(function() {
    BindDataTable();
  });

    //هذه تختلف حسب الصفحة
    function BindDataTable() {
        oTable = $('#tblAjax').DataTable({
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
           "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            serverSide: true,
            "bDestroy": true,
            "bSort": true,
            visible: true,
            "iDisplayLength": 10,
            "sPaginationType": "full_numbers",
            "bAutoWidth":false,
            "bStateSave": true,
            columnDefs: [ {
            // targets: 0,
            visible: true
            } ],
            // Pagination settings
            // dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			// <'row'<'col-sm-12'tr>>
			// <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            
            columnDefs: [{
                targets: 0,
                visible: true
            }],

             dom: 'lBfrtip',
              buttons: [

                { extend: 'print',
                    text: 'Print All',
                    customize: function (win) {
                    $(win.document.body).css('direction', 'ltr');
                    },
                    exportOptions: {
                    columns: ':visible' }},

                   { extend: 'colvis',
                    text: ' Select Columns'},
                   
                    {extend: 'excelHtml5',
                    text: 'Print Excel',
                    exportOptions: {
                    columns: ':visible', }},
                    ],

            "order": [
                [0, "asc"]
            ],
            serverSide: true,
            columns: [

                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                
                {
                data: 'category_name',
                name: 'category_name'
                },

                {
                data: 'status',
                name: 'status'
                },
                {
                    data: 'Date',
                    name: 'Date'
                },

               {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
            ],
            ajax: {
                type: "POST",
                contentType: "application/json",
                url: '/dashboard/contacts/my-contacts-AjaxDT',
                data: function(d) {
                    d._token = "{{csrf_token()}}";
                  return JSON.stringify(d);
            },
            },
            fnDrawCallback: function() {}
        });
    }
    
</script>

@endsection()