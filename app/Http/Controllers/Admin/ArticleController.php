<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $articles = Article::paginate(10);

        if($request->ajax()){
            $query = $request->recherche;
            $articles = Article::join('categories', 'articles.categorie_id', 'categories.id')
                ->where('nom_article', 'like', '%'.$query.'%')
                ->orWhere('quantite_article', 'like', '%'.$query.'%')
                ->orWhere('prix_article', 'like', '%'.$query.'%')
                ->orWhere('categories.nom_categorie', 'like', '%'.$query.'%')
                ->select('articles.*')
                ->paginate(10);
            return view('admin.articles.liste-articles', compact('articles'))->render();
        }
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom_article' => 'required|unique:articles,nom_article',
            'prix_article' => 'required',
            'categorie_id' => 'required',
            'quantite_article' => 'required',
        ]);

        $article = Article::create([
            'nom_article' => $request->nom_article,
            'prix_article' => $request->prix_article,
            'categorie_id' => $request->categorie_id,
            'quantite_article' => $request->quantite_article,
            'description_article' => $request->description_article,
        ]);

        if($request->quantite_article == 0){
            $article->disponibilite = 0;
        }

        if($request->quantite_article !== 0){
            $article->disponibilite = 1;
        }

        if($request->hasFile('photo_article')){
            $photo = $request->photo_article;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/articles/', $image_new_name);
            $article->photo_article = '/storage/articles/'.$image_new_name;
        }
        $article->save();

        Session::flash('success', 'l\'article a été crée avec succès');
        return redirect()->route('admin.article-list');
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Categorie::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $this->validate($request, [
            'nom_article' => "required|unique:articles,nom_article, $id",
            'prix_article' => 'required',
            'categorie_id' => 'required',
            'quantite_article' => 'required',
        ]);

        $article->nom_article = $request->nom_article;
        $article->prix_article = $request->prix_article;
        $article->categorie_id = $request->categorie_id;
        $article->quantite_article = $request->quantite_article;
        $article->description_article = $request->description_article;

        if($request->quantite_article == 0){
            $article->disponibilite = 0;
        }

        if($request->quantite_article !== 0){
            $article->disponibilite = 1;
        }

        if($request->hasFile('photo_article')){
            $photo = $request->photo_article;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/articles/', $image_new_name);
            $article->photo_article = '/storage/articles/'.$image_new_name;
        }
        $article->save();

        Session::flash('success', 'l\'article a été modifiée avec succès');
        return redirect()->route('admin.article-list');
    }
}
