@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header">
	<h1>Eliminar producto</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				Eliminar producto			
			</div>
				<div class="panel-body">
					<table class="table table-bordered">
					<!--llamamos al modelo-->
					<!--a la ruta le pasamos la variable products con el id-->
					<!--agregamos el metodo destroy para editar-->

					{!! Form::open(['route' => ['productos.destroy',$products->id],'method'=>'delete']) !!}
					<div class="form-group">
					<label for="">Deseas eliminar este producto</label>
    				</div>
    				<div class="for-group">
    					<!--pasamos la varible products y le indicamos el campo que queremos-->
    					{!!form::label('Producto:')!!}
    					{!!$products->name!!}
    				</div>
    				<div class="form-group">
    					{!!form::label('Precio:')!!}
						{!!$products->price!!}
    				</div>
  
    				<div class="form-group">
    					{!!form::submit('eliminar',['name'=>'guardar','id'=>'guardar','content'=>'<span>Eliminar</span>','class'=>'btn btn-warning btn-sm-mt-10'])!!}
    					<button type="button" id="cancelar" class="btn btn-default btn-sm-m-t-10">Cancelar</button>
    				</div>
					{!! Form::close() !!}
					</table>
				</div>
		
		</div>
		
	</div>
</div>
</div>
<script>
	$("#cancelar").click(function(event)
	{
		document.location.href= "{{ route('productos.index')}}";
	});
</script>
@endsection