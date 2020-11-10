@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wisata</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Wisata</h3>
                    <div class="card-options">
                        <a id="add-new-post">
                            <button class="btn btn-outline-primary btn-sm"><i class="fe fe-plus mr-2"></i>Tambah Wisata</button>
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

{{--  Start Add Modal  --}}
<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="wisataModal"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data" id="postForm" name="postForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                            <div class="col-sm-12">
                                <input placeholder="Nama Wisata" type="text" class="form-control" id="nama" name="nama" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea placeholder="Deskripsi" class="form-control" id="deskripsi" name="deskripsi" value="" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea placeholder="English Description" class="form-control" id="deskripsi_en" name="deskripsi_en" value=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea placeholder="Lokasi" class="form-control" id="lokasi" name="lokasi" value="" required=""></textarea>
                                <label style="color:red;"><b>*Salin link url embeded maps dari google maps</b></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input placeholder="Link Lokasi" type="text" class="form-control" id="nlink" name="link" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="file"  placeholder="Image" id="image" name="image" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select  name="type" id="select-type" class="form-control custom-select" required="">
                                        <option value="" disabled selected>Select Type Wisata</option>
                                        @foreach ($cbw as $item)
                                            <option value="{{ $item->poss_id }}">{{ $item->nama }}</option>
                                            {{-- <option value="1">Tenant</option>
                                            <option value="2">F&B</option>
                                            <option value="3">Retail</option> --}}
                                        @endforeach
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

        $('#add-new-post').click(function () {
            $('#wisataModal').html("Add New Wisata");
            $('#add-modal').modal('show');
        });

        $('#example').DataTable({
          serverSide: true,
          searching: true,
          info: true,
          ajax: '{{route('wisata.index')}}',
          columns: [
              { data: 'id', name: 'id',
                orderable: false,
                searching: false,
                render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }},
              { data: 'nama', name: 'nama'},
              { data: 'nm', name: 'type'},
              { data: 'status',
                name: 'status',
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
