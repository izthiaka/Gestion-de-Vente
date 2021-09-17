<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\User;
use App\Models\Vente;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

// use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;


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
        $nbClient = Client::all()->count();
        $nbArticle = Article::all()->count();
        $datas = [
            'admin' => $nbAdmin,
            'agent' => $nbAgent,
            'client' => $nbClient,
            'article' => $nbArticle,
        ];

        // Ventes recentes
        $ventes_recentes = Vente::orderBy('created_at', 'desc')->take(10)->get();


        // Top agent qui ont le plus vendu
        $ventes = Vente::join('users', 'ventes.agent_id', 'users.id')
            ->select('users.name', DB::raw('SUM(ventes.montant_total) as total_sales'))
            ->groupBy('users.name')->orderBy('total_sales', 'desc')->take(5)->get();

        $vente_array = $ventes->toArray();
        $vendeurs = Arr::pluck($vente_array, 'name');
        $montant = Arr::pluck($vente_array, 'total_sales');
        $montant = array_map(function($value) {
            return intval($value);
        }, $montant);

        $chart = (new LarapexChart)->setTitle('Vente')
                   ->setDataset($montant)
                   ->setLabels($vendeurs);



        // Vente mensuelle
        setlocale(LC_TIME, "fr_FR", "French");
        $ventes_m = Vente::select(
            DB::raw('SUM(montant_total) as total_sales'),
            DB::raw("DATE_FORMAT(created_at, '%m/%y') mois"),
            DB::raw('MONTH(created_at) month')
            )->groupBy('month')->orderBy('created_at', 'asc')->take(12)->get();

        $vente_m_array = $ventes_m->toArray();
        $mois = Arr::pluck($vente_m_array, 'mois');
        $montant_m = Arr::pluck($vente_m_array, 'total_sales');
        $montant_m = array_map(function($value) {
            return intval($value);
        }, $montant_m);

        $line = (new LarapexChart)->areaChart()
            ->addData('Vente totale', $montant_m)
            ->setXAxis($mois);


        return view('admin.dashboard', compact('datas', 'chart', 'line', 'ventes_recentes'));
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
