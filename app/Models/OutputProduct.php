<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputProduct extends Model
{
    use HasFactory;

    protected $fillable = ['output_qty', 'prev_value', 'product_id'];

    public function products()
    {
        return $this->hasOne('App\Models\Product');
    }
}
