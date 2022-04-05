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
        $users = User::where('isban', '>', 0)->get();
        $nbUserNotApproved = User::where('isban', '>', 0)->count();
        return view('users', compact('users', 'nbUserNotApproved'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['isban' => 0]);
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

}
