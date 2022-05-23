<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;

    protected $fillable = ['designation', 'adresse', 'stock_id'];

    public function stock()
    {
        return $this->hasOne('App\Models\Stock');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}


