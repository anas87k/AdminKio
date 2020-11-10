<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin PC Kiosk') }}</title>

        <link href="{{ asset('assets/images/fav.jpg') }}" rel="shortcut icon">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('admin/css/dashboard.css')}}">
        {{-- <link rel="stylesheet" href=""> --}}
        <link href="{{ asset('assets/css/fontawsom-all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid conya">
            <div class="side-left">
                <div class="sid-layy">
                    <div class="row slid-roo">
                        <div class="data-portion">
                            {{-- <h2>Manage Your orders</h2>
                            <p>Add captions to your slides easily with the .carousel-caption element within any .carousel-item. They can be easily hidden on smaller viewports, as shown below, with optional display utilities. We hide them initially with .d-none and bring them back on medium-sized devices </p>
                            <ul>
                                <li>Ph :- +91 9756545434</li>
                                <li>Fax :- (+7867 65 544)</li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="side-right">
                <img class="logo" src="{{ asset('assets/images/NIA.png') }}" alt="">

                <h2>Register Your Account</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-row">
                        <label class="form-label" for="name">{{ __('Nama') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-row dfr">
                        <button type="submit" class="btn btn-success ml-auto">Register</button>
                    </div>
                </form>
            </div>
            {{-- <div class="copyco">
                <p>Copyrigh 2019 @ smarteyeapps.com</p>
            </div> --}}
        </div>
    </body>

    <script src="{{ asset('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/script.js')}}"></script>


</html>

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
