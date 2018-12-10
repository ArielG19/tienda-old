<?php

namespace App\Http\Controllers\Controladores;

use Illuminate\Http\Request;

use App\Http\Requests;
//Llamamos a nuestro request
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Mark;
use Storage;
use File;
//para crear los msj flash
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cuando no llamamos a la libreria App 
        //$products = \App\Models\Product
        
        $products = Product::select
        ('products.id','products.name as product','price','marks.name as mark')
        ->join('marks','marks.id','=','products.marks_id')->paginate(2);
        //agregamos paginate, en vez de get
        return view('productos/index')->with('products',$products);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //creamos la variable $marks para llenar el combo
        $marks=Mark::lists('name','id')->prepend('Seleccione la marca');
        return view('productos/create')->with('marks',$marks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //agregamos nuestro request
    //public function store(Request $request)
    public function store(ProductCreateRequest $request)
    {
        $imagen = $request->file('imagen');
        //obtenemos el nombre original de la imagen
        //obtenemos creamos un nombre unico de imagen o extencion
        //almacenimg para guardar el nuevo nombre
        $imgproduct = time().".".$imagen->getClientOriginalExtension();
        //hacemos uso de la clase storage
        //le pasomos como parametro al disk el nombre el cual vamos a trabajar
        //asignamos el metodo put para guardar y este recibe dos parametros
        //$imagen contiene un archivo temporal
        storage::disk('imagen')->put($imgproduct,File::get($imagen));
        $product = new Product($request->all());
        //pasamos la variable imgmedicamento que es la que contiene la imagen
        //imagen campo de la tabla
        $product->image=$imgproduct;
        $product->save();
        //return $almacenimag;
        //Medicamento::create($request->all());

        Session::flash('save','Se ha creado correctamente');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //FindOrfail produce un error no encuentra el modelo
        $products=Product::FindOrFail($id);
        return view('productos.show')->with('products',$products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Llenamos el combo
        $marks=Mark::lists('name','id')->prepend('Seleccione la marca');
        $products=Product::FindOrFail($id);
        return view ('productos.edit',array('products'=>$products,'marks'=>$marks));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        //actualiza todos los datos dentro del fill
        $products=Product::FindOrFail($id);
        $input=$request->all();
        $products->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $products=Product::FindOrFail($id);
        $products->delete();
        Session::flash('delete','Se ha eliminado');
        return redirect()->route('productos.index');
    }
}
