<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
        ->join('products', 'products.id', 'orders.product_id')
        ->join('users', 'users.id', 'orders.user_id')
        ->select('orders.*', 'products.nomprod AS nom_produit', 'users.nom AS nom', 'users.prenom AS prenom')
        ->where('user_id', Auth::user()->id)
        ->get();

        return view('order.index', compact( 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all()->toArray();
        return view('order.create', compact( 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.product_id' => 'required',
            'moreFields.*.qte' => 'required',
            'moreFields.*.prix' => 'required',
        ]);

        foreach ($request->moreFields as $key => $value) {
            $price = explode('|',$value["product_id"])[1];
            $value["product_id"] = explode('|',$value["product_id"])[0];
            $qte = $value['qte'];
            $value['prix'] = $qte*$price;
            $value["user_id"] = Auth::user()->id;
            Order::create($value);
        }

        return back()->with('success', 'Votre Commande a été enregistrée avec succès, veuillez attendre la validation de l\'administrateur.');
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
    public function edit(Order $order)
    {
        $products = Product::all()->toArray();
        $order = Order::findOrFail($order->id);
        return view('order.edit', compact('order', 'products', 'orders'));
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
        $request["product_id"] = explode('|',$request["product_id"])[0];
        $request['prix'] = $request['qte'] * $request['prixclient'];
        Order::where('id', $id)->update([
            'product_id' => $request->product_id,
            'prix' => $request->prix,
            'qte' => $request->qte,
        ]);
        return redirect()->route('order.index')->withMessage('Commande modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::where('id', $id)->delete();

        return redirect()->route('orders.index')->withMessage('La ligne de commande a été supprimée avec succès.');
    }
}
