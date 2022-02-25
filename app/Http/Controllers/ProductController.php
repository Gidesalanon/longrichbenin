<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->join('categories', 'categories.id', 'products.categorie_id')
        ->select('products.*', 'categories.libelle AS nom_categorie')
        ->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->toArray();
        return view('product.create', compact( 'categories'));
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
            'status' => $request->status,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->back()->withMessage('Produit enregistré avec succès.');

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
        $product = Product::findOrFail($product->id);
        return view('product.edit', compact('product', 'categories'));
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
            'status' => $request->status,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('products.index')->withMessage('Produit modifié avec succès');
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

        return redirect()->route('products.index')->withMessage('Produit supprimé avec succès.');
    }
}
