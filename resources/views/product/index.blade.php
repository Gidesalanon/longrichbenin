<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Liste de produits :: Admin</title>
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
					<h3 class="title1">Nos Produits/Stocks</h3>
                    @if ($count_product == 0)
                        @include('product.ElseFile')
                    @endif
                    @forelse($stocks as $stock)
					<div class="table-responsive bs-example widget-shadow" id="table-id{{$stock->id}}">
						<h4>{{ $stock->libelle }}</h4>

						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>PV</th>
                                    <th>Prix Partenaire</th>
                                    <th>Prix Client</th>
                                    <th>Quantité</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stock->products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->nomprod }}</td>
                                    <td>{{ $product->nbpv }}</td>
                                    <td>{{ $product->prixpartenaire }}</td>
                                    <td>{{ $product->prixclient }}</td>
                                    <td>{{ $product->qte }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.edit', $product->id) }}">
                                                <button type="button" class="btn btn-primary" title="Modifier">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#modalDeleteProduct{{ $product->id}}">
                                                <button type="button" class="btn btn-danger" title="Supprimer">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    @include('product.delete')
                                </tr>
                            </tbody>
                            @empty
                                <style>
                                        #table-id{{$stock->id}} {
                                            visibility:hidden;
                                            margin-top:-165px;
                                        }
                                    </style>
                            @endforelse
                        </table>

					</div>
                    @empty
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
