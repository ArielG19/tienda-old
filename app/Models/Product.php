<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $primarykey='id';

    protected $fillable=['id','name','price','description','image','marks_id'];

    //creamos una funcion para reacionar las tablas
    public function mark()
    {
    	// hasmany-tiene muchas
    	return $this->hasmany(Mark::class);
    }
}
