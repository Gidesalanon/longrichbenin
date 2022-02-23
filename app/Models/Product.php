<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nomprod', 'nbpv', 'prixpartenaire', 'prixclient','qte', 'image', 'status', 'description', 'categorie_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
