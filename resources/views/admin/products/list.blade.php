@extends('admin.layouts.app')

@section('content')
    
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Products</h1>
            </div>
        </div>
        <div class="col-12">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header" id="datatable-header">
            <div class="col-md-10">
                <h3 class="card-title">Products Data</h3>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-block btn-primary">Add Product</a>
            </div>
        </div>

        <div class="card-body">
            <div id="data_list_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="data_list" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="data_list_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="data_list" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="data_list" rowspan="1" colspan="1">Title</th>
                                    <th class="sorting" tabindex="0" aria-controls="data_list" rowspan="1" colspan="1">Created At</th>
                                    <th class="sorting" tabindex="0" aria-controls="data_list" rowspan="1" colspan="1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($productsData) && $productsData != '[]')
                                    @foreach($productsData as $key => $value)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">@if(isset($value) && isset($value->name)) {{$value->name}} @endif</td>
                                            <td>@if(isset($value) && isset($value->title)) {{$value->title}} @endif</td>
                                            <td>@if(isset($value) && isset($value->created_at)) {!! $value->created_at->toDateString() !!} @endif</td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $value->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <form action="{{ route('admin.products.destroy', $value->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')               
                                                    <button onclick="return confirm('Are you sure you want to Delete?');">
                                                        <i class="fa fa-trash" aria-hidden="true" id="btnDelete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Title</th>
                                    <th rowspan="1" colspan="1">Created At</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('js')
<script type="text/javascript">

var baseUrl = "{{env('APP_URL')}}";

$(document).ready(function() {
    $("#data_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#data_list_wrapper .col-md-6:eq(0)');
    

  });

</script>
@endpush
