@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Tenant</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tenant</h3>
                    <div class="card-options">
                        <a id="add-new-post">
                            <button class="btn btn-outline-primary btn-sm"><i class="fe fe-plus mr-2"></i>Tambah Tenant</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table dataTable table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Start Add Modal  --}}
<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="postCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('tenant.store') }}" method="POST" enctype="multipart/form-data" id="postForm" name="postForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Nama Tenant" type="text" class="form-control" id="name_tenant" name="name_tenant" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="lantai_1" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Lantai 1</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="lantai_2" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Lantai 2</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="mezanine" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Mezanine</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="Deskripsi" type="text" class="form-control" id="deskripsi" name="deskripsi" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input placeholder="English Description" type="text" class="form-control" id="deskripsi_en" name="deskripsi_en" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="type" id="select-type" class="form-control custom-select" required="">
                                <option value="" disabled selected>Select Type</option>
                                @foreach ($cbt as $item)
                                <option value="{{ $item->poss_id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="file" placeholder="Image" id="image" name="image" value="">
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
{{-- End Add Modal  --}}
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-new-post').click(function() {
            $('#postCrudModal').html("Add New Tenant");
            $('#add-modal').modal('show');
        });

        $('#example').DataTable({
          responsive: true,
          serverSide: true,
          info: true,
          ajax: '{{route('tenant.index')}}',
          columns: [
              { data: 'id', name: 'id',
                orderable: false,
                searching: false,
                render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }},
              { data: 'name_tenant', name: 'name_tenant'},
              { data: 'nama', name: 'type'},
              { data: 'status',
                name: 'status',
                searching: false,
                render : function(data){
                    if(data=='1'){
                       return '<span class="badge badge-success">Aktif</span>'
                    }
                    else if(data=='0'){
                      return '<span class="badge badge-danger">Tidak Aktif</span>'
                   }}},
              { data: 'action', name: 'action',
                orderable: false,
                searching: false
              }
          ]
      });
    });

    function myFunction() {
        if (!confirm("Apakah anda yakin menghapus data ini?"))
            event.preventDefault();
    }
</script>
@endsection
