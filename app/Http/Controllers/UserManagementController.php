<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enterprise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Selling;
use Illuminate\Support\Facades\Auth;
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('usermanagement.index', compact('users', 'enterprises',
        'count_user', 'u', 'count_ecart', 'nbUserNotApproved'));
    }

    public function network()
    {
        $enterprises = Enterprise::with('users')
        ->where('id', '>', 1)
        ->get();

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        $load = ['allChildren'];

        $users_list = User::with($load)
                //  ->filter($request->all())
               //  ->where('deleted',null)
               //  ->orwhere('deleted','0')
                 ->orderByDesc('created_at')
                //  ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                //  ->paginate(request('per_page', 15))
                ->get(['code AS name', 'nom AS title', 'email AS description','users.*']);
            $x = 0;
            for($i = 0; $i < count($users_list) ; $i++){
                if(!$users_list[$i]->parents) {
                    $users[$x] = ($users_list[$i]);
                    $users[$x]->children = $users[$x]->allChildren;
                    unset($users[$x]->allChildren);
                    unset($users[$x]->parents);
                    $x++;
                }
            }
            $users = $users[0];
//             echo '<pre>';
// echo json_encode($users);die;
            return view('usermanagement.treeview', compact('users', 'enterprises',
            'count_ecart', 'nbUserNotApproved'));
    }


    function buildTreeView($arr,$parent,$level = 0,$prelevel = -1){
        foreach($arr as $id=>$data){
            if($parent==$data['parent_id']){
                if($level>$prelevel){
                    echo "<ol>";
                }
                if($level==$prelevel){
                    echo "</li>";
                }
                echo "<li>".$data['city'];
                if($level>$prelevel){
                    $prelevel=$level;
                }
                $level++;
                buildTreeView($arr,$id,$level,$prelevel);
                $level--;
            }
        }
        if($level==$prelevel){
            echo "</li></ol>";
        }
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('usermanagement.create', compact('enterprises', 'count_ecart', 'nbUserNotApproved'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'string|required|unique:users',
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'email' => 'email|required|unique:users',
            'adresse' => 'string|required',
            'enterprise_id' => 'required',
            'tel' => 'integer|required',
            'password' => 'required|min:8',
        ]);

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
        toastr()->success('Utilisateur enregistr?? avec succ??s.', 'Succ??s');
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        $nbUserNotApproved = User::where('isban', '>', 0)->count();

        return view('usermanagement.edit', compact('user', 'enterprises',
        'count_ecart', 'nbUserNotApproved'));
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
        $this->validate($request, [
            'code' => 'string|required',
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'email' => 'email|required',
            'adresse' => 'string|required',
            'enterprise_id' => 'required',
            'tel' => 'integer|required',
            'status' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

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
        toastr()->success('Utilisateur modifi?? avec succ??s.', 'Succ??s');
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

        toastr()->success('Utilisateur supprim?? avec succ??s.', 'Succ??s');
        return redirect()->route('usermanagements.index');
    }
    //control: desactiv?? user
    public function isNotBan($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['isban' => 1]);
        toastr()->success('Utilisateur D??sactiv?? avec succ??s.', 'Succ??s');
        return redirect()->route('usermanagements.index');
    }
    //control: activ?? user
    public function isBan($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['isban' => 0]);
        toastr()->success('Utilisateur activ?? avec succ??s.', 'Succ??s');
        return redirect()->route('usermanagements.index');
    }
}
