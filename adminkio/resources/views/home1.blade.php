@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="card-title">Dashboard</h3>
            <div class="alert alert-primary" role="alert">
                Welcome to Angkasa Pura 1 Ahmad Yani International Airport Dashboard!!
            </div>

        <div class="my-0 my-sm-0">
            <div class="row row-cards">
                <div class="col-6 col-sm-3 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-green">
                            <i class="fa fa-cube" style="font-size:2em;"></i>
                            </div>
                            <div style="font-size:4vw;" class="m-0">{{ $tf }}</div>
                            <div class="text-green mb-4">Tenant</div>
                        </div>
                        <div class="small-box">
                            <a href="{{ url('/tenant') }}" style="background:#5eba00;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-blue">
                            <i class="fe fe-map" style="font-size:2em;"></i>
                            </div>
                            <div style="font-size:4vw;" class="m-0">{{ $wi }}</div>
                            <div class="text-blue mb-4">Wisata</div>
                        </div>
                        <div class="small-box">
                            <a href="{{ url('/wisata') }}" style="background:#467fcf;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-red">
                            <i class="fa fa-th-large" style="font-size:2em;"></i>
                            </div>
                            <div style="font-size:4vw;" class="m-0">{{ $sa }}</div>
                            <div class="text-red mb-4">Special Assistance</div>
                        </div>
                        <div class="small-box">
                            <a href="{{ url('/asisten') }}" style="background:#cd201f;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tenant-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th width="20px">Image</th>
                                    <th>Lantai 1</th>
                                    <th>Lantai 2</th>
                                    <th>Mezanine</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="wisata-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th width="20%">Image</th>
                                        <th>Type</th>
                                        <th>Status</th>
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
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#add-new-post').click(function () {
        $('#postCrudModal').html("Add New Post");
        $('#add-modal').modal('show');
    });
    $('#tenant-table').DataTable({
        serverSide: true,
        searching: false,
        bPaginate: false,
        info: false,
        ajax: 'home/jsont',
        columns: [
            { data: 'id', name: 'id',
              orderable: false,
              render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'name_tenant', name: 'name_tenant' },
            { data: 'image',
              name: 'image',
              "render": function (data) {
                if(data=="no-image"){
                    return '<img src="gambar/tenant/no-thumb.jpg" />';
                  }else{
                    return '<img src="gambar/tenant/' +data+ '" />';
                  }
                }

            },
            { data: 'lantai_1', name: 'lantai_1',
                render : function(data){
                    if(data=='1'){
                        return '<i class="fa fa-check" style="color: green;"></i>'
                    }
                    else if(data=='0'){
                        return '<i class="fa fa-close" style="color: red;"></i>'
                }
                }},
            { data: 'lantai_2', name: 'lantai_2',
                render : function(data){
                    if(data=='1'){
                    return '<i class="fa fa-check" style="color: green;"></i>'
                    }
                    else if(data=='0'){
                    return '<i class="fa fa-close" style="color: red;"></i>'
                }
            }},
                { data: 'mezanine', name: 'mezanine',
                    render : function(data){
                        if(data=='1'){
                            return '<i class="fa fa-check" style="color: green;"></i>'
                        }
                        else if(data=='0'){
                            return '<i class="fa fa-close" style="color: red;"></i>'
                    }
                }},
            { data: 'type',
              name: 'type',
              render : function(data){
                  if(data=='1'){
                     return 'Tenant'
                  }
                  else if(data=='2'){
                    return 'F&B'
                 }
                 else {
                   return 'Retail'
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
            }}
        ]
    });
    $('#wisata-table').DataTable({
        serverSide: true,
        searching: false,
        bPaginate: false,
        info: false,
        ajax: 'home/jsonw',
        columns: [
            { data: 'id', name: 'id',
              orderable: false,
              render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'nama', name: 'nama' },
            { data: 'image',
              name: 'image',
              "render": function (data) {
                if(data=="no-image"){
                    return '<img style="width:40%;" src="gambar/tenant/no-thumb.jpg" />';
                  }else{
                    return '<img style="width:40%;" src="gambar/wisata/' +data+ '" />';
                  }
                }
            },
            { data: 'type',
              name: 'type',
              render : function(data){
                  if(data=='1'){
                     return 'Religi'
                  }
                  else if(data=='2'){
                    return 'Warisan Budaya'
                 }
                 else if(data=='3'){
                   return 'Alam'
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
            }}
        ]
    });
});
</script>
@endsection


