<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', '<>', 1)->get();
        $nbUserNotApproved = User::where('status', '<>', 1)->count();
        return view('users', compact('users', 'nbUserNotApproved'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['status' => 1]);

        return redirect()->route('admin.users.index')->withMessage('Utilisateur approuvé avec succès');
    }

    public function destroy($user_id)
    {
        User::where('id', $user_id)->delete();

        return redirect()->route('admin.users.index')->withMessage('Utilisateur supprimé avec succès');  // -> resources/views/stocks/index.blade.php
    }

    public function administration(){
        return view('admin');
    }

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
