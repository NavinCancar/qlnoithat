<!DOCTYPE html>
<head>
<title>Relax - Trang quản trị bán nội thất</title>
<link rel="shortcut icon" href="{{('public/frontend/img/logo1.png')}}" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<div style="background-color:white; border-top-left-radius: 90px;">
	<!--<h1 class="text-center" style="padding-top:10px">RELAX</h1>-->
	<img src="{{('public/frontend/img/logo4.png')}}" style="width:150px; padding-top:10px;padding-bottom:5px; margin-left:30%">
	<h2>Đăng nhập</h2>
	</div>
	
		<form action="{{URL::to('/admin-dashboard')}}" method="post">
			{{csrf_field()}}
			<input type="text" class="ggg" name="admin_email" placeholder="Nhập email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Nhập password" required="">
	
			<h6><a href="#">Quên mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
		</form>
		<?php
		$message= Session::get('message');
		if($message){
			echo '<p style="color:red;">'. $message .'</p>';
			Session::put('message', null);
		}
		?>
</div>

</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
