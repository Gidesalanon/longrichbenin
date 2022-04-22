<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Selling;
use App\Models\Order;
use App\Models\Product;
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
        //
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
        /* dd($order[0]); */
        $product = Product::findOrFail($order[0]->product_id);

       Selling::create([
                        'qte_vendu' => $request->qte_vendu,
                        'ca' => $request->qte_vendu * $product->prixclient,   //ca:chiffre d'affaire =qte vendu*prix client produit
                        'srd' => $order[0]->qte - $request->qte_vendu,          //srd:stock restant du = stock obtenu-stock vendu
                        'vs' => $request->qte_vendu * $product->prixclient, //vs:valeur du stock client= srd*prix client produit
                        'order_id'=> $order[0]->id,
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
