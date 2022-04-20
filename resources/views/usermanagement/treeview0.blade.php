<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Liste des Utilisateurs :: Admin</title>
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
<link href="{{asset('css/treeview.css')}}" rel="stylesheet">

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
            <span class="col-md-10" style="text-align: left;">
                <h3 class="title1">Arbre généalogique de mon réseau</h3>
            </span>
            <span class="col-md-2" style="text-align: right;">
                <a href="/usermanagements" class="nav-badge-btm" title="Liste des utilisateurs">
                    <img src="{{asset('img/icons8-list.gif')}}" style="box-shadow: 5px 5px 5px gray; margin:0 5px; background-color: #fff; width: 30px; border-radius:20%"/>
                </a>
                <a href="{{ route('usermanagements.create') }}" class="nav-badge-btm" title="Ajouter un utilisateur">
                    <img src="{{asset('img/icons8-add.gif')}}" style="box-shadow: 5px 5px 5px gray; margin:0 5px; background-color: #fff; width: 30px; border-radius:20%"/>
                </a>
            </span>
			<div class="main-page">
				<div class="tables">
                    @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                    @endif
                    @forelse($enterprises as $enterprise)
					<div class="table-responsive bs-example widget-shadow" style="box-shadow: 5px 10px 10px gray; width: 100%;">
						<h4>{{$enterprise->designation}}</h4>
                        <ul class="tree vertical">
                            <?php 

isActiveRoute(route('home'));

?>
                            <!-- <li>
                                <div>BE1070</div>
                                
                                <ul>
                                    <li>
                                        <div>BE1070-1</div>
                                        <ul>
                                            <li>
                                                <div>BE1070-1.1</div>
                                            </li>
                                            <li>
                                                <div>BE1070-1.2</div>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <li>
                                        <div>BE1070-2</div>
                                        <ul>
                                            <li>
                                                <div>BE1070-2.1</div>
                                            </li>
                                            <li>
                                                <div>BE1070-2.2</div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div>BE1070-3</div>
                                        <ul>
                                            <li>
                                                <div>BE1070-3.1</div>
                                                <ul>
                                                    <li>
                                                        <div>BE1070-3.1.1</div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div>BE1070-3.2</div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>
					</div>
                    @empty
                        @include('usermanagement.ElseFile')
                    @endforelse

				</div>
			</div>
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
