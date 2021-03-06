<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6 text-left">
                    <h3 class="header-title mb-2">Liste des Ventes</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">Client</th>
                            <th class="text-center font-weight-bold">Article</th>
                            <th class="text-center font-weight-bold">Quantite</th>
                            <th class="text-center font-weight-bold">Prix Unitaire</th>
                            <th class="text-center font-weight-bold">Montant Total</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventes as $key => $item)
                            <tr>
                                <td class="text-center">{{$item->client->prenom_nom}}</td>
                                <td class="text-center">{{$item->article->nom_article}}</td>
                                <td class="text-center">{{$item->quantite_article}}</td>
                                <td class="text-center font-weight-bold">{{number_format($item->article->prix_article, 0, ',', '.')}}</td>
                                <td class="text-center font-weight-bold">{{number_format($item->montant_total, 0, ',', '.')}}</td>
                                <td class="text-center">
                                    @if ($item->created_at->diffInMinutes(now()) < 5)
                                        <button class="btn btn-xs btn-purple" data-toggle="modal" data-target="#modalEditArticle{{$item->id}}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteApprov{{$item->id}}">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
