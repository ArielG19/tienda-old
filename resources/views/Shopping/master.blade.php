@extends('layouts.app')
@section('content')

    @if(Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div id="charge-message" class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
    </div>
    
    @endif
	@foreach($products->chunk(3) as $productchunk)
    <div class="row">
    @foreach($productchunk as $product)
    	<div class="col-sm-4 col-md-3">
    		<div class="thumbnail">
    			<img class="img-responsive" src="/subidas/{{$product->image}}" 
				style="display:block;width: 100%;height:300px;background-position: center;background-repeat: non-repeat;background-size: cover;" alt="...">
    			<div class="caption">
    				<h3>{{$product->name}}</h3>
    				<p class="descrption">{{$product->description}}</p>
    				<div class="clearfix">
    				<div class="pull-left price">{{$product->price}}</div>
    				<a href="{{route('product.addToCart',['id'=>$product->id])}}" class="btn btn-primary pull-right" 
    				role="button">add cart</a></div>
    			</div>
    		</div>
    	</div>
    	@endforeach
    </div>
    @endforeach
@endsection