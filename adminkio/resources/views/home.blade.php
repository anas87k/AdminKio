@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tenant & Fasilitas</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tenant & Fasilitas</h3>
                    <div class="card-options">
                        <a id="add-new-post">
                            <button class="btn btn-outline-primary btn-sm"><i class="fe fe-plus mr-2"></i>Tambah Tenant</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="users-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th width= 70>Action</th>
                            </tr>
                        </thead>
                    </table>
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
                <h4 class="modal-title" id="postCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" id="postForm" name="postForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Nama Tenant" type="text" class="form-control" id="name_tenant" name="name_tenant" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select  name="lantai_1" id="select-type" class="form-control custom-select">
                                <option value="" disabled selected>Lantai 1</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select  name="lantai_2" id="select-type" class="form-control custom-select">
                                <option value="" disabled selected>Lantai 2</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select  name="mezanine" id="select-type" class="form-control custom-select">
                                <option value="" disabled selected>Mezanine</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Deskripsi" type="text" class="form-control" id="deskripsi" name="deskripsi" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select  name="type" id="select-type" class="form-control custom-select">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="1">Tenant</option>
                                    <option value="2">F&B</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="file" placeholder="Image" id="image" name="image" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="status" id="select-type" class="form-control custom-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                            </select>
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
<script type="text/javascript">
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#lantai_1').on('change', function(){
        var custom=$("#lantai_1").is(':checked')?1:0;
     });

    $('#add-new-post').click(function () {
        $('#postCrudModal').html("Add New Post");
        $('#add-modal').modal('show');
    });
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        bPaginate: false,
        info: false,
        ajax: 'home/json',
        columns: [
            { data: 'poss_id', name: 'poss_id' },
            { data: 'name_tenant', name: 'name_tenant' },
            { data: 'type',
              name: 'type',
              render : function(data){
                  if(data=='1'){
                     return 'Tenant'
                  }
                  else if(data=='2'){
                    return 'F&B'
                 }
              }},
            {data: 'status',
            name: 'status',
            render : function(data){
                if(data=='1'){
                   return '<span class="badge badge-success">Aktif</span>'
                }
                else if(data=='0'){
                  return '<span class="badge badge-danger">Tidak Aktif</span>'
               }
            }},
            { data: 'action',
              name: 'action',
              orderable: false,
            }
        ]
    });
});
</script>
@endsection


