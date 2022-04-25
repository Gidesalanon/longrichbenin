<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Selling;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellings = Selling::all();
        $orders = Order::with('sellings')
        ->get();
        $order = Order::all();
                foreach($order as $order) :
                    $orders[$order->id] = $order->qte;
                endforeach;

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;

        return view('selling.index', compact('sellings', 'orders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::where('id', $request->order_id)->get();
        $getIdOrder = Order::findOrFail($request->order_id);
        $getIdOrder->update(['status' => 1]);
        /* dd($order[0]); */
        $product = Product::findOrFail($order[0]->product_id);

       Selling::create([
                        'qte_vendu' => $request->qte_vendu,
                        'ca' => $request->qte_vendu * $product->prixclient,   //ca:chiffre d'affaire =qte vendu*prix client produit
                        'srd' => $order[0]->qte - $request->qte_vendu,       //srd:stock restant du = stock obtenu-stock vendu
                        'vs' => $request->qte_vendu * $product->prixclient, //vs:valeur du stock client= srd*prix client produit
                        'ecart' => $order[0]->prix - ($request->qte_vendu * $product->prixclient), //ecart: montant total de cmde - chiffre d'affaire du client
                        'status' => "1", //status=1 -> vente enregistrée, status=0 -> non enregistrée
                        'order_id'=> $order[0]->id,
                        'product_id'=> $request->product_id,
                        'user_id'=> Auth::user()->id]);

        toastr()->success('Votre vente a été enregistrée avec succès', 'Succès');
        return redirect()->route('orders.situation');
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
