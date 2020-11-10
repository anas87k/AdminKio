@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/master') }}">Master Data</a></li>
                        <li class="breadcrumb-item active">Master Data Tenant</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Data Tenant</h3>
                    <div class="card-options">
                        <a id="add-new-post">
                            <button class="btn btn-outline-primary btn-sm"><i class="fe fe-plus mr-2"></i>Tambah Type Tenant</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                        {!! $html->table(['class'=>'table table-striped table-bordered' ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{--  Start Add Modal  --}}
<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="TenantModal"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('masterte.store') }}" method="POST" id="postForm" name="postForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Nama Type" type="text" class="form-control" id="nama" name="nama" value="" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--  End Add Modal  --}}
@endsection


@section('scripts')

{!! $html->scripts() !!}
<script type="text/javascript">
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#add-new-post').click(function () {
        $('#TenantModal').html("Add New Type");
        $('#add-modal').modal('show');
    });
});
</script>
@endsection

