<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Selling;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellings = Selling::where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.product_id')
            ->selectRaw("SUM(qte_vendu) as total_qte")
            ->selectRaw("SUM(pv) as total_pv")
            ->selectRaw("SUM(ca) as total_ca")
            ->selectRaw("DATE(created_at) as date")
            ->selectRaw("SUM(benefice) as total_benefice")
            ->groupBy('product_id')
            ->groupBy('date')
            ->get();

        $pv_sums = Selling::Where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(pv) as total_pv")
            ->groupBy('user_id')
            ->get();

        $ca_sums = Selling::Where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(ca) as total_ca")
            ->groupBy('user_id')
            ->get();

        $benefice_sums = Selling::Where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice) as total_benefice")
            ->groupBy('user_id')
            ->get();

        $marge_commissions = Selling::Where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice)*0.7 as sum_com")
            ->groupBy('user_id')
            ->get();

        $marge_nets = Selling::Where('user_id', Auth::user()->id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice)*0.3 as margeNet")
            ->groupBy('user_id')
            ->get();

        /* $sellings = DB::table('sellings')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as view'))
                    ->groupBy('date')
                    ->get(); */

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;

        $prixclients = Product::all();
        $pr = Product::all();
                foreach($pr as $prod) :
                    $prixclients[$prod->id] = $prod->prixclient;
                endforeach;

        $prixpartenaires = Product::all();
        $pro = Product::all();
                foreach($pro as $produit) :
                    $prixpartenaires[$produit->id] = $produit->prixpartenaire;
                endforeach;

        $pvProducts = Product::all();
        $pvs = Product::all();
                foreach($pvs as $pv) :
                    $pvProducts[$pv->id] = $pv->nbpv;
                endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('statistic.index', compact('sellings', 'products', 'nbUserNotApproved',
         'count_ecart', 'prixclients', 'prixpartenaires',
         'pv_sums', 'ca_sums', 'benefice_sums',
         'marge_commissions', 'marge_nets', 'pvProducts'));
    }

    public function statistic(Request $request)
    {
        $users = User::all();
        $sellings = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.product_id')
            ->select('sellings.user_id')
            ->selectRaw("SUM(qte_vendu) as total_qte")
            ->selectRaw("SUM(pv) as total_pv")
            ->selectRaw("SUM(ca) as total_ca")
            ->selectRaw("DATE(created_at) as date")
            ->selectRaw("SUM(benefice) as total_benefice")
            ->groupBy('product_id')
            ->groupBy('user_id')
            ->groupBy('date')
            ->get();

        $pv_sums = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(pv) as total_pv")
            ->groupBy('user_id')
            ->get();

        $ca_sums = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(ca) as total_ca")
            ->groupBy('user_id')
            ->get();

        $benefice_sums = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice) as total_benefice")
            ->groupBy('user_id')
            ->get();

        $marge_commissions = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice)*0.7 as sum_com")
            ->groupBy('user_id')
            ->get();

        $marge_nets = Selling::Where('user_id', $request->user_id)
            ->whereMonth('created_at', date('m'))
            ->select('sellings.user_id')
            ->selectRaw("SUM(benefice)*0.3 as margeNet")
            ->groupBy('user_id')
            ->get();

        /* $sellings = DB::table('sellings')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as view'))
                    ->groupBy('date')
                    ->get(); */

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;

        $prixclients = Product::all();
        $pr = Product::all();
                foreach($pr as $prod) :
                    $prixclients[$prod->id] = $prod->prixclient;
                endforeach;

        $prixpartenaires = Product::all();
        $pro = Product::all();
                foreach($pro as $produit) :
                    $prixpartenaires[$produit->id] = $produit->prixpartenaire;
                endforeach;

        $pvProducts = Product::all();
        $pvs = Product::all();
                foreach($pvs as $pv) :
                    $pvProducts[$pv->id] = $pv->nbpv;
                endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('statistic.admin_stat', compact('users','sellings', 'products', 'nbUserNotApproved',
         'count_ecart', 'prixclients', 'prixpartenaires',
         'pv_sums', 'ca_sums', 'benefice_sums',
         'marge_commissions', 'marge_nets', 'pvProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
