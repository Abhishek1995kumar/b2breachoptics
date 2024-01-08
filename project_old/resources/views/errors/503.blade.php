<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coming Soon REACH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
<!--===============================================================================================-->
	<link href="{{ URL::asset('assets/errors/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link href="{{ URL::asset('assets/errors/vendor/animate/animate.css')}}" rel="stylesheet">
<!--===============================================================================================-->
	<link href="{{ URL::asset('assets/errors/vendor/select2/select2.min.css')}}" rel="stylesheet">
<!--===============================================================================================-->
	<link href="{{ URL::asset('assets/errors/css/util.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/errors/css/main.css')}}" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>
	
	<!--  -->
	<div class="simpleslide100">
		<div class="simpleslide100-item bg-img1" style="background-image: url('images/bg01.jpg');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('images/bg02.jpg');"></div>
	</div>

	<div class="flex-col-c-sb size1 overlay1">
		<!--  -->
		<div class="w-full flex-w flex-sb-m p-l-40 p-r-80 p-t-22 p-lr-15-sm">
			<div class="wrappic1 m-r-30 m-t-10 m-b-10">
                <a href="{{url('/')}}" ><img class="logo" src="{!! url('assets/images/logo') !!}/{{$settings[0]->logo}}" alt="LOGO"></a>
			</div>
		</div>

		<!--  -->
		<div class="flex-col-c-m p-l-15 p-r-15 p-t-40 p-b-150">
			<p class="l1-txt1 txt-center p-b-80 respon1">
				Under Construction
			</p>

			<div class="flex-w flex-c-m cd100">
			    <img style="height:300px; width: 600px;" class="logo" src="{!! url('assets/errors/images/construction.jpeg') !!}" alt="LOGO">
			</div>
		</div>
	</div>
</body>
</html>
</html>