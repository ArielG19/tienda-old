@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header">
	<h1>Editar producto</h1>
</div>
<div class="row">
	<div class="col-md-8">
	@include('partials.messages')
		<div class="panel panel-default">
			<div class="panel-heading">
				Editar producto			
			</div>
				<div class="panel-body">
					<table class="table table-bordered">
					<!--llamamos al modelo-->
					<!--a la ruta le pasamos la variable products con el id-->
					<!--agregamos el metodo put para editar-->

					{!! Form::model($products,['route' => ['productos.update',$products->id],'method'=>'put']) !!}
					<div class="form-group">
					{!!form::label('Nombre:')!!}
					{!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Escriba el nombre del producto'])!!}
    				</div>
    				<div class="for-group">
    				
    					{!!form::label('Precio:')!!}
    					{!!form::text('price',null,['id'=>'price','class'=>'form-control','placeholder'=>'Escriba el precio'])!!}
    				</div>
    				<div class="form-group">
    					{!!form::label('Marca:')!!}
    					<br>
    					{!!form::select('marks_id',$marks,null,['id'=>'marks_id','class'=>'form-control'])!!}
    				</div>
  
    				<div class="form-group">
    					{!!form::submit('Guardar',['name'=>'guardar','id'=>'guardar','content'=>'<span>Guardar</span>','class'=>'btn btn-warning btn-sm-mt-10'])!!}
    				</div>
					{!! Form::close() !!}
					</table>
				</div>
		
		</div>
		
	</div>
</div>
</div>
@endsection