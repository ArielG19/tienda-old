@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
                <h2>{{ $user->name}} Profile</h2>
                <img src="uploads/avatars/{{$user->avatar}}" style="width: 150px; height: 150px; float: left;border-radius: 50%; margin-right: 25px;">
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label for="">Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{csrf_token ()}}">
                    <br>                   
                    <input type="submit" value="Actualizar" class="pull-left btn btn-sm btn-primary">
                </form>      
        </div>

        <div class="col-md-6 col-md-offset-1">
                <h2>My Orders</h2>
                     @foreach($orders as $order)
                      <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach($order->cart->items as $item)
                                    <li class="list-group-item">
                                            <span class="badge">${{ $item['price']}}</span>
                                        {{ $item['item']['name']}} | {{ $item['qty']}} units   
                                    </li>
                                    @endforeach
                                </ul>
                             </div>
                             <div class="panel-footer">
                                 <strong>Total Price: ${{$order->cart->totalprice}}</strong>
                             </div>
                      </div>
                     @endforeach
        </div>   
     </div>
</div>
@endsection
