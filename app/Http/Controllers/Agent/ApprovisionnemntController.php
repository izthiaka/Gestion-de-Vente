<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApprovisionnemntController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $approvisionnement = Approvisionnement::where('agent_id', Auth::user()->id)
            ->paginate(10);

        if($request->ajax()){
            $query = $request->recherche;
            $approvisionnement = Approvisionnement::join('categories', 'articles.categorie_id', 'categories.id')
                ->where('agent_id', Auth::user()->id)
                // ->orWhere('quantite_article', 'like', '%'.$query.'%')
                // ->orWhere('prix_article', 'like', '%'.$query.'%')
                // ->orWhere('categories.nom_categorie', 'like', '%'.$query.'%')
                // ->select('articles.*')
                ->paginate(10);
            return view('agent.approvisions.liste-approvisions', compact('approvisionnement'))->render();
        }
        return view('agent.approvisions.index', compact('approvisionnement'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function validated($id)
    {
        $approv = Approvisionnement::find($id);

        $approv->activite = 1;
        $approv->confirmed = 1;
        $approv->created_at = now();
        $approv->updated_at = null;
        $approv->save();

        Session::flash('success', 'Validation avec succès');
        return redirect()->route('agent.approvisionnement-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Refused($id)
    {
        $approv = Approvisionnement::find($id);

        $approv->activite = 2;
        $approv->confirmed = 0;
        $approv->updated_at = null;
        $approv->save();

        Session::flash('success', 'Approvisionnement en revision');
        return redirect()->route('agent.approvisionnement-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function RetourSave(Request $request, $id)
    {
        $this->validate($request, [
            'quantite_approv_retour' => 'required',
        ]);

        $approv = Approvisionnement::find($id);
            $article = Article::find($approv->article_id);
            $article->quantite_article = $article->quantite_article + $request->quantite_approv_retour;
            $article->save();

        $approv->quantite_approv_retour = $request->quantite_approv_retour;
        $approv->activite = 3;
        $approv->date_retour = now();
        $approv->save();

        Session::flash('success', 'Retour d\'article enrégistré avec succés.');
        return redirect()->route('agent.approvisionnement-list');
    }
}
