<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ApprovisionnementController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $approvisionnement = Approvisionnement::paginate(10);

        if($request->ajax()){
            $query = $request->recherche;
            $approvisionnement = Approvisionnement::join('categories', 'articles.categorie_id', 'categories.id')
                // ->where('nom_article', 'like', '%'.$query.'%')
                // ->orWhere('quantite_article', 'like', '%'.$query.'%')
                // ->orWhere('prix_article', 'like', '%'.$query.'%')
                // ->orWhere('categories.nom_categorie', 'like', '%'.$query.'%')
                // ->select('articles.*')
                ->paginate(10);
            return view('admin.approvisions.liste-approvisions', compact('approvisionnement'))->render();
        }
        return view('admin.approvisions.index', compact('approvisionnement'));
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $users = User::where('role_id', 2)->get();
        $articles = Article::where('quantite_article', '!=', 0)->get();
        return view('admin.approvisions.create', compact('articles', 'users'));
    }
}
