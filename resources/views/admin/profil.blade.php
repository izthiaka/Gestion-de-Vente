@extends('layouts.admin')
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{{ asset($profile->photo_profil) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0">{{ $profile->name }}</h4>
                    <p class="text-muted">
                        Administrateur
                    </p>

                    <div class="text-left mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $profile->numero_telephone }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $profile->email }}</span></p>
                    </div>

                </div>
                <!-- end card-box -->

            </div>
            <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" id="aboutmeTab" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Informations personnelles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" id="settingsTab" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Paramétrage
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="aboutme">

                            <form method="POST" action="{{route('admin.auth-update_profile')}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Informations personnelles</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Prénom Nom</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputname" placeholder="Prénom(s)" value="{{ $profile->name }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="login">Login</label>
                                            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" id="inputlogin" placeholder="login" value="{{ $profile->login }}">
                                            @error('login')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" placeholder="Email" value="{{ $profile->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usenum_telremail">Téléphone</label>
                                            <input type="tel" class="form-control @error('numero_telephone') is-invalid @enderror" name="numero_telephone" id="inputNumTel" placeholder="70 432 98 80" value="{{ $profile->numero_telephone }}">
                                            @error('numero_telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="photo">Photo de profil</label>
                                            <input type="file" class="form-control-file" id="photo" name="photo">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Enregistrer</button>
                                </div>
                            </form>

                        </div>
                        <!-- end tab-pane -->

                        <div class="tab-pane" id="settings">

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

                            <form method="POST" id="identicalForm" action="{{route('admin.auth-update_password')}}">
                                @csrf
                                @method('PUT')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Mot de passe </h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nouveau_mot_de_passe">Ancien mot de passe</label>
                                            <input type="password" class="form-control" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" placeholder="Entrer votre Ancien mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre nouveau mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirmer nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer votre nouveau mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Enregistrer</button>
                                </div>
                            </form>

                        </div>
                        <!-- end settings content-->

                    </div>
                    <!-- end tab-content -->
                </div>
                <!-- end card-box-->

            </div>
            <!-- end col -->
        </div>
        <!-- end row-->

    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function() {
    var url = window.location.href;
    var idx = url.indexOf("#");
    var hash = idx != -1 ? url.substring(idx+1) : "";

    if(hash === "settings") {
        $('#aboutmeTab').removeClass('active');
        $('#aboutme').removeClass('active');
        $('#settingsTab').addClass('active');
        $('#settings').addClass('active');
    }
});

</script>
@endsection
