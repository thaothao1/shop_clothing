
<!DOCTYPE html>
<head>
	<title>Đăng ký tài khoản</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="css/font.css" type="text/css"/>
	<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
	<div class="log-w3">
	<div class="w3layouts-main">
		<h2>Đăng kí</h2>
		<?php
			$message = Session::get('message_register');
			if($message){
				echo '<span class="text-alert">',$message.'</span>';
				$message = Session::put('message_register', null);
			}
		?>
		<form action="{{URL::to('/register-admin')}}" method="post">
		{{ csrf_field() }}
			<input type="text" class="ggg" name="txtName" placeholder="Name"/>
			<input type="email" class="ggg" name="txtEmail" placeholder="Địa chỉ Email"/>
			<input type="password" class="ggg" name="txtPassword" placeholder="Mật khẩu"/>
			<input type="password" class="ggg" name="txtVePassword" placeholder="Xạc nhận mật khẩu"/>
			<div class="clearfix"></div>
			<button type="submit" class="btn btn-default">Đăng kí</button>
		</form>
	</div>
	</div>
	<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
	<script src="{{asset('public/backend/js/scripts.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
