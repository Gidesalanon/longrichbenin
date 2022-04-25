<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Liste des Ecarts :: Utilisateur</title>
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
            <span class="col-md-10">
                <h3 class="title1">Mes Ventes</h3>
            </span>
            <span class="col-md-2" style="text-align: right;">
                <a href="" class="nav-badge-btm" title="Arbre généalogique">
                    <img src="{{asset('img/icons8-tree.png')}}" style="box-shadow: 5px 5px 5px gray; margin:0 5px; background-color: #fff; width: 30px; border-radius:20%"/>
                </a>
                <a href="" class="nav-badge-btm" title="Ajouter un utilisateur">
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
					<div class="table-responsive bs-example widget-shadow" style="box-shadow: 5px 10px 10px gray; width: 100%;">
						<h4> Liste de mes Ventes</h4>
                            <table class="table table-bordered">
                            <thead style="box-shadow: 5px 5px 5px gray; ">
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>Qté Obtenue</th>
                                    <th>Qté Vendue</th>
                                    <th>Ecart</th>
                                    <th>Date & Heure</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sellings as $selling)
                                <tr>
                                    <th scope="row">{{ $selling->id }}</th>
                                    <td>{{ $products[$selling->product_id] }}</td>
                                    <td>{{ $orders[$selling->order_id] }}</td>
                                    <td>{{ $selling->qte_vendu }}</td>
                                    <td class="myDIV">{{ $selling->ecart }}</td>
                                    <td>{{ \Carbon\Carbon::parse($selling->created_at)->setTimezone('Africa/Porto-Novo')->format('d/m/y à H:i:s')}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="" class="nav-badge-btm" title="Payer">
                                                <img src="https://img.icons8.com/external-anggara-flat-anggara-putra/19/000000/external-edit-user-interface-anggara-flat-anggara-putra-3.png" style="box-shadow: 5px 5px 5px gray; border-radius:20%"/>
                                            </a>
                                        </div>
                                    </td>
                                    @include('selling.payement')
                                </tr>
                            </tbody>
                            @empty
                                <style>
                                        #table-id {
                                            visibility:hidden;
                                            margin-top:-165px;
                                        }
                                    </style>
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
