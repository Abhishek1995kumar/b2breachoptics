@extends('includes.newmaster', ['normalHeader' => true])
@section('content')

<div class="container">

	<div class="text-center">
		<h1 class="text-center">Authentication required</h1>
		<small>We’ve sent a One Time Password (OTP) to the registered mobile number. Please enter it to complete verification</small>
		<form class="form-inline" action="{{route('checkOTPWithCheckout')}}" method="post">
			{{ csrf_field() }}
				<div class="form-group">
					  <label class="mr-sm-2">Enter Otp:</label>
				  <input type="number" name="otp" class="form-control mb-2 mr-sm-2" placeholder="Enter Otp">
				</div>
				
				<div class="form-group">
					 <button type="submit" class="btn btn-primary mb-2">Submit</button>
				</div>
			 
		</form>
	</div>
	
</div>
<br>

@stop

@section('footer')

@stop