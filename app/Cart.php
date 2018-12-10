<?php

namespace App;
//1.Creamos la clase Cart
//Una clase puede tener sus propias constantes, variables (llamadas "propiedades"), 
//y funciones (llamados "métodos").
class Cart
{
    
    public $items = null;
    public $totalQty = 0;
    public $totalprice = 0;

//2. creamos un constructor
    //$this hace referencia al objeto que se está construyendo
    //con $this asignamos a item el objeto que se esta construyendo.
    public function __construct($oldCart)
    {
        if($oldCart)
        {
          $this->items = $oldCart->items;
          $this->totalQty = $oldCart->totalQty;
          $this->totalprice = $oldCart->totalprice;
        }
    }

    public function add($item, $id)
    {
                $storedItem = ['qty' => 0,'price' => $item->price,'item' => $item];
                if($this->items){

                               if(array_key_exists($id, $this->items)){
                                $storedItem = $this->items[$id];
                                }
                               } 
                                $storedItem  ['qty']++;
                                $storedItem  ['price'] = $item->price * $storedItem['qty'];
                                $this->items [$id] = $storedItem;
                                $this->totalQty ++;
                                $this->totalprice += $item->price;
                                
    }
    public function reduceByOne ($id){
        $this->items[$id] ['qty']--;
        $this->items[$id] ['price'] -= $this->items[$id] ['item'] ['price'];
        $this->totalQty--;
        $this->totalprice -= $this->items[$id] ['item']['price'];

        //creamos una condicion para cuando reducimos no sea -1,etc.
        //unset — Destruye una variable especificada
        if ($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }

    public function removeItem($id){
        $this->totalQty-= $this->items[$id]['qty'];
        $this->totalprice -= $this->items[$id]['price'];
        unset($this->items[$id]);

    }
    

    

}
