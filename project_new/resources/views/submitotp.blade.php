@extends('includes.newmaster', ['normalHeader' => true])
@section('content')
<style>
	<style>
    *{
        padding:0;
        margin:0;
        box-sizing:border-box;
        font-family:sans-serif;
    }
    .container1{
        max-width:700px;
        background: rgba(0,0,0,0.5);
        padding:28px;
        margin: 0 28px;
        border-radius: 10px;
        box-shadow:inset -2px 2px 2px white;
    }
    .wrapper{
        display: flex;
        justify-content: right;
        padding-bottom: 95px;
        padding-top: 95px;
        background-image:url("{{url('assets/images/test_c.jpg')}}");
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;
    }
	.text-center{
        font-size:26px;
        font-weight:600;
        text-align:center;
        padding-bottom:6px;
        color:white;
        text-shadow:2px 2px 2px black;
        border-bottom:solid 1px white;
    }
	.wrapper .otp_input input{
		width:9%;
		height:32px;
		text-align:center;
		font-size: 24px;
		font-weight:600;
	}
	.txt{
		color:black;
	}
</style>
<div class="wrapper">
    <div class="container1">
		<div class="text-center">
			<h1 class="text-center" style="text-transform: uppercase;">Authentication Required</h1>
			<h4 style="text-transform: uppercase;">Two Step Verification</h4>
			<h4 style="text-transform: uppercase;">Enter The Verification Code We Sent To</h4>
			<h4>THIS EMAIL ID :- <?php print_r($_GET['email']); ?></h4>
			<h6></h6>
			<small></small>
			<form class="form-inline" action="{{route('checkOTP')}}" method="post">
				{{ csrf_field() }}
				<div class="otp_input text-start mb-2">
					<label style="font-size: 10px;">Type Your 4 Digit Security Code</label>
					<div class="d-flex align-items-center justify-content-between mt-2">
						<input type="text" name="otp1" class="txt"  maxlength="1">
						<input type="text" name="otp2" class="txt" maxlength="1">
						<input type="text" name="otp3" class="txt" maxlength="1">
						<input type="text" name="otp4" class="txt" maxlength="1">
					</div>
				</div>
				<div style="display: flex;justify-content: center;padding-top: 11px;">
				    <button type="submit" class="btn btn-primary submit_btn my-4" style="color:whit; width:15% "  >Submit</button>
		        </div>
		</form>
	</div>
	</div>
</div>
<script>
    const inputs = document.querySelectorAll('.d-flex input');
    
    inputs.forEach((input, index) => {
      input.dataset.index = index;
      input.addEventListener('paste', handleOtppaste);
      input.addEventListener('keyup', handleOtp);
    });
    
    function handleOtppaste(e) {
      const data = e.clipboardData.getData('text');
      const value = data.split('');
      if (value.length === inputs.length) {
        inputs.forEach((input, index) => (input.value = value[index]));
        submit();
      }
    }
    
    function handleOtp(e) {
      const input = e.target;
      const value = input.value;
      input.value = '';
      input.value = value ? value[0] : '';
      const fieldIndex = parseInt(input.dataset.index);
      if (value.length > 0 && fieldIndex < inputs.length - 1) {
        inputs[fieldIndex + 1].focus();
      }
      if (e.key === 'Backspace' && fieldIndex > 0) {
        inputs[fieldIndex - 1].focus();
      }
      if (fieldIndex === inputs.length - 1 && value.length > 0) {
        submit();
      }
    }
    
    function submit() {
    }
</script>
	
@stop

@section('footer')

@stop