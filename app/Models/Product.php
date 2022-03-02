<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nomprod', 'nbpv', 'prixpartenaire', 'prixclient','qte', 'image', 'description', 'categorie_id', 'stock_id'];

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
