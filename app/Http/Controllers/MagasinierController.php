<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Ordergroup;
use Illuminate\Support\Facades\Auth;
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

        return view('adminManagementOrder.orderApprove', compact('orders', 'products', 'ordergroups', 'users', 'count'));
    }

    public function executeOrder()
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
