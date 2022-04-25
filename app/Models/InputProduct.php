<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputProduct extends Model
{
    use HasFactory;
    protected $fillable = ['newqty', 'product_id', 'prev_value'];
}
