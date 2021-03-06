<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nomprod', 'nbpv', 'prixpartenaire', 'prixclient','qte', 'image', 'status', 'description', 'categorie_id', 'stock_id'];

    public function stocks()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function orders()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function ordergroups()
    {
        return $this->belongsTo('App\Models\Ordergroup');
    }

    public function sellings()
    {
        return $this->hasOne('App\Models\Selling');
    }

    public function inputProducts()
    {
        return $this->hasOne('App\Models\InputProduct');
    }

    public function outputProducts()
    {
        return $this->hasOne('App\Models\OutputProduct');
    }
}
