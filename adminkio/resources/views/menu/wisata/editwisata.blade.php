@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/wisata') }}">Wisata</a></li>
                        <li class="breadcrumb-item active">Edit Wisata</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Wisata</h3>
                </div>
                <div class="card-body">
                    {!! Form::model([$wisata,$cbw], ['url' => route('wisata.update', $wisata->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('menu.wisata.wisata_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
