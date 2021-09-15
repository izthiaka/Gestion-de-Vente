@extends('layouts.login')

@section('content')
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div>

                    <div class="text-center authentication-logo mb-4">
                        <a class="logo-dark">
                            <span><img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="30"></span>
                        </a>
                        <a class="logo-light">
                            <span><img src="{{asset('assets/images/logo-light.png')}}" alt="" height="30"></span>
                        </a>
                    </div>
                    <div class="errors-container">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="identifiant">Login Or Email</label>
                            <input class="form-control @error('identifiant') is-invalid @enderror" name="identifiant" type="text" id="identifiant" required placeholder="Enter your identifiant" value="{{ old('identifiant') }}">
                            @error('identifiant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted float-right">Forgot your password?</a>
                        @endif

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required id="password" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" checked>
                                <label class="custom-control-label" for="remember">Remember me</label>
                            </div>
                        </div>

                        <div class="form-group text-center mb-3">
                            <button class="btn btn-primary btn-lg width-lg btn-rounded" type="submit"> Connexion </button>
                        </div>

                    </form>

                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection
