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

                    <form method="POST" action="{{ route('agent.form-change-password') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="ancien_mot_de_passe">Ancien mot de passe</label>
                            <input class="form-control @error('ancien_mot_de_passe') is-invalid @enderror" type="password" name="ancien_mot_de_passe" required id="ancien_mot_de_passe" placeholder="Enter your password">
                            @error('ancien_mot_de_passe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Nouveau mot de passe</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required id="password" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirmer nouveau mot de passe</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required id="password_confirmation" placeholder="Enter your password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center mb-3">
                            <button class="btn btn-primary btn-lg width-lg btn-rounded" type="submit"> Changer de mot de passe </button>
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
