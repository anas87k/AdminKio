@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/panduan') }}">Wisata</a></li>
                        <li class="breadcrumb-item active">Edit Panduan Bandara</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Panduan Bandara</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($panduan, ['url' => route('panduan.update', $panduan->id),
                    'method' => 'put', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                    @include('menu.panduan_')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('action._script')
@endsection

