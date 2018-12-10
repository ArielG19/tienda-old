<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class ProductCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //activamos poniendolo en true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //agregamos nuestras validaciones
        return [
        //le decimos que como minimo 3caracteres, de la tabla products
        //cada vez que se ingrese un nombre debe de ser unico
            'name'     => 'required|min:3|unique:products,name',
            'price'    => 'required',
            'marks_id' => 'required|not_in:0',
        ];
    }
    //agregamos la funcion para retornar un mensaje propio en la validacion
    public function messages()
    {
        return 
        [
        'marks_id.not_in' => 'El campo marca es obligatorio',
        ];
    }
}
