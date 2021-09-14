<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {

        $nbAdmin = User::where('role_id', 1)->get()->count();
        $nbAgent = User::where('role_id', 2)->get()->count();
        $nbCategory = Categorie::all()->count();
        $nbArticle = Article::all()->count();
        $datas = [
            'admin' => $nbAdmin,
            'agent' => $nbAgent,
            'category' => $nbCategory,
            'article' => $nbArticle,
        ];
        return view('admin.dashboard', compact('datas'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('agent.dashboard');
    }
}
