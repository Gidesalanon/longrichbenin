<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Commandes non approuvées :: Admin</title>
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
					<h3 class="title1">Commandes non approuvées</h3>
                    @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                    @endif
					<div class="table-responsive bs-example widget-shadow">
                    <h4>

                        <table class="table table-bordered">
                            @foreach ($orders as $order)
                                @if ($count <> 0)
                                    <tr>
                                                @if ($order->approve == "0")
                                                    @continue ($order->id == 4)

                                                        <th><a href="{{ route('admin.orders.approve', $order->id) }}">
                                                            <span class="label label-default" title="Approuver cette commande"><i class="fa fa-check-circle"></i>Approuver cette commande</span>
                                                        </a></th>

                                                        <th>Prix Totale: </th>
                                                    @break ($order->id == 4)
                                                @else
                                                @continue ($order->id == 4)
                                                        <th>
                                                            <a href="{{ route('admin.orders.desapprove', $order->id) }}">
                                                                <span class="badge badge-success" title="Désapprouver cette commande">Commande Approuvée</span></a>
                                                            </a>
                                                        </th>
                                                        <th> De: {{ $order->nom }} {{ $order->prenom }}</th>
                                                        <th>Date: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/y')}}</th>
                                                        <th>Prix Totale: </th>
                                                        </a>
                                                @break ($order->id == 4)
                                                @endif
                                </tr>
                                @endif

                            @endforeach
                        </table>
                    </h4>
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->nom_produit }}</td>
                                    <td>{{ $order->qte }}</td>
                                    <td>{{ $order->prix }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('order.edit', $order->id) }}">
                                                <button type="button" class="btn btn-primary" title="Modifier">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#modalDeleteOrder{{ $order->id}}">
                                                <button type="button" class="btn btn-danger" title="Supprimer">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    @include('adminManagementOrder.delete')
                                </tr>
                            </tbody>
                            @empty
                                <tr>
                                    <td colspan="4">Aucune commande non approuvée pour le moment.</td>
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
