<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Ordergroup;
use App\Models\InputProduct;
use App\Models\OutputProduct;
use App\Models\Selling;
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('product.index', compact('products',
        'stocks', 'categories',
        'count_product', 'p', 'count_ecart'));
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('product.create', compact( 'categories', 'stocks',
         'products', 'count_ecart'));
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
            'status' => $request->status,
            'categorie_id' => $request->categorie_id,
            'stock_id' => $request->stock_id,

        ]);
        toastr()->success('Produit enregistré avec succès.', 'PRODUIT');
        return redirect()->route('products.index');

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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('product.edit',compact('product_details', 'count_ecart'));
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

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));
        return view('product.edit', compact('product', 'categories', 'stocks', 'count_ecart'));
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

    //ajouter du produit en stock
    public function addStock(Request $request, $id)
    {
         $product = Product::findOrFail($id);
            $product->update([
                'qte' => $request->qte + $product->qte
            ]);

        InputProduct::create([
            'newqty' => $request->qte,
            'prev_value' => $product->qte - $request->qte,
            'product_id' => $product->id,
        ])->id;

        toastr()->success('Nouveau Stock Ajouté avec succès', 'Succès');
        return redirect()->route('products.index');
    }

    //afficher les entrées en stock dans la vue inputProduct

    public function inputProduct()
    {
        /*$count_input = (inputProduct::all());
         $inputproducts = inputProduct::find($id);
        $inputproducts = inputProduct::where('product_id', $id)->pluck('id');*/

        $inputs = InputProduct::all();

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('product.inputProduct', compact( 'inputs', 'products', 'count_ecart'));
    }

    //afficher les sorties en stock dans la vue outputProduct
    public function outputProduct()
    {
        $outputs = OutputProduct::all();

        $products = Product::all();
        $p = Product::all();
                foreach($p as $product) :
                    $products[$product->id] = $product->nomprod;
                endforeach;

        $count_ecart = count(Selling::all()
            ->where('user_id', Auth::user()->id)
            ->where('ecart', '>', 0));

        return view('product.outputProduct', compact( 'outputs', 'products', 'count_ecart'));
    }
}
