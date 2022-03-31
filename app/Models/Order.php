<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['qte', 'prix','ref_created', 'product_id', 'ordergroup_id', 'approve'];


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function ordergroups()
    {
        return $this->belongsTo('App\Models\Ordergroup');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
