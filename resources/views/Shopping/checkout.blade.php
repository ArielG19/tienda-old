@extends('layouts.app')
@section('title')
	Laravel shopping-cart
@endsection
@section('content')
	<div class="row">
		<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
			<h1>Checkout</h1>
			<h4>Your total: ${{$total}}</h4>
			<div id="charge-error" class="alert alert-danger{{!Session::has('error') ? 'hidden' : ''}}">

			 	{{Session::get('error')}}

			</div>
			<form action="{{route('checkout')}}" method="post" id="checkout-form">

				<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="name">Name</label>
								<!--agregamos name="" despues de crear el modelo order -->
								<input type="text" id="name" class="form-control" name="name" required>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label for="address">Adress</label>
								<!--agregamos name="" despues de crear el modelo order -->
								<input type="text" id="address" class="form-control" name="address" required>
							</div>
						</div>
						

						<div class="col-xs-12">
							<div class="form-group">
								<label for="card-name">Card holder name</label>
								<input type="text" id="card-name" class="form-control" required>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label for="card-number">Credit card number</label>
								<input type="text" id="card-number" class="form-control" required>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label for="card-expiry-month">Expiration month</label>
										<input type="text" id="card-expiry-month" class="form-control" required>
									</div>
								</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="card-expiry-year">Expiration year</label>
											<input type="text" id="card-expiry-year" class="form-control" required>
										</div>
									</div>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label for="card-cvc">CVC</label>
								<input type="text" id="card-cvc" class="form-control" required>
							</div>
						</div>
						{{csrf_field()}}
						<button type="submit" class="btn btn-success">Buy now</button>

				</div>
			
			</form>
			
		</div>
		
	</div>
@endsection
@section('script')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ URL::to('src/js/checkout.js') }}"></script>
@endsection
