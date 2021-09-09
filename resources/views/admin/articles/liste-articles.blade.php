<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center font-weight-bold">Nom</th>
                            <th class="text-center font-weight-bold">Prix (Unitaire Paquet)</th>
                            <th class="text-center font-weight-bold">Categorie</th>
                            <th class="text-center font-weight-bold">Quantite</th>
                            <th class="text-center font-weight-bold">Disponibilite</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td class="text-center">{{$item->nom_article}}</td>
                                <td class="text-center font-weight-bold">{{number_format($item->prix_article, 0, ',', ' ')}} Fcfa</td>
                                <td class="text-center text-uppercase">{{$item->categorie->nom_categorie}}</td>
                                <td class="text-center">{{$item->quantite_article}}</td>
                                <td class="text-center">
                                    @if ($item->disponibilite == 1)
                                        @if ($item->disponibilite == 1 && $item->quantite_article > 5)
                                            <button class="btn btn-success btn-xs">stock disponible</button>
                                        @endif
                                        @if ($item->disponibilite == 1 && $item->quantite_article <= 5)
                                            <button class="btn btn-warning btn-xs">en cours d'épuisement</button>
                                        @endif
                                    @endif
                                    @if ($item->disponibilite == 0)
                                        <button class="btn btn-danger btn-xs">en rupture de stock</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.article-edit', [$item->id])}}" class="btn btn-xs btn-purple">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteArticle{{$item->id}}">
                                        <i class="mdi mdi-delete"></i>
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
