<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
