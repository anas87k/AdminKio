@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Selfie</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selfie</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <table id="example" class="table dataTable table-striped table-bordered" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Foto</th>
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
@endsection


@section('scripts')
  <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $('#example').DataTable({
            responsive: true,
            serverSide: true,
            info: true,
            ajax: '{{route('selfie.index')}}',
            columns: [
                { data: 'id', name: 'id',
                  orderable: false,
                  searching: false,
                  render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'foto', name: 'foto',
                  render: function (data) {
                    if(data=="no-image"){
                        return '<img src="gambar/tenant/no-thumb.jpg" />';
                      }else{
                        return '<img src="gambar/selfie/image/' +data+ '" />';
                      }
                    }},
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
