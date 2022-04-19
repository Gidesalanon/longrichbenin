<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ordergroup;
use App\Models\User;
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

        $ordergroups = Ordergroup::with('orders')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

        $user = User::all();
        foreach($user as $user) :
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

        return view('order.index', compact('orders', 'products', 'ordergroups', 'users', 'count'));
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
            $value["execute"] = "0";
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
    public function edit($id)
    {
        $products = Product::all()->toArray();
        $order = Order::find($id);
        return view('order.edit', compact('order', 'products'));
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

    public function point(){
        
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

        return view('adminManagementOrder.orderApprove', compact('orders', 'products', 'ordergroups', 'users', 'count', 'orderss', 'count_order'));

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
        return view('adminManagementOrder.edit', compact('order', 'products'));
    }

    public function updateOrder(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'qte' => $request->qte,
            'prix' => $request->prix,
        ]);

        toastr()->success('Ligne de commande modifiée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }

    public function destroyOrder($id)
    {
        Ordergroup::where('id', $id)->delete();
        toastr()->success('Cette commande a été supprimée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }

    public function destroyLineOrder($id)
    {
        Order::where('id', $id)->delete();
        toastr()->success('Cette ligne de commande a été supprimée avec succès.', 'Succès');
        return redirect()->route('admin.order.index');
    }

}
