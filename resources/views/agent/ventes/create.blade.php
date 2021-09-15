@extends('layouts.agent')
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
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('agent.vente-list')}}">Ventes</a></li>
                            <li class="breadcrumb-item active">Nouvelle Vente</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Nouvelle Vente</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agent.vente-store')}}" method="Post" enctype="multipart/form-data">
                            @csrf

                            <!-- information articles -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-2">
                                        <div class="row">
                                            <p class="font-weight-semibold">
                                                (<span style="color:crimson;" >*</span>)
                                                Champ Obligatoire
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-10">
                                                <label class="col-4 col-form-label" for="articles">Articles <span style="color:crimson;" >*</span></label><br>
                                                <select class="col-12 selectpicker articles @error('articles') is-invalid @enderror" id="articles" name="articles[]" multiple data-live-search="true" title="Choisissez les articles">
                                                    <option disabled>Choisissez l'articles</option>
                                                    @foreach ($approvisionnements as $item)
                                                        <option value="{{$item->id}}">{{$item->article->nom_article}}-{{$item->article->quantite_article}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <br>
                                                <br>
                                                <a href="javascript: void(0);" name="validated" id="validated" class="btn btn-info btn-xs validated">
                                                Ajouter
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6" id="output">

                                            </div>
                                        </div>
                                        <br>
                                        <br>

                                    </div>
                                </div>
                            </div>

                            <!-- option sur le client -->
                            <div class="row d-none" id="option_customer">
                                <div class="col-12 text-center">
                                    <p class="font-weight-semibold">
                                        Option de vente
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label" for="option">Choisir une option <span style="color:crimson;" >*</span></label>
                                        <div class="col-7">
                                            <select class="selectpicker option @error('option') is-invalid @enderror" id="option" data-style="btn-light btn-rounded" name="option">
                                                <option disabled selected>Choisissez une option</option>
                                                <option value="nouveau_client">Nouveau Client</option>
                                                <option value="ancien_client">Ancien Client</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 d-none" id="old_customer">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label" for="client_id">Choisir le client <span style="color:crimson;" >*</span></label>
                                        <div class="col-8">
                                            <select class="col-12 selectpicker client_id @error('client_id') is-invalid @enderror" data-style="btn-light btn-rounded" id="client_id" name="client_id" data-live-search="true" title="Choisissez le client">
                                                <option disabled selected>Choisissez un client</option>
                                                @foreach ($clients as $item)
                                                    <option value="{{$item->id}}">{{$item->prenom_nom}} ({{$item->telephone}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- option sur si un nouveau client -->
                            <div class="row d-none" id="new_customer">
                                <div class="col-12 text-center">
                                    <p class="font-weight-semibold">
                                        Veuillez renseigner les informations pour le nouveau client
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Prenom Nom <span style="color:crimson;" >*</span></label>
                                        <div class="col-7">
                                            <input type="text" name="prenom_nom" id="prenom_nom" class="form-control @error('prenom_nom') is-invalid @enderror">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Numero Téléphone <span style="color:crimson;" >*</span></label>
                                        <div class="col-7">
                                            <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Adresse</label>
                                        <div class="col-7">
                                            <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p class="sub-header mt-2">
                                Veuillez bien vérifier les informations. Une modification ou suppression serait possible que 5 minutes aprés cette validation.
                            </p>

                            <div class="row text-right mt-2 d-none" id="validation">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-upload-outline"></i>
                                        Valider</button>
                                    <a href="{{route('agent.vente-list')}}" class="btn width-xs btn-dark text-white">
                                        <i class="mdi mdi-format-clear"></i>
                                        Annuler
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

@endsection

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '.validated', function(){
                $("#option_customer").removeClass('d-none');
                $(document).on('change', '.option', function(){
                    var option = $(this).val();
                    if(option == 'nouveau_client'){
                        $("#ancien_client").addClass('d-none');
                        $("#new_customer").removeClass('d-none');
                        $("#validation").removeClass('d-none');
                    }
                    if(option == 'ancien_client'){
                        $("#old_customer").removeClass('d-none');
                        $("#validation").removeClass('d-none');
                        $("#nouveau_client").addClass('d-none');
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">

        let orderButton = document.getElementById("validated");
        let itemList = document.getElementById("articles");
        let outputBox = document.getElementById("output");

        orderButton.addEventListener("click", function() {
            let collection = itemList.selectedOptions;
            let output = '<div class="table-responsive">'+
                            '<table class="table m-0">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th class="text-center font-weight-bold">Article</th>'+
                                        '<th class="text-center font-weight-bold">Quantite</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>';

            for (let i=0; i<collection.length; i++) {
                var stock = collection[i].label;
                var qu = stock.split('-').pop();
                var max = parseInt(qu);
                output += "<tr>"+
                                "<td class='text-center font-weight-bold' name='articles[]'>"+
                                    collection[i].label+
                                "</td>"+
                                "<td class='text-center'>"+
                                    "<input type='number' class='article_quantites' name='article_quantites[]' min='1' max='"+max+"'>"+
                                "</td>"+
                            "</tr>";
            }

            outputBox.innerHTML = output+'</tbody></table></div>';
        }, false);

        var items = [];
        function guardarNumeros() {
            boxvalue = document.getElementById('article_quantites[]').value;
            items.push(boxvalue);
            console.log('tableau : ',items);
        }
    </script>
@endsection
