<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Point des commandes :: Utilisateur</title>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>

<style>
    @import url("http://bootswatch.com/simplex/bootstrap.min.css");

    table .collapse.in {
        display:table-row;
    }
</style>
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
					<h3 class="title1">Point des Ventes</h3>
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
                                    <th></th>
                                    <th>Commande du</th>
                                    <th>Demandeur</th>
                                    <th>Produit</th>
                                    <th>Quantité Obtenue</th>
                                    <th>Prix Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                                <tbody>
                                @forelse ($orders as $order)
                                <tr class="clickable" data-toggle="collapse" id="row{{ $order->id }}" data-target=".row{{ $order->id }}">
                                    <td><img src="{{asset('icons8-plus.gif')}}" style="width:25px; height:25px;"></td>
                                    <th scope="row">{{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Africa/Porto-Novo')->format('d/m/y à H:i:s')}}</th>
                                    <td>{{ $users[$order->user_id] }}</td>
                                    <td>{{ $products[$order->product_id] }}</td>
                                    <td>{{ $order->qte }}</td>
                                    <td>{{ $order->prix }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" data-toggle="modal" data-target="#modalDeleteOrder">
                                                <button type="button" class="btn btn-danger" title="Supprimer">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="collapse row{{ $order->id }}" style="background-color:slategrey;">
                                <td style="color:#fff; font-weight: bold;">VENTE</td>
                                    <td colspan="2" style="color:#fff; width:25%;"><input type="number" class="form-control" id="qte_vendu" name="qte_vendu" placeholder="Tapez la Quantité Vendue" required></td>
                                    <td colspan="3" style="color:#fff; font-weight: bold;" align="center">ÉCART QUANTITÉ: {{ $order->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ÉCART PRIX: {{ $order->id }}</td>
                                    <td>
                                        <a href="#">
                                                <button type="button" class="btn btn-info" title="Voir Plus">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </a>
                                    </td>
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
