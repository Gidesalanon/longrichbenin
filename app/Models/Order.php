<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'date_validation', 'description', 'product_id'];


    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}