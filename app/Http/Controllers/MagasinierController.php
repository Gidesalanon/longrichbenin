<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Ordergroup;
use App\Models\Order;
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
        return view('magasinier.index');
    }

    public function order(){
        $users = User::with('ordergroups')
        ->get();

        $ordergroups = Ordergroup::with('orders')
        ->where('close', '=', '0')
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

        return view('magasinier.order.orderApprove', compact( 'products', 'ordergroups', 'users', 'qte_prod'));
    }

    //exécuter une seule ligne order
    public function execute($order_id)
    {
        $order = Order::findOrFail($order_id);
        $product = Product::findOrFail($order->product_id);
        $order->update(['execute' => 1]);
        $product->update(['qte' => $product->qte - $order->qte]);

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
