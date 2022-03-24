<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enterprise;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enterprises = DB::table('enterprises')
        ->join('stocks', 'stocks.id', 'enterprises.stock_id')
        ->select('enterprises.*', 'stocks.libelle AS nom_stock')
        ->where('enterprises.id', '>', 1)
        ->get();
        return view('enterprise.index', compact('enterprises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprises = Enterprise::all()->toArray();
        $stocks = Stock::all()
        ->where('id', '>', 1)
        ->toArray();
        return view('enterprise.create', compact('enterprises', 'stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Enterprise::create([
            'stock_id' => $request->stock_id,
            'designation' => $request->designation,
            'adresse' => $request->adresse,
        ]);
        toastr()->success('Entreprise enregistrée avec succès.', 'Succès');
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
    public function edit(Enterprise $enterprise)
    {
        $enterprise = Enterprise::findOrFail($enterprise->id);
        $stocks = Stock::all()
        ->where('id', '>', 1)
        ->toArray();
        return view('enterprise.edit', compact('enterprise', 'stocks'));
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
        $enterprise = Enterprise::where('id', $id)->update([
            'designation' => $request->designation,
            'adresse' => $request->adresse,
            'stock_id' => $request->stock_id,
        ]);

        toastr()->success('Entreprise modifiée avec succès.', 'SUCCÈS');
        return redirect()->route('enterprises.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Enterprise::where('id', $id)->delete();

        toastr()->success('Entreprise supprimée avec succès.', 'SUCCÈS');
        return redirect()->route('enterprises.index');
    }
}
