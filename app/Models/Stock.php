<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'libelle', 'status', 'dateacquis', 'description'];

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
