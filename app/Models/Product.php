<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


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

    protected $fillable = ['name', 'price', 'description', 'image', 'stock', 'category_id'];

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
