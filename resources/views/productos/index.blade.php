@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header">
	<h1>Actualizados hasta hoy</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary">
		@include('partials.messages')
			<div class="panel-heading">
				Listas
				<p class="navbar-text navbar-right" style="margin-top: 1px;">
					<button type="button" id="nuevoo" name="nuevo" class="btn btn-warning navbar-btn" style="margin-bottom: : 1px; margin-top: -5px;margin-right: 8px; padding: 3px 20px;">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
				</p>
			</div>
				<div class="panel-body">
					<table class="table table-bordered">
					<thead>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Marca</th>
						<th></th>
						
					</thead>
					<tbody>
						@foreach($products as $product)
						
					<tr>
						<td>{{$product->product}}</td>
						<td>{{$product->price}}</td>
						<td>{{$product->mark}}</td>

						<td>
						<!--en la ruta pasamos el parametro para mostrar el id y poder editar o eliminar luego-->
						<a href="{{route('productos.edit',$product->id)}}" style ="margin-right: 8px;">
						     <i class="fa fa-pencil-square-o" aria-hidden="true">  Editar</i></a>

						<a href="{{route('productos.show',$product->id)}}">
						     <i class="fa fa-times" aria-hidden="true"></i>  Eliminar</a>
						</td>

					</tr>
					@endforeach
					</tbody>
					</table>
					<div class="text-center">
						<!--tambien podemos usar render en vez de links-->
						{!!$products->links()!!}
					</div>
				</div>
		
		</div>
		
	</div>
</div>
</div>

<!--Script para programar btn nuevos-->
<script>
	$("#nuevoo").click(function(event)
	{
		document.location.href= "{{ route('productos.create')}}";
	});
</script>

@endsection
