<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Gestion de commande :: Manager</title>
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
		<!--left-fixed -navigation-->
		@include('layouts.menu')
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		@include('layouts.header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="tables">
					<h3 class="title1">Commandes Approuvées</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <h4>
                        </h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Commande du</th>
                                    <th>Information du Demandeur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                                <tbody>
                                @forelse ($ordergroups as $ordergroup)
                                <tr>
                                    <th scope="row">{{ \Carbon\Carbon::parse($ordergroup->created_at)->setTimezone('Africa/Porto-Novo')->format('d/m/y à H:i:s')}}</th>
                                    <td>{{ $users[$ordergroup->user_id] }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- <a href="#" data-toggle="modal" data-target="#modalDeleteOrder{{ $ordergroup->id}}">
                                                <button type="button" class="btn btn-success" title="Exécuter">
                                                    <i class="fa fa-play-circle"></i>
                                                </button>
                                            </a> -->
                                            <a href="#" data-toggle="modal" data-target="#modalShowOrder{{ $ordergroup->id}}">
                                                <button type="button" class="btn btn-info" title="Voir Plus">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    @include('magasinier.order.show')
                                </tr>
                            </tbody>
                            @empty
                                <tr>
                                    <td colspan="4">Aucune Commande ajoutée pour le moment.</td>
                                </tr>
                            @endforelse
                        </table>
					</div>
			</div>
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
