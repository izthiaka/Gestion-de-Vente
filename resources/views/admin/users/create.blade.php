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
                            <li class="breadcrumb-item"><a href="{{route('admin.user-list')}}">Utilisateurs</a></li>
                            <li class="breadcrumb-item active">Nouveau utilisateur</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Nouveau utilisateur</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.user-store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Prénom Nom</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" data-toggle="flatpicker" placeholder="Prénom Nom" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" data-toggle="flatpicker" placeholder="login" required>
                                    @error('login')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" data-toggle="flatpicker" placeholder="Email" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="tel" name="numero_telephone" class="form-control @error('numero_telephone') is-invalid @enderror" data-toggle="flatpicker" placeholder="Numéro Téléphone" required>
                                    @error('numero_telephone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Photo profil</label>
                                    <input type="file" class="form-control @error('photo_profil') is-invalid @enderror" name="photo_profil" data-toggle="flatpicker">
                                    @error('photo_profil')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Date View -->
                                <div class="form-group">
                                    <label>Role d'utilisateur</label>
                                    <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                        @foreach ($roles as $item)
                                            <option value="{{$item->id}}">{{$item->nom_role}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">

                                <button type="submit" class="btn btn-success waves-effect waves-light m-1">
                                    <i class="fe-check-circle mr-1"></i>
                                    Enregistrer
                                </button>

                                <a href="{{ route('admin.user-list') }}" class="btn btn-light waves-effect waves-light m-1">
                                    <i class="fe-x mr-1"></i>
                                    Annuler
                                </a>

                            </div>
                        </div>

                    </form>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

@endsection
