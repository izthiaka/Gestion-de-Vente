<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Nombre de Produits</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td class="text-center">{{$item->nom_categorie}}</td>
                                <td class="text-center">{{$item->slug_categorie}}</td>
                                <td class="text-center">{{$item->article_count}}</td>
                                <td class="text-center">
                                    <button type="button" data-toggle="modal" data-target="#modalEditCategory{{$item->id}}" class="btn btn-xs btn-purple">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteCategory{{$item->id}}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
