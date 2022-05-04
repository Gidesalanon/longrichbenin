<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ordergroup;
use App\Models\User;
use App\Models\Selling;
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
        $users = User::with('ordergroups')
        ->get();
        $user = User::all();
                foreach($user as $user) :
                    $users[$user->id] = $user->nom.' '.$user->prenom;
                endforeach;

        $ordergroups = Ordergroup::with('orders')
        ->where('user_id', '=', Auth::user()->id)
        ->where('close', '=', 0)
        ->get();

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;
        $orders = Product::with('orders')
        ->get();

        $count = count($orders);

        $produits = Product::all();
        $pr = Product::all();
        foreach($pr as $produit) :
            $produits[$produit->id] = $produit->prixclient;
        endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('order.index', compact('orders', 'products', 'ordergroups',
        'users', 'count', 'produits', 'count_ecart'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Product::all();
        $pr = Product::all();
        foreach($pr as $produit) :
            $produits[$produit->id] = $produit->prixclient;
        endforeach;

        $products = Product::all()->where('status', '=', 'Actif')
        ->toArray();

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('order.create', compact( 'products', 'produits', 'count_ecart'));
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
            $value["execute"] = "0";
            $value["status"] = "0"; //point fait ou pas
            $value["ordergroup_id"] = $orderId;
            $created = now();
            $value["ref_created"] = $created;
            $value["user_id"] = Auth::user()->id;
            Order::create($value);
        }
        toastr()->success('Votre Commande a été enregistrée avec succès, veuillez attendre la validation de l\'administrateur.', 'Succès');
        return redirect()->route('orders.index');
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
        $products = Product::all()->where('status', '=', 'Actif')
        ->toArray();

        $order = Order::find($id);

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('order.edit', compact('order', 'products', 'count_ecart'));
    }

    public function update(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'qte' => $request->qte,
            'prix' => $request->prix,
        ]);

        toastr()->success('Ligne de commande modifiée avec succès.', 'Succès');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ordergroup::where('id', $id)->delete();
        toastr()->success('Cette commande a été supprimée avec succès.', 'Succès');
        return redirect()->route('orders.index');
    }

    //point quotidient /order/ des users

    public function orderSituation(){
        $users = User::with('ordergroups')
        ->get();

        $ordergroups = Ordergroup::with('orders')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

        $user = User::all();
        foreach($user as $user) :
            $users[$user->id] = $user->nom.' '.$user->prenom;
        endforeach;

        $orders = Order::all()
        ->where('execute', '=', '1')
        ->where('user_id', '=', Auth::user()->id)
        ->where('status', '=', '0');


        /* $orders = Product::with('orders')
        ->get();
        $count = count($orders); */

        $products = Product::all();
        $p = Product::all();
        foreach($p as $product) :
            $products[$product->id] = $product->nomprod;
        endforeach;

        $produits = Product::all();
        $pr = Product::all();
        foreach($pr as $produit) :
            $produits[$produit->id] = $produit->prixclient;
        endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('order.order-situation', compact('orders', 'products',
        'ordergroups', 'users', 'produits', 'count_ecart'));
    }

    public function destrLineOrder($id)
    {
        Order::where('id', $id)->delete();
        toastr()->success('Cette ligne de commande a été supprimée avec succès.', 'Succès');
        return redirect()->route('orders.index');
    }

    /* ADMINISTRATION/ORDER/MANAGEMENT */

    public function orderIndex()
    {
        $users = User::with('ordergroups')
        ->get();

        $ordergroups = Ordergroup::with('orders')
        ->where('close', '=', 0)
        ->get();

        $orderss = Order::with('ordergroups')
        ->get();
        $count_order = count($orderss);

        $user_nom = User::all();
        foreach($user_nom as $user) :
            $users[$user->id] = $user->nom.' '.$user->prenom;
        endforeach;

        $products = Product::all();

        $orders = Product::with('orders')
        ->get();
        $count = count($orders);

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

        return view('adminManagementOrder.orderApprove', compact('orders', 'products',
        'ordergroups', 'users', 'count',
        'orderss', 'count_order', 'qte_prod', 'count_ecart'));

    }

    //Approuver tous les orders d'un coup
    public function approveOrder()
    {
        DB::table('orders')
            ->where('id','<>', 0)
            ->update(['approve' => "1"]);
        toastr()->success('Toutes les commandes ont été approuvées avec succès', 'Succès');
        return redirect()->route('admin.order.index');
    }
    //Désactiver tous  les orders d'un coup
    public function desapproveOrder()
    {
        DB::table('orders')
            ->where('id','<>', 0)
            ->update(['approve' => "0"]);
        toastr()->success('Toutes les commandes ont été désapprouvées avec succès', 'Succès');
        return redirect()->route('admin.order.index');
    }

    //Approuver une seule ligne order
    public function approveOneOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update(['approve' => 1]);
        toastr()->success('Ligne de commande approuvée avec succès', 'Succès');
        return redirect()->route('admin.order.index');
    }

    //Désactiver une seule ligne order
    public function desapproveOneOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update(['approve' => 0]);
        toastr()->success('Ligne de commande désapprouvée avec succès', 'Succès');
        return redirect()->route('admin.order.index');
    }
    public function editOrder($id)
    {
        $products = Product::all()->toArray();
        $order = Order::find($id);

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('adminManagementOrder.edit', compact('order', 'products', 'count_ecart'));
    }

    public function updateOrder(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'qte' => $request->qte,
            'prix' => $request->prix,
        ]);
        toastr()->success('Commande modifiée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }

    public function destroyOrder($id)
    {
        Ordergroup::where('id', $id)->delete();
        toastr()->success('Commande supprimée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }

    public function destroyLineOrder($id)
    {
        Order::where('id', $id)->delete();
        toastr()->success('Ligne de commande supprimée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }
}
