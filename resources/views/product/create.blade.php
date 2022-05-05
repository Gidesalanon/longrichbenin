<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Nouveau produit :: Admin</title>
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
					    <h3 class="title1">Ajouter un Nouveau Produit</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                            <div class="form-title">
                                <h4>Renseigner les détails du produit:</h4>
                            </div>

						<div class="form-body">
						 <form method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Désignation</label>
                                <input type="text" class="form-control" id="nomprod" name="nomprod" placeholder="Taper la désignation du produit" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Stock</label>
                                <select class="form-control" name="stock_id" required>
                                    <option selected hidden></option>
                                    @foreach($stocks as $stock)
                                    <option value="{{ $stock['id']}}">{{ $stock['libelle']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Catégorie</label>
                                <select class="form-control" name="categorie_id" required>
                                    <option selected hidden></option>
                                    @foreach($categories as $categorie)
                                    <option value="{{ $categorie['id']}}">{{ $categorie['libelle']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Image du Produit</label>
                                <input type="file" class="form-control" id="image" name="image"  accept=".jpg, .png, .jpeg" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nombre de PV</label>
                                <input type="number" step="any" min="1" onKeyUp="if(this.value<1){this.value='';}" class="form-control" id="nbpv" name="nbpv" required>
                            </div>
                            <div class="form-group">
                                <label for="">Prix Partenaire</label>
                                <input type="number" class="form-control" min="1" onKeyUp="if(this.value<1){this.value='';}" id="prixpartenaire" name="prixpartenaire" required>
                            </div>
                            <div class="form-group">
                                <label for="">Prix Client</label>
                                <input type="number" class="form-control" min="1" onKeyUp="if(this.value<1){this.value='';}"  id="prixclient" name="prixclient" required>
                            </div>
                            <div class="form-group">
                                <label for="">Quantité</label>
                                <input type="number" class="form-control" id="qte" name="qte" min="0" onKeyUp="if(this.value<0){this.value='';}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select class="form-control" name="status" required>
                                    <option selected hidden></option>
                                    <option value="Actif">Actif</option>
                                    <option value="Inactif">Inactif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea rows="6" id="description" name="description" id="description" class="form-control" placeholder="Description :" ></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Créer</button>
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
