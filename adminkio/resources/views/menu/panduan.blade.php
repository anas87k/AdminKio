@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Panduan Bandara</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Panduan Bandara</h3>
                    <div class="card-options">
                        <a id="postPanduan">
                            <button class="btn btn-outline-primary btn-sm"><i class="fe fe-plus mr-2"></i>Tambah Panduan Bandara</button>
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
                <h4 class="modal-title" id="wisataModal"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('panduan.store') }}" method="POST" enctype="multipart/form-data" id="postForm" name="postForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Nama Panduan" type="text" class="form-control" id="post_title" name="post_title" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="col-sm-12">
                                <input placeholder="Guide Name (English)" type="text" class="form-control" id="en_title" name="en_title" value="" required="">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea placeholder="Deskripsi" class="form-control" id="post_desc" name="post_desc" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea placeholder="English Description" class="form-control" id="en_desc" name="en_desc"></textarea>
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

    $('#postPanduan').click(function () {
        $('#wisataModal').html("Add New Panduan");
        $('#add-modal').modal('show');
    });
});
</script>
@endsection

