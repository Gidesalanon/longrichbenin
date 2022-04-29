<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\Enterprise;
use App\Models\Selling;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('isban', '>', 0)->get();
        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        $enterprises = Enterprise::where('id', '>', 1)->get();

        return view('approvUser.users', compact('users', 'nbUserNotApproved', 'enterprises'));
    }

    public function create(){

    }

    public function edit(Request $request, $user_id)
    {
         $user = User::findOrFail($user_id);
            $user->update([
                'isban' => 0,
                'enterprise_id' => $request->enterprise_id
            ]);

        toastr()->success('Utilisateur approuvé avec succès', 'Succès');
        return redirect()->route('users.index');
    }

    public function show(){

    }

    public function destroy($user_id)
    {
        User::where('id', $user_id)->delete();
        toastr()->success('Utilisateur supprimé avec succès', 'Succès');
        return redirect()->route('users.index');
    }

    public function administration()
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

        $non_execute = count(Order::whereDay('created_at', today()->day)->where('execute', '=', 0)->where('approve', '=', 1)->get());
        $execute = count(Order::whereDay('created_at', today()->day)->where('execute', '=', 1)->where('approve', '=', 1)->get());

        $non_approve = count(Order::whereDay('created_at', today()->day)->where('approve', '=', 0)->get());
        $approve = count(Order::whereDay('created_at', today()->day)->where('approve', '=', 1)->get());

        $vente_non_declare= count(Order::whereDay('created_at', today()->day)->where('status', '=', 0)->where('approve', '=', 1)->where('execute', '=', 1)->get());
        $vente_declare = count(Order::whereDay('created_at', today()->day)->where('status', '=', 1)->where('approve', '=', 1)->where('execute', '=', 1)->get());

        return view('admin', ['sellings' => $sellings],compact('non_execute', 'execute',
                                             'non_approve', 'approve',
                                             'vente_non_declare', 'vente_declare',
                                             'users', 'products'));
    }
}
