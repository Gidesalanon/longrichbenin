<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ordergroup;
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
       $ordergroups = Ordergroup::with('orders')
        ->where('user_id', Auth::user()->id)
        ->get();

        $orders = Product::with('orders')
        ->get();
        
        return view('order.index', compact( 'orders', 'ordergroups'));
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
        $orderId = Ordergroup::create([
            'user_id' => $request->user_id = Auth::user()->id,
        ])->id;
        
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
            $value["approve"] = "0";
            $value["ordergroup_id"] = $orderId;
            $created = now();
            $value["ref_created"] = $created;
            Order::create($value);
        }
        toastr()->success('Votre Commande a été enregistrée avec succès, veuillez attendre la validation de l\'administrateur.', 'Succès');
        return back();
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
        return view('order.edit', compact('order', 'products'));
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
        toastr()->success('Une ligne de commande a été supprimée avec succès.', 'Succès');
        return redirect()->route('orders.index');

    }

    /* ADMINISTRATION/ORDER/MANAGEMENT */

    public function orderIndex()
    {
        $orders = DB::table('orders')
        ->join('products', 'products.id', 'orders.product_id')
        ->join('users', 'users.id', 'orders.user_id')
        ->select('orders.*', 'products.nomprod AS nom_produit', 'users.nom AS nom', 'users.prenom AS prenom')
        ->get();
        $count = count($orders);

        return view('adminManagementOrder.orderApprove', compact('orders', 'count'));
    }

    public function approveOrder()
    {
        DB::table('orders')
            ->where('id','<>', 0)
            ->update(['approve' => "1"]);
        return redirect()->route('admin.order.index')->withMessage('Cette commande a été approuvée avec succès');
    }

    public function desapproveOrder()
    {
        DB::table('orders')
            ->where('id','<>', 0)
            ->update(['approve' => "0"]);
        return redirect()->route('admin.order.index')->withMessage('Cette commande a été désapprouvée avec succès');
    }

    public function editOrder($id)
    {
        $products = Product::all()->toArray();
        $order = Order::find($id);
        return view('adminManagementOrder.edit', compact('order', 'products'));
    }

    public function updateOrder(Request $request, Order $id)
    {
        $request->validate([
            'moreFields.*.product_id' => 'required',
            'moreFields.*.qte' => 'required',
            'moreFields.*.prix' => 'required',
        ]);

        $prices = explode('|',$request["product_id"])[1];
        $product_id = $request["product_id"] = explode('|',$request["product_id"])[0];
        $qte = $request['qte'];
        $price = $request['prix'] = $qte*$prices;
        Order::where('id', $id)->update([
            'product_id' => $request->product_id = $product_id,
            'prix' => $request->prix = $price,
            'qte' => $request->qte = $qte,
        ]);

        foreach ($request->moreFields as $key => $value) {
            $price = explode('|',$value["product_id"])[1];
            $value["product_id"] = explode('|',$value["product_id"])[0];
            $qte = $value['qte'];
            $value['prix'] = $qte*$price;

            Order::where('id', $id)->update([
            'product_id' => $request->product_id = $product_id,
            'prix' => $request->prix = $price,
            'qte' => $request->qte = $qte,
        ]);

        }

        return redirect()->route('admin.order.index')->withMessage('Ligne de commande modifiée avec succès.');
    }

    public function destroyOrder($id)
    {
        Order::where('id', $id)->delete();
        return redirect()->route('admin.order.index')->withMessage('Cette commande a été supprimée avec succès.');
    }


}
