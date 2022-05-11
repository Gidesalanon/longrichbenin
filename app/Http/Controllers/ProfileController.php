<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Selling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::all()
            ->where('id', '=', Auth::user()->id);

        $count_sellings = count(Selling::all()->where('user_id', '=', Auth::user()->id));
        $sum_pv= Selling::where('user_id', Auth::user()->id)->sum('pv');
        $sum_benefice= Selling::where('user_id', Auth::user()->id)->where('ecart', 0)->sum('benefice');

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('profile.index', compact('profiles', 'count_sellings','sum_pv',
        'sum_benefice', 'count_ecart', 'nbUserNotApproved'));
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

    public function edit()
    {

    }

    public function editDetail()
    {
        $users = User::all()->where('id', Auth::user()->id);

        $nbUserNotApproved = User::where('isban', '>', 0)->count();
        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('profile.detail', compact('users', 'nbUserNotApproved', 'count_ecart'));
    }

    public function updateDetail(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'tel' => $request->tel,
                'adresse' => $request->adresse,
        ]);
        toastr()->success('Vos détails personnels ont été modifiés avec succès', 'Succès');
        return redirect()->route('profiles.index');
    }

    public function editPassword()
    {
        $users = User::all()->where('id', Auth::user()->id);

        $nbUserNotApproved = User::where('isban', '>', 0)->count();
        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('profile.password', compact('users', 'nbUserNotApproved', 'count_ecart'));
    }

    public function updatePassword(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->password),
        ]);
        toastr()->success('Votre mot de passe a été modifié avec succès', 'Succès');
        return redirect()->route('profiles.index');
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
