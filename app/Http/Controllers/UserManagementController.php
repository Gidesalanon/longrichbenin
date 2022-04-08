<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enterprise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enterprises = Enterprise::with('users')
        ->where('id', '>', 1)
        ->get();
        $u = User::all();
        $count_user = count($u);
        $users = DB::table('users')
        ->join('enterprises', 'enterprises.id', 'users.enterprise_id')
        ->select('users.*', 'enterprises.designation AS enterprise', 'users.code', 'enterprises.id')
        ->where('is_admin', '<>', 1)
        ->get();



        return view('usermanagement.index', compact('users', 'enterprises', 'count_user', 'u'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprises = Enterprise::all()
        ->where('id', '>', 1)
        ->toArray();
        return view('usermanagement.create', compact('enterprises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'code' => $request->code,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'enterprise_id' => $request->enterprise_id,
            'tel' => $request->tel,
            'status' => '1',
            'is_admin' => '0',
            'password' => Hash::make($request->password),
        ]);
        toastr()->success('Utilisateur enregistré avec succès.', 'Succès');
        return redirect()->back();
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
    public function edit($user_id)
    {
        $enterprises = Enterprise::all()
        ->where('id', '>', 1)
        ->toArray();
        $user = User::findOrFail($user_id);
        return view('usermanagement.edit', compact('user', 'enterprises'));
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
        User::where('id', $id)->update([
            'code' => $request->code,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'enterprise_id' => $request->enterprise_id,
            'tel' => $request->tel,
            'status' => '1',
            'is_admin' => '0',
            'is_magasinier' => '0',
            'password' => Hash::make($request->password),
        ]);
        toastr()->success('Utilisateur modifié avec succès.', 'Succès');
        return redirect()->route('usermanagements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        User::where('id', $user_id)->delete();

        toastr()->success('Utilisateur supprimé avec succès.', 'Succès');
        return redirect()->route('usermanagements.index');
    }
    //control: desactivé user
    public function isNotBan($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['isban' => 1]);
        toastr()->success('Utilisateur Désactivé avec succès.', 'Succès');
        return redirect()->route('usermanagements.index');
    }
    //control: activé user
    public function isBan($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['isban' => 0]);
        toastr()->success('Utilisateur activé avec succès.', 'Succès');
        return redirect()->route('usermanagements.index');
    }
}
