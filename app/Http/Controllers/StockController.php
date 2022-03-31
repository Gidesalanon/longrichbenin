<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all()
        ->where('id', '>', 1)
        ->toArray();

        return view('stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock = Stock::all()
        ->where('id', '>', 1)
        ->toArray();
        $product = Product::all()->toArray();
        return view('stock.create', compact('stock', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stock::create([
            'libelle' => $request->libelle,
            'status' => $request->status,
            'dateacquis' => $request->dateacquis,
            'description' => $request->description,
        ]);

        return redirect()->back()->withMessage('Stock enregistré avec succès.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock_details = Stock::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $stock = Stock::findOrFail($stock->id);
        return view('stock.edit', compact('stock'));
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
        $stock = Stock::where('id', $id)->update([
            'libelle' => $request->libelle,
            'status' => $request->status,
            'dateacquis' => $request->dateacquis,
            'description' => $request->description,
        ]);

        return redirect()->route('stocks.index')->withMessage('Stock modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::where('id', $id)->delete();

        return redirect()->route('stocks.index')->withMessage('Stock supprimé avec succès.');
    }
}
