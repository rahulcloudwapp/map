<?php 
$enddate = date("d.m.Y",strtotime($auction->lastbid_datetime));
$endtime = date("H:i",strtotime($auction->lastbid_datetime));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<title> Art Avenue </title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap');
		body{font-family: 'Ubuntu', sans-serif;}
	</style>
</head>
<body>

<div style="width: 800px; background: #f3f3f3; display: block; margin-left: auto; margin-right: auto; border: 1px solid #f3f3f3;" class="main_outer">
	<div style="width: 100%; padding: 25px 0px;">
		<img style="width: 180px; max-width: 140px; display: block; margin: auto;" src="{{ url('public/Front/images/new.png') }}">
	</div>
	<div style="width: 100%; padding: 50px 0px; background: #fff;">
		<div style="width: 100%; padding: 0px 20px; background: none;">
			<h3 style="margin: 0; text-align: center; font-weight: 600; font-size: 24px; color: #333;     margin-bottom: 30px;line-height: 35px; padding: 0 35px;"> IZSOLE SĀKUSIES / ТОРГИ ОТКРЫТЫ! / AUCTION STARTED! </h3>
			<section style="margin-bottom: 50px;">
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Izsoles noslēgšana <b>{{ $enddate }}</b> plkst. <b>{{ $endtime }}</b> pēc Latvijas laika joslas. </p>
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Antisnaipers + 10 minūtes (izsoles pagarināšana, līdera maiņas gadījumā) + Nepardoto lotu pagarināšana par 24 stundām. </p>
				<h5 style="margin-top: 22px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #5563d6; font-weight: 600;"> Komisija no pircēja + 15% no lotes galējas cenas </h5>
				<span style="display: block; margin-top: 10px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #000; font-weight: 600;"><a href="{{ url('/') }}">artavenueauction.com</a> </span>
			</section>
			<section style="margin-bottom: 50px;">
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Закрытие торгов <b>{{ $enddate }}</b> в <b>{{ $endtime }}</b> по Латвийскому времени; </p>
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Антиснайпер +10 минут (продление торгов при смене лидера); + Продление на 24 часа непроданных лотов; </p>
				<h5 style="margin-top: 22px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #5563d6; font-weight: 600;"> Комиссионные с Покупателя + 15% к Финальной цене лота </h5>
				<span style="display: block; margin-top: 10px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #000; font-weight: 600;"><a href="{{ url('/') }}">artavenueauction.com</a> </span>
			</section>
			<section style="margin-top: 50px;">
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Closure of trades on <b>{{ $enddate }}</b> at <b>{{ $endtime }}</b> Latvian time </p>
				<p style="margin-top: 0; margin-bottom: 5px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #555; font-weight: 400;"> Anti-sniper + 10minutes (extension of the trades after the change of leader) + Extension for 24 hours of the non-sold items </p>
				<h5 style="margin-top: 22px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #5563d6; font-weight: 600;"> Commissions from the Buyer + 15% to the Final price of the lot. </h5>
				<span style="display: block; margin-top: 10px; margin-bottom: 0px; text-align: center; font-size: 16px; padding: 0 30px; line-height: 25px; color: #000; font-weight: 600;"><a href="{{ url('/') }}">artavenueauction.com</a> </span>
			</section>

		</div>
	</div>
	<div style="width: 100%; background: #333; padding: 20px 0px;">
		<p style="margin: 0; text-align: center; color: #fff; letter-spacing: 1px;font-size: 14px;"> &copy; copyright | All rights reserved </p>
	</div>
</div>


</body>
</html>
