<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategorieController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Categorie::withCount('article')->paginate(10);

        if($request->ajax()){
            $query = $request->recherche;
            $categories = Categorie::withCount('article')
                ->where('nom_categorie', 'like', '%'.$query.'%')
                ->paginate(10);
            return view('admin.categories.liste-categories', compact('categories'))->render();
        }
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom_categorie' => 'required|unique:categories,nom_categorie',
        ]);

        Categorie::create([
            'nom_categorie' => $request->nom_categorie,
            'slug_categorie' => Str::slug($request->nom_categorie, '-'),
        ]);

        Session::flash('success', 'la categorie a été crée avec succès');
        return redirect()->route('admin.categorie-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $this->validate($request, [
            'nom_categorie' => "required|unique:categories,nom_categorie, $id",
        ]);

        $categorie->nom_categorie = $request->nom_categorie;
        $categorie->slug_categorie = Str::slug($request->nom_categorie, '-');
        $categorie->save();

        Session::flash('success', 'la categorie a été modifiée avec succès');
        return redirect()->route('admin.categorie-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieInfluenceur  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        Session::flash('success', 'La categorie a été supprimée avec succès');
        return redirect()->route('admin.categorie-list');
    }
}
