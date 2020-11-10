@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/selfie') }}">Selfie</a></li>
                        <li class="breadcrumb-item active">Edit Selfie</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selfie</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($qr, ['url' => route('selfie.update', $qr->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('menu.selfie_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

