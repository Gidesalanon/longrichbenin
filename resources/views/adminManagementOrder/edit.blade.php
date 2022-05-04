<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Modifier cette ligne de commande :: Admin</title>
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
				<div class="forms">
					<h3 class="title1">Modifier cette Commande</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
						<div class="form-title">
							<h4>Modifier la commande:</h4>
						</div>
						<div class="form-body">
						<form method="POST" action="{{ route('order.update', $order['id'])}}">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Produit</label>
                                    <select name="product_id" class="form-control b" disabled
                                            oninput="
                                            document.getElementById('input_p_0').value=document.getElementById('input_qte_0').value * document.getElementById('select_product_0').value.split('|')[1];
                                            document.getElementById('input_price_0').value=document.getElementById('input_qte_0').value * document.getElementById('select_product_0').value.split('|')[1];
                                            "
                                            id="select_product_0" required>
                                                <option selected hidden></option>
                                                @foreach($products as $product)
                                                <option value="{{ $product['id']}}|{{ $product['prixclient']}}" @if ($product['id']==$order['product_id']) selected @endif {{ $product['nomprod']}}</option>
                                                @endforeach
                                    </select>
                                                <input value="{{ $product['id']}}|{{ $product['prixclient']}}" name="product_id" type="hidden">
                            </div>

                            <div class="form-group">
                                <label for="">Qté</label>
                                <input type="number" id="input_qte_0" oninput="
                                    document.getElementById('input_p_0').value=this.value * document.getElementById('select_product_0').value.split('|')[1];" name="qte"
                                    document.getElementById('input_price_0').value=this.value * document.getElementById('select_product_0').value.split('|')[1];" name="qte
                                    " placeholder="Taper votre Quantité" class="form-control c" value="{{ $order['qte']}}"/>
                            </div>
                            <div class="form-group">
                                <label for="">Prix</label>
                                <input type="hidden" id="input_price_0" name="prix" class="form-control1 a"/>
                                <input type="number" id="input_p_0" name="prix" class="form-control d" value="{{ $order['prix']}}" readonly/>
                            </div>
                            <button type="submit" class="btn btn-default">Modifier</button>
                        </form>
						</div>
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
