<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Ma statistique </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{asset('css_admin/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{asset('css_admin/style.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="{{asset('css_admin/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
 <!-- js-->
<script src="{{asset('js_admin/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js_admin/modernizr.custom.js')}}"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<!--animate-->
<link href="{{asset('css_admin/animate.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{asset('js_admin/wow.min.js')}}"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="{{asset('js_admin/metisMenu.min.js')}}"></script>
<script src="{{asset('js_admin/custom.js')}}"></script>
<link href="{{asset('css_admin/custom.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
		@include('layouts.menu')
        @include('layouts.header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
            <span class="col-md-10">
                <h3 class="title1">Ma Statistique </h3>
            </span>
            <div class="main-page compose">
				<!-- <div class="col-md-4 compose-left">
					<div class="folder widget-shadow">
						<ul>
							<li class="head">Nos Agents Commerciaux </li>
							<li><a href="#">
									<div class="chat-left">
										<img class="img-circle" src="{{asset('images_admin/a.png')}}" style="width:34px; height:34px;" alt="">
									</div>
									<div class="chat-right">
										<p>Andrew Josifn</p>
										<h6>Passif </h6>
									</div>
									<div class="clearfix"> </div>
								</a>
							</li>
							<li><a href="#">
									<div class="chat-left">
										<img class="img-circle" src="images/i2.png" alt="">
										<label class="small-badge bg-green"></label>
									</div>
									<div class="chat-right">
										<p>Justen Ferry</p>
										<h6>Urna mollis ornare vel</h6>
									</div>
									<div class="clearfix"> </div>
								</a>
							</li>
							<li><a href="#">
									<div class="chat-left">
										<img class="img-circle" src="images/i3.png" alt="">
										<label class="small-badge bg-green"></label>
									</div>
									<div class="chat-right">
										<p>Brown Andy </p>
										<h6>Quis risus ullam neget </h6>
									</div>
									<div class="clearfix"> </div>
								</a>
							</li>
							<li><a href="#">
									<div class="chat-left">
										<img class="img-circle" src="images/i4.png" alt="">
										<label class="small-badge"></label>
									</div>
									<div class="chat-right">
										<p>Deos Jhon</p>
										<h6>Mollis ornare Urna vel</h6>
									</div>
									<div class="clearfix"> </div>
								</a>
							</li>
						</ul>
					</div>
				</div> -->
				<div class="col-md-12">
					<div class="panel-info">
						@include('statistic.user_data')
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!--footer-->
		@include('layouts.footer')
        <!--//footer-->
	</div>

    <script>
                    let x = document.querySelectorAll(".myDIV");
                    for (let i = 0, len = x.length; i < len; i++) {
                    let num = Number(x[i].innerHTML)
                        .toLocaleString('de-DE');
                        x[i].innerHTML = num;
                        x[i].classList.add("currSign");
                    }
                </script>

    <script src="{{asset('js_admin/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="{{asset('js_admin/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('js_admin/scripts.js')}}"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="{{asset('js_admin/bootstrap.js')}}"> </script>
   <script>
		$(document).ready( function () {
		$('#myTable').DataTable();
	} );
   </script>
</body>
</html>
