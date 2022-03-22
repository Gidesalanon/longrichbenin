<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['qte', 'prix','ref_created', 'product_id', 'user_id', 'approve'];


    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
