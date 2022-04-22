<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'nom',
        'prenom',
        'email',
        'adresse',
        'tel',
        'status',
        'password',
        'is_admin',
        'is_magasinier',
        'isban',
        'enterprise_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function enterprise()
    {
        return $this->belongsTo('App\Models\Enterprise');
    }

    public function orders()
    {
        return $this->belongsTo('App\Models\Order');
    }  
    
    public function ordergroups()
    {
        return $this->hasMany('App\Models\Ordergroup');
    }   
    
    public function parents()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    public function allChildren()
    {
        return $this->children()->with('children');
    }
    public function allParents()
    {
        return $this->parents()->with('children', 'parents');
    }

    }
}
