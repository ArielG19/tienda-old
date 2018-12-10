<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $table='marks';
    protected $primarykey='id';

    protected $fillable=['id','name'];

    public function product()
   {
   	//belonsgto pertence a
   	return $this->belonsgto(Product::class);
   }
}
