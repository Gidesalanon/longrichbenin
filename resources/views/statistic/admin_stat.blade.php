<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Ma Statistique </title>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
		@include('layouts.menu')
        @include('layouts.header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
            <span class="col-md-10">
                <h3 class="title1">Statistique</h3>
            </span>
            <div class="main-page compose">

                <div class="col-md-4 compose-left">
					<div class="folder widget-shadow">
						<ul>
							<li class="head">Nos Utilisateurs</li>
                                @foreach($users as $user)

                                    <li>
                                        <form action="{{route('user.all.statistic')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            </form>
                                            <a href="{{route('user.all.statistic')}}" type="submit"><i class="fa fa-user"></i>

                                                @if ($user->id == 1)
                                                    Ma Statistique
                                                    @else
                                                    {{$user->nom}} {{$user->prenom}}
                                                @endif
                                            </a>
                                    </li>
                                @endforeach

						</ul>
					</div>
				</div>

				<div class="col-md-8 compose-right widget-shadow">
					<div class="panel-info">

                    <div class="main-page">
                        <div class="tables">
                            <div class="grid-bottom table-responsive widget-shadow">
                                <h4>@foreach ($marge_nets as $marge_net) {{ \Carbon\Carbon::parse($marge_net->created_at)->format('F Y')}} @endforeach</h4>
                                        <table class="table table-bordered table-striped no-margin grd_tble" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>DATE</th>
                                                    <th>PRODUITS</th>
                                                    <th>
                                                        QTÉ JOURNALIÈRE VENDUE
                                                    </th>
                                                    <th>
                                                        TOTAL PV
                                                    </th>
                                                    <th>
                                                        CA
                                                    </th>
                                                    <th>
                                                        MARGE BRUTE/JOUR
                                                    </th>
                                                    <th>
                                                        COMMISSION (0.7)
                                                    </th>
                                                    <th>
                                                        MARGE NET (0.3)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sellings as $selling)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($selling->date)->setTimezone('Africa/Porto-Novo')->format('d/m/y')}}</td>

                                                        <td> <span data-toggle="tooltip" data-placement="top" data-original-title="Prix Partenaire: {{ $prixpartenaires[$selling->product_id] }} Prix Client: {{ $prixclients[$selling->product_id] }} PV: {{ $pvProducts[$selling->product_id] }}">
                                                            {{ $products[$selling->product_id] }}</span>
                                                        </td>
                                                        <script>$(function () {
                                                            $('[data-toggle="tooltip"]').tooltip()
                                                            })
                                                        </script>
                                                        <td>{{$selling->total_qte}}</td>
                                                        <td>{{$selling->total_pv}}</td>
                                                        <td class="myDIV">{{$selling->total_ca}}</td>
                                                        <td class="myDIV">{{$selling->total_benefice}}</td>
                                                        <td class="myDIV">{{$selling->total_benefice * 0.7}}</td>
                                                        <td class="myDIV">{{$selling->total_benefice - $selling->total_benefice * 0.7}}</td>
                                                    </tr>
                                                @endforeach
                                                <thead style="font-weight:bold;">
                                                    <td colspan="3">TOTAL:</td>
                                                    <td class="myDIV"> @foreach ($pv_sums as $pv_sum) {{$pv_sum->total_pv}} @endforeach </td>
                                                    <td class="myDIV"> @foreach ($ca_sums as $ca_sum) {{$ca_sum->total_ca}} @endforeach</td>
                                                    <td class="myDIV"> @foreach ($benefice_sums as $benefice_sum) {{$benefice_sum->total_benefice}} @endforeach</td>
                                                    <td class="myDIV"> @foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com}} @endforeach</td>
                                                    <td class="myDIV"> @foreach ($marge_nets as $marge_net) {{$marge_net->margeNet}} @endforeach</td>
                                                </thead>
                                                <thead style="font-weight:bold;">
                                                    <td colspan="6">FRAIS FINANCIERS (0.4):</td>
                                                    <td class="myDIV">@foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com * 0.4}} @endforeach</td>
                                                    <td>-</td>
                                                </thead>
                                                <thead style="font-weight:bold;">
                                                    <td colspan="6">AVANCE SUR COMMISSION (30.000):</td>
                                                    <td class="myDIV">@foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com * 0.4 - 30000}} @endforeach</td>
                                                    <td>-</td>
                                                </thead>
                                            </tbody>
                                        </table> </br>
                            </div>
                        </div>
                    </div>







					</div>
				</div>
				<div class="clearfix"> </div>
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
   <script>

        $.fn.dataTable.ext.errMode = 'none';

	$('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
		console.log( 'An error has been reported by DataTables: ', message );
	});

	let table = $('#myTable').DataTable( {
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:     "MENU &eacute;l&eacute;ments",
            info:           "Affichage des &eacute;l&eacute;ments START &agrave; END sur TOTAL",
            infoEmpty:      "Aucun &eacute;lement trouv&eacute;",
            infoFiltered:   "(filtr&eacute; de MAX &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible pour le moment",
            paginate: {
                first:      "<<",
                previous:   "<",
                next:       ">",
                last:       ">>"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre dÃ©croissant"
            }
        },
        // pagingType: "full_numbers",
            lengthMenu: [ 10, 25, 50, 75, 100 ],

        dom: '<"top">Brt<"buttom"p><"clear">',
        processing: true,
		retrieve: true,

		columnDefs: [
			{
				targets: [0,-1], //first column / numbering column
				orderable: false, //set not orderable
			},
		],
		//dom: 'Bfrtip',

    });

    $('#search').on('keyup', function(){
      table.search(($(this).val()).trim()).draw();
    });

   </script>
</body>
</html>
