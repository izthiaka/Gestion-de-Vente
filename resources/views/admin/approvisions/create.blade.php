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
                            <li class="breadcrumb-item"><a href="{{route('admin.approvisionnement-list')}}">Approvisionnements</a></li>
                            <li class="breadcrumb-item active">Nouveau Approvisionnement</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Nouveau Approvisionnement</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-md-4 mb-3">
                <a href="{{route('admin.approvisionnement-list')}}" class="btn width-xs btn-dark text-white">
                    <i class="fe-share-2"></i>
                    Liste des Approvisionnements
                </a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('admin.approvisionnement-store')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="agent_id">Choisir l'agent à approvisionner</label>
                                        <div class="col-md-7">
                                            <select class="col-md-12 selectpicker agent_id" data-style="btn-light btn-rounded" id="agent_id" name="agent_id" data-live-search="true" title="Choisissez l'agent">
                                                <option disabled selected>Choisissez un agent</option>
                                                @foreach ($users as $item)
                                                    <option value="{{$item->id}}">{{$item->name}} ({{$item->login}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" mt-2" id="info_student">
                                        <div class="row">
                                            <p class="font-weight-semibold">
                                                (<span style="color:crimson;" >*</span>)
                                                Champ Obligatoire
                                            </p>
                                        </div>
                                        <h4 class="header-title">Ref. Articles</h4>
                                        <p class="sub-header mt-2">
                                            Veuillez renseigner les champs.
                                        </p>

                                        <div class="row">
                                            <div class="col-8">
                                                <label class="col-4 col-form-label" for="articles">Articles</label><br>
                                                <select class="col-12 selectpicker articles" id="articles" name="articles[]" multiple data-live-search="true" title="Choisissez les articles">
                                                    <option disabled>Choisissez les articles</option>
                                                    @foreach ($articles as $item)
                                                        <option value="{{$item->id}}">{{$item->nom_article}}-{{$item->quantite_article}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <br>
                                                <br>
                                                <a href="javascript: void(0);" name="validated" id="validated" class="btn btn-info btn-xs">
                                                Ajouter
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6" id="output">

                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row text-right mt-2" id="validation">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-upload-outline"></i>
                                                Valider</button>
                                            <a href="{{route('admin.approvisionnement-list')}}" class="btn width-xs btn-dark text-white">
                                                <i class="mdi mdi-format-clear"></i>
                                                Annuler
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
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

