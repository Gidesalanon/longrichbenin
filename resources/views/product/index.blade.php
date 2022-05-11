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

<link rel="stylesheet" href="{{asset('stylebutton.css')}}">
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
                    @forelse($stocks as $stock)
					<div class="table-responsive bs-example widget-shadow" id="table">
                        <span class="col-md-3">
                            <h4>{{ $stock->libelle }}</h4>
                        </span>
                        <span class="col-md-3" style="text-align: right;">
                            <a href="{{ route('admin.input.product') }}" class="nav-badge-btm">
                                <button type="submit" class="btn btn-primary" style="box-shadow: 5px 5px 5px gray; margin:0 5px;">Suivie des entrées <i class="fa fa-arrow-circle-right"></i></button>
                            </a>
                        </span>

                        <span class="col-md-3" style="text-align: right;">
                            <a href="{{ route('admin.output.product') }}" class="nav-badge-btm">
                                <button type="submit" class="btn btn-success" style="box-shadow: 5px 5px 5px gray; margin:0 5px;">Suivie des sorties <i class="fa fa-arrow-circle-right"></i></button>
                            </a>
                        </span>
                        <span class="col-md-3" style="text-align: right;">
                            <a href="{{ route('products.create') }}" class="nav-badge-btm">
                                <button type="submit" class="btn btn-info" style="box-shadow: 5px 5px 5px gray; margin:0 5px;">Nouveau produit <i class="fa fa-plus-circle"></i></button>
                            </a>
                        </span>
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>PV</th>
                                    <th>Prix Partenaire</th>
                                    <th>Prix Client</th>
                                    <th>Quantité</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stock->products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->nomprod }}</td>
                                    <td>{{ $product->nbpv }}</td>
                                    <td class="myDIV">{{ $product->prixpartenaire }}</td>
                                    <td class="myDIV">{{ $product->prixclient }}</td>
                                    <td>{{ $product->qte }}</td>
                                    <td>{{ $product->status }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                                <div class="follow">
                                                    <a href="{{ route('products.edit', $product->id) }}">
                                                        <div class="icon first" title="Modifier" style="background-color:#2e6da4;"><i class="fa fa-edit"></i></div>
                                                    </a>

                                                    <a href="#" data-toggle="modal" data-target="#modalAddProduct{{ $product->id}}">
                                                        <div class="icon last" title="Ajout de {{ $product->nomprod }}" style="background-color:#4cae4c;"><i class="fa fa-plus-circle"></i></div>
                                                    </a>

                                                    <!-- <a href="">
                                                        <div class="icon icon" title="Suivie des Entrées" style="background-color:#e94e02;"><i class="fa fa-arrow-circle-left"></i></div>
                                                    </a>

                                                    <a href="">
                                                        <div class="icon last" title="Suivie des Sorties" style="background-color:#F2B33F;"><i class="fa fa-arrow-circle-right"></i></div>
                                                    </a> -->

                                                    <div class=""></div>
                                                </div>

                                        </div>
                                    </td>
                                    @include('product.delete')
                                    @include('product.add-stock')
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
