<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Article;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ListeVenteController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ventes = Vente::paginate(10);
        $articles = Approvisionnement::all();

        if($request->ajax()){
            $query = $request->recherche;
            $ventes = Vente::join('users', 'ventes.agent_id', 'users.id')
                ->join('articles', 'ventes.article_id', 'articles.id')
                ->join('clients', 'ventes.client_id', 'clients.id')
                ->where('users.name', 'like', '%'.$query.'%')
                ->orWhere('clients.prenom_nom', 'like', '%'.$query.'%')
                ->orWhere('articles.nom_article', 'like', '%'.$query.'%')
                ->select('ventes.*')
                ->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.ventes.liste-ventes', compact('ventes'))->render();
        }
        return view('admin.ventes.index', compact('ventes', 'articles'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function UpdateVente(Request $request, $id)
    {
        $this->validate($request, [
            'article_id' => 'required',
            'quantite_article' => 'required',
        ]);

        $vente = Vente::find($id);

            $article = Article::find($vente->article_id);

        $vente->article_id = $request->article_id;
        $vente->quantite_article = $request->quantite_article;
        $vente->montant_total = ($article->prix_article * $request->quantite_article);
        $vente->save();

        Session::flash('success', 'Vente modifié avec succés');
        return redirect()->route('admin.vente-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        $vente = Vente::find($id);

            $approv = Approvisionnement::find($vente->article_id);
            $approv->quantite_restant = $approv->quantite_restant + $vente->quantite_article;
            $approv->save();

        $vente->delete();

        Session::flash('success', 'Vente a été supprimé avec succés');
        return redirect()->route('admin.vente-list');
    }
}
