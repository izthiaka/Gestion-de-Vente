<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $users = User::where('role_id', 2)->get();
        $articles = Article::where('quantite_article', '>', 0)->get();

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
        return view('admin.approvisions.index', compact('approvisionnement', 'users', 'articles'));
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

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'agent_id' => 'required',
            'articles' => 'required',
            'article_quantites' => 'required',
        ]);

        foreach($request->articles as $key_a => $article){

            $approvisionnement = Approvisionnement::create([
                'agent_id' => $request->agent_id,
                'article_id' => $article,
                'quantite_approv_depart' => $request->article_quantites[$key_a],
                'created_at' => null,
                'activite' => 0,
                'updated_at' => null,
            ]);
        }
        $approvisionnement->save();

        Session::flash('success', 'l\'approvisionnement a été crée avec succès');
        return redirect()->route('admin.approvisionnement-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function UpdateRefused(Request $request, $id)
    {
        $this->validate($request, [
            'quantite_approv_retour' => 'required',
            'article_id' => 'required',
            'quantite_approv_depart' => 'required',
        ]);

        $approv = Approvisionnement::find($id);

        $approv->agent_id = $request->agent_id;
        $approv->article_id = $request->article_id;
        $approv->quantite_approv_depart = $request->quantite_approv_depart;
        $approv->activite = 0;
        $approv->confirmed = null;
        $approv->created_at = now();
        $approv->updated_at = null;
        $approv->save();

        Session::flash('success', 'Approvisionnement en revu avec succés');
        return redirect()->route('admin.approvisionnement-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        $approv = Approvisionnement::find($id);

            $article = Article::find($approv->article_id);
            $article->quantite_article = $article->quantite_article + $approv->quantite_approv_depart;
            $article->save();

        $approv->delete();

        Session::flash('success', 'Approvisionnement a été supprimé avec succés');
        return redirect()->route('admin.approvisionnement-list');
    }
}
