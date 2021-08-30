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

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="identifiant">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" required placeholder="Enter your email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center mb-3">
                            <button class="btn btn-primary btn-lg width-lg btn-rounded" type="submit"> Send Password Reset Link </button>
                        </div>

                    </form>

                </div>
                <!-- end card -->

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted">Retour à la page de<a href="{{ route('login') }}" class="text-dark ml-1">Connexion</a></p>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection
