<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Ordergroup;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with('products')
        ->where('id', '>', 1)
        ->get();
        $p = Product::all();
        $count_product = count($p);

        $categories = Category::all();

        $products = DB::table('products')
        ->join('categories', 'categories.id', 'products.categorie_id')
        ->join('stocks', 'stocks.id', 'products.stock_id')
        ->select('products.*', 'categories.libelle AS nom_categorie', 'stocks.libelle AS nom_stock')
        ->orderBy('stock_id', 'asc')->get();

        return view('product.index', compact('products', 'stocks', 'categories', 'count_product', 'p'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->toArray();
        $products = Product::all()->toArray();
        $stocks = Stock::all()
        ->where('id', '>', 1)
        ->toArray();
        return view('product.create', compact( 'categories', 'stocks', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if ($file != null) {
            $image = $file->getClientOriginalExtension();
            $nomprod = str_replace(' ', '_', $request->get('nomprod'));
            $name = $nomprod . '.' . $image;
            $file->move(public_path() . '/imgProd', $name);
        } else {
            $name = null;
        }

        Product::create([
            'nomprod' => $request->nomprod,
            'nbpv' => $request->nbpv,
            'prixpartenaire' => $request->prixpartenaire,
            'prixclient' => $request->prixclient,
            'prixclient' => $request->prixclient,
            'qte' => $request->qte,
            'image' => $name,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'stock_id' => $request->stock_id,

        ]);
        toastr()->success('Produit enregistré avec succès.', 'PRODUIT');
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
        $product_details = Product::find($id);
        return view('product.edit',compact('product_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->toArray();
        $stocks = Stock::all()
        ->where('id', '>', 1)
        ->toArray();
        $product = Product::findOrFail($product->id);
        return view('product.edit', compact('product', 'categories', 'stocks'));
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
        $file = $request->file('image');
        if ($file != null) {
            $image = $file->getClientOriginalExtension();
            $nomprod = str_replace(' ', '_', $request->get('nomprod'));
            $name = $nomprod . '.' . $image;
            $file->move(public_path() . '/imgProd', $name);
        } else {
            $name = null;
        }

        Product::where('id', $id)->update([
            'nomprod' => $request->nomprod,
            'nbpv' => $request->nbpv,
            'prixpartenaire' => $request->prixpartenaire,
            'prixclient' => $request->prixclient,
            'prixclient' => $request->prixclient,
            'qte' => $request->qte,
            'image' => $name,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'stock_id' => $request->stock_id,
        ]);
        toastr()->success('Produit modifié avec succès.', 'PRODUIT');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        toastr()->success('Produit supprimé avec succès.', 'PRODUIT');
        return redirect()->route('products.index');
    }
}
