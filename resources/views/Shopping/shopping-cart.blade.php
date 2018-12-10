@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
            <ul class="list-group">
            @foreach($products as $product)
                <li class="list-group-item">
                    <span class="badge">{{$product['qty']}}</span>
                    <strong>Nombre: {{$product['item']['name']}}</strong>
                    <strong></strong>
                    <h4><span class="label label-success"> Precio: ${{$product['price']}}</span></h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">
                            acción
                         <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('product.reduceByOne',['id'=> $product['item']['id']])}}">Reducir por 1</a>
                            </li>
                            <li>
                                <a href="{{route('product.remove',['id'=> $product['item']['id']])}}">Reducir todos</a>
                            </li>
                        </ul>
                    </div>
                </li>
             @endforeach   
            </ul> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
                <strong> <h4><b>Total: ${{$totalprice}}</b></h4></strong>
            </div>

            <div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
                
            <a href="{{route('checkout')}}" type="button" class="btn btn-success">checkout</a>
            </div>
            @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
                     <h2>No item in cart</h2>
                </div>
            </div>
            
        </div>
    @endif    
@endsection