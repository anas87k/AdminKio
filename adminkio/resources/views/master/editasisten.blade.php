@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/master') }}">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/master/asisten') }}">Master Data Special Assistance</a></li>
                        <li class="breadcrumb-item active">Master Data Special Assistance Edit</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Wisata</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($asisten, ['url' => route('masteras.update', $asisten->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('master.asisten_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

