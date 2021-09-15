<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Article;
use App\Models\Client;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VenteController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ventes = Vente::where('agent_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')->paginate(10);
        $articles = Approvisionnement::all();

        if($request->ajax()){
            $query = $request->recherche;
            $ventes = Vente::where('agent_id', Auth::user()->id)
                // ->orWhere('quantite_article', 'like', '%'.$query.'%')
                // ->orWhere('prix_article', 'like', '%'.$query.'%')
                // ->orWhere('categories.nom_categorie', 'like', '%'.$query.'%')
                // ->select('articles.*')
                ->orderBy('created_at', 'desc')->paginate(10);
            return view('agent.ventes.liste-ventes', compact('ventes'))->render();
        }
        return view('agent.ventes.index', compact('ventes', 'articles'));
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $clients = Client::where('agent_id', Auth::user()->id)->get();
        $approvisionnements = Approvisionnement::where(
            [
                ['activite', 1],
                ['confirmed', 1],
                ['agent_id', Auth::user()->id],
                ['quantite_restant', '>', 0]
            ]
        )->get();
        return view('agent.ventes.create', compact('approvisionnements', 'clients'));
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'articles' => "required",
            'option' => 'required',
            'client_id' => 'required_if:option,==,ancien_client',
            'prenom_nom' => 'required_if:option,==,nouveau_client',
            'telephone' => 'required_if:option,==,nouveau_client',
        ]);

        if($request->option == "ancien_client"){

            foreach($request->articles as $key_a => $article){

                $article_unitaire = Article::where('id', $article)->first();
                $vente = Vente::create([
                    'agent_id' => Auth::user()->id,
                    'article_id' => $article,
                    'quantite_article' => $request->article_quantites[$key_a],
                    'montant_total' => ($article_unitaire->prix_article * $request->article_quantites[$key_a]),
                    'client_id' => $request->client_id,
                ]);

                    $article = Approvisionnement::where([
                            ['agent_id', Auth::user()->id],
                            ['article_id', $article]
                        ])->orderBy('created_at', 'desc')->first();
                $article->quantite_restant = $article->quantite_restant - $request->article_quantites[$key_a];
                $article->save();
            }
            $vente->save();

        }

        if($request->option == "nouveau_client"){
            $client = Client::create([
                'prenom_nom' => $request->prenom_nom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'agent_id' => Auth::user()->id,
            ]);

            foreach($request->articles as $key_a => $article){

                $article_unitaire = Article::where('id', $article)->first();
                $vente = Vente::create([
                    'agent_id' => Auth::user()->id,
                    'article_id' => $article,
                    'quantite_article' => $request->article_quantites[$key_a],
                    'montant_total' => ($article_unitaire->prix_article * $request->article_quantites[$key_a]),
                    'client_id' => $client->id,
                ]);
            }
            $vente->save();

        }

        Session::flash('success', 'Vente enrégistré avec succés.');
        return redirect()->route('agent.vente-list');
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
        return redirect()->route('agent.vente-list');
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
        return redirect()->route('agent.vente-list');
    }
}
