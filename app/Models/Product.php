<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function lines()
    {
        return $this->hasMany(Line::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'stock'
    ];
}
