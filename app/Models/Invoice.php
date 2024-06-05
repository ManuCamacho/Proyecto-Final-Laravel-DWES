<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_invoice',
        'date',
        'total_amount', 
    ];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function lines()
    {
        return $this->hasMany(Line::class, 'id_invoice'); 
    }
}
