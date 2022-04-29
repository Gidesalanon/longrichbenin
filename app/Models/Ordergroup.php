<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordergroup extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'close'];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
