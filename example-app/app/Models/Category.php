<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

       // ESPECIFICAR EL NOMBRE DE LA TABLA
       protected $table = "categories"; 


       protected $fillable = [
           'name',
           'description',
       ];
}
