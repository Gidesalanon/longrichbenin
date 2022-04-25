<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;
    protected $fillable = ['qte_vendu', 'ca', 'srd', 'vs', 'ecart', 'status', 'order_id', 'user_id', 'product_id'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orders()
    {
        return $this->hasOne('App\Models\Order');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Selling');
    }
}
