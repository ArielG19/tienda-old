<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class ProductUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // creamos un contructor para recuperar el codigo de producto y usarlo
    //pasamos la ruta despues de impoetarla
    public function __construct(Route $route)
    {
     $this->route=$route;
    }
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        //le decimos que como minimo 3 caracteres, de la tabla products
        //cada vez que se ingrese un nombre debe de ser unico
        //capturamos el codigo con el route
            'name'     => 'required|min:3|unique:products,name'.$this->route->getparameter('product'),
            'price'    => 'required',
            'marks_id' => 'required|not_in:0',
        ];
    }
    public function messages()
    {
        return 
        [
        'marks_id.not_in' => 'El campo marca es obligatorio',
        ];
    }
}
