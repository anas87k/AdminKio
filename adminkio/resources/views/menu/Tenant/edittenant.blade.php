@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tenant.index') }}">Tenant</a></li>
                        <li class="breadcrumb-item active">Edit Tenant</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tenant</h3>
                </div>
                <div class="card-body">
                    {!! Form::model([$tenants,$cbt], ['url' => route('tenant.update', $tenants->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('menu.tenant.tenant_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
