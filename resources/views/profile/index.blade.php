<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Profil :: Gestion de profil</title>
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
<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
        @include('layouts.menu')
        @include('layouts.header')

		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
            @foreach ($profiles as $profiles)
                <div class="main-page compose">
				@include('profile.menu')
				<div class="col-md-8 compose-right widget-shadow">

                    <div class="col-md-32 widget-shadow">
                        <h4 class="title3">Information Générale</h4>
						<div class="profile-top">
							<!-- <img src="images/img1.png" alt=""> -->
							<h4>{{$profiles->nom}} {{$profiles->prenom}} <a href="{{ route('details.edit') }}" style="color:#fff;"><i class="fa fa-pencil" title="Modifier"></a></i></h4>
                                @if ($profiles->is_admin == "1")
                                    <h5>Administrateur</h5>
                                @elseif ($profiles->is_admin == "2")
                                    <h5>Gestionnaire</h5>
                                @else
                                    <h5>Commercial</h5>
                                @endif
                            </div>
                            <div class="profile-text">
                                <div class="profile-row">
                                    <div class="profile-left">
                                        <i class="fa fa-envelope profile-icon"></i>
                                    </div>
                                    <div class="profile-right">
                                        <h4>{{$profiles->email}} </h4>
                                        <p>Email</p>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="profile-row row-middle">
                                    <div class="profile-left">
                                        <i class="fa fa-mobile profile-icon"></i>
                                    </div>
                                    <div class="profile-right">
                                        <h4>{{$profiles->tel}}</h4>
                                        <p>Téléphone</p>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>

                                <div class="profile-row">
                                    <div class="profile-left">
                                        <i class="fa fa-home profile-icon"></i>
                                    </div>
                                    <div class="profile-right">
                                        <h4>{{$profiles->adresse}}</h4>
                                        <p>Adresse</p>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                            <div class="profile-btm">
                                <ul>
                                    <li>
                                        <h4>{{$count_sellings}}</h4>
                                        <h5>Ventes</h5>
                                    </li>
                                    <li>
                                        <h4>{{$sum_pv}}</h4>
                                        <h5>PV</h5>
                                    </li>
                                    <li>
                                        <h4>{{$sum_benefice}}</h4>
                                        <h5>Commission</h5>
                                    </li>
                                </ul>
                            </div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
            @endforeach

		</div>
		<!--footer-->
		@include('layouts.footer')
        <!--//footer-->
	</div>
	<!-- Classie -->
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
</body>
</html>
