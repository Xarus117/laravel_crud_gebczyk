<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    // ESPECIFICAR EL NOMBRE DE LA TABLA
    protected $table = "products"; 


    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
    ];
}
