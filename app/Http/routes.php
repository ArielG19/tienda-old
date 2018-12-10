<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/product',[
   'uses'   => 'Controladores\ProductosController@producto',
   'as'		=> 'product.index'
   ]);

//Ruta para agregar productos al carito
//pasomos el id para agregar o reducir
Route::get('/add-to-cart/{id}',[
  'uses' => 'Controladores\ProductosController@addToCart',
  'as'   => 'product.addToCart'
]);

//Ruta para agregar productos al carito
Route::get('/reduce/{id}',[
  'uses'=>'Controladores\ProductosController@getReducebyOne',
  'as' =>'product.reduceByOne'
  ]);
Route::get('/remove/{id}',[
  'uses' => 'Controladores\ProductosController@getRemoveItem',
  'as'   => 'product.remove'
  ]);

Route::get('/shopping-cart',[
  'uses' => 'Controladores\ProductosController@getcart',
  'as'   => 'product.shoppingcart'
]);

Route::get('/checkout',[
  'uses' =>'Controladores\ProductosController@getcheckout',
  'as'   =>'checkout',
  'middleware' =>'auth'
  ]);

Route::post('/checkout',[
  'uses' =>'Controladores\ProductosController@postcheckout',
  'as'   =>'checkout',
  //12. agregamos middleware
  'middleware' =>'auth'
  ]);




Route::resource('/productos','Controladores\ProductController');
Route::get('/subidas/{imgproduct}',function($imgproduct=null)
{
  $url=public_path()."/subidas/{$imgproduct}";
  if (file_exists($url)) {
    return Response::download($url);
  }
});

Route::get('/profile','UserController@profile');
Route::post('/profile','UserController@update_avatar');

