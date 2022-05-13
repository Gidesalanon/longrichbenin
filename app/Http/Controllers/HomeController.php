<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Selling;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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

        $non_execute = count(Order::where('execute', '=', 0)->where('approve', '=', 1)->where('user_id', Auth::user()->id)->get());
        /* $execute = count(Order::whereDay('created_at', today()->day)->where('execute', '=', 1)->where('approve', '=', 1)->get()); */

        $non_approve = count(Order::where('approve', '=', 0)->where('user_id', Auth::user()->id)->get());
        /* $approve = count(Order::whereDay('created_at', today()->day)->where('approve', '=', 1)->get()); */

        $vente_non_declare= count(Order::where('status', '=', 0)->where('approve', '=', 1)->where('execute', '=', 1)->where('user_id', Auth::user()->id)->get());
        /* $vente_declare = count(Order::whereDay('created_at', today()->day)->where('status', '=', 1)->where('approve', '=', 1)->where('execute', '=', 1)->get()); */

         $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('utilisateur.home', ['sellings' => $sellings],compact('non_execute',
                                             'non_approve', 'vente_non_declare',
                                             'users', 'products', 'count_ecart', 'nbUserNotApproved'));
    }
}
