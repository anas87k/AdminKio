@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/master') }}">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/master/wisata') }}">Master Data Tenant</a></li>
                        <li class="breadcrumb-item active">Master Data Tenant Edit</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Wisata</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($tenant, ['url' => route('masterte.update', $tenant->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('master.tenant_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

