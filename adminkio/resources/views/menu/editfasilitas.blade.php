@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                        <li class="breadcrumb-item active">Edit Fasilitas</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tenant & Fasilitas</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($fasilitas, ['url' => route('fasilitas.update', $fasilitas->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('menu.fasilitas_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

