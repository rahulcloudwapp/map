<!DOCTYPE html>
<html lang="en">
<head>
  	<title> News </title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap');
		body{font-family: 'Ubuntu', sans-serif;}
	</style>
</head>
<body>

<div style="width: 600px; background: #f3f3f3; display: block; margin-left: auto; margin-right: auto; border: 1px solid #f3f3f3;" class="main_outer">
	<div style="width: 100%; padding: 25px 0px;">
		<img style="width: 180px; max-width: 140px; display: block; margin: auto;" src="{{ url('public/Front/images/new.png') }}">
	</div>
	<div style="width: 100%; padding: 50px 0px; background: #fff;">
		<div style="width: 100%; padding: 0px 20px; background: none;">
			<h3 style="margin: 0; text-align: center; font-weight: 600; font-size: 24px; color: #333;     margin-bottom: 30px;line-height: 35px; padding: 0 35px;"> Welcome to News</h3>
			
			<section style="margin-top: 50px;">
				<h5 style="margin-top: 0; margin-bottom: 10px; text-align: left; font-size: 19px; padding: 0 30px; line-height: 25px; color: #000; font-weight: 500;"> Hello {{ $user->name }}, </h5>
				<p style="margin-top: 0; margin-bottom: 5px; text-align: left; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Password to login : <b>{{ $password }}</b></a> </p>
				
			</section>

		</div>
	</div>
	<div style="width: 100%; background: #333; padding: 20px 0px;">
		<p style="margin: 0; text-align: center; color: #fff; letter-spacing: 1px;font-size: 14px;"> &copy; copyright | All rights reserved </p>
	</div>
</div>


</body>
</html>








