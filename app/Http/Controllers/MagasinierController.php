<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Ordergroup;
use App\Models\Order;
use App\Models\OutputProduct;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Selling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MagasinierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manager()
    {
        $sellings = Selling::all();
        $users = User::with('sellings')
        ->get();
        $user = User::all();
                foreach($user as $user) :
                    $users[$user->id] = $user->nom.' '.$user->prenom;
                endforeach;

        $products = Product::with('sellings')
        ->get();
        $product = Product::all();
                foreach($product as $product) :
                    $products[$product->id] = $product->nom.' '.$product->prenom;
                endforeach;

        $non_execute = count(Order::where('execute', '=', 0)->where('approve', '=', 1)->get());
        /* $execute = count(Order::whereDay('created_at', today()->day)->where('execute', '=', 1)->where('approve', '=', 1)->get()); */

        $non_approve = count(Order::where('approve', '=', 0)->get());
        /* $approve = count(Order::whereDay('created_at', today()->day)->where('approve', '=', 1)->get()); */

        $vente_non_declare= count(Order::where('status', '=', 0)->where('approve', '=', 1)->where('execute', '=', 1)->get());
        /* $vente_declare = count(Order::whereDay('created_at', today()->day)->where('status', '=', 1)->where('approve', '=', 1)->where('execute', '=', 1)->get()); */

         $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('magasinier.index', compact('non_execute','non_approve', 'vente_non_declare',
                                                    'users', 'products',
                                                    'count_ecart', 'nbUserNotApproved'));
    }

    public function order(){
        $users = User::with('ordergroups')
        ->get();

        $ordergroups = Ordergroup::with('orders')
        ->where('close', '=', 0)
        ->get();

        $user_nom = User::all();
        foreach($user_nom as $user) :
            $users[$user->id] = $user->nom.' '.$user->prenom;
        endforeach;

        $products = Product::all();

       /*  $orders = Product::with('orders')
        ->get();
        $count = count($orders); */

        $p = Product::all();
        foreach($p as $product) :
            $products[$product->id] = $product->nomprod;
        endforeach;

        $qte_prod = Product::all();
        $pr = Product::all();
        foreach($pr as $produit) :
            $qte_prod[$produit->id] = $produit->qte;
        endforeach;


        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('magasinier.order.orderApprove', compact( 'products', 'ordergroups',
        'users', 'qte_prod', 'count_ecart', 'nbUserNotApproved'));
    }

    //exécuter une seule ligne order
    public function execute($order_id)
    {
        $order = Order::findOrFail($order_id);
        $product = Product::findOrFail($order->product_id);
        $order->update(['execute' => 1]);
        $product->update(['qte' => $product->qte - $order->qte]);


        OutputProduct::create([
            'output_qty' => $order->qte,
            'prev_value' => $product->qte + $order->qte,
            'product_id' => $order->product_id,
        ])->id;

        toastr()->success('Commande exécutée avec succès', 'Succès');
        return redirect()->route('order.approved.index');
    }

    //Désexecuter une seule ligne order
    public function unExecute($order_id)
    {
        $order = Order::findOrFail($order_id);
        $product = Product::findOrFail($order->product_id);
        $order->update(['execute' => 0]);
        $product->update(['qte' => $product->qte + $order->qte]);

        toastr()->success('Commande annulée avec succès', 'Succès');
        return redirect()->route('order.approved.index');
    }

    public function categories()
    {
        $categories = Category::all()->toArray();
        $nbUserNotApproved = User::where('isban', '>', 0)->count();
        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('magasinier.category', compact('categories', 'nbUserNotApproved', 'count_ecart'));
    }

    public function products()
    {
        $stocks = Stock::with('products')
        ->where('id', '>', 1)
        ->get();
        $p = Product::all();
        $count_product = count($p);

        $categories = Category::all();
        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $products = DB::table('products')
        ->join('categories', 'categories.id', 'products.categorie_id')
        ->join('stocks', 'stocks.id', 'products.stock_id')
        ->select('products.*', 'categories.libelle AS nom_categorie', 'stocks.libelle AS nom_stock')
        ->orderBy('stock_id', 'asc')->get();
        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('magasinier.product', compact('products', 'stocks', 'categories',
            'count_product', 'p', 'nbUserNotApproved', 'count_ecart'));
    }

    public function statistics()
    {

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
