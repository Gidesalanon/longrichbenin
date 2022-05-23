<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Utilisateurs non approuvés :: Admin</title>
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
					<h3 class="title1">Utilisateurs non approuvés</h3>
                    @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                    @endif
					<div class="table-responsive bs-example widget-shadow">
						<h4>Approuver les Utilisateurs</h4>
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Entreprise</th>
                                    <th>Date & Heure</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @forelse ($users as $i => $user)
                                <tr>
                                    <th scope="row">{{ $user->code }}</th>
                                    <td>{{ $user->nom }}</td>
                                    <td>{{ $user->prenom }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->adresse }}</td>
                                    <td>{{ $user->tel }}</td>

                                    <form method="PUT" action="{{ route('users.edit', $user->id)}}">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                    <td>
                                        <select class="form-control enterprise_id" name="enterprise_id" required"
                                            id="select_enterprise_id-{{$i}}"
                                            onchange="if(this.value!=1){document.getElementById('approuv-{{$i}}').classList.remove('hidden')}else{document.getElementById('approuv-{{$i}}').classList.add('hidden')}">
                                                <option value="1" selected>Affecter à une entreprise</option>
                                                    @foreach($enterprises as $enterprise)
                                                        <option value="{{ $enterprise['id']}}">{{ $enterprise['designation']}}</option>
                                                    @endforeach
                                        </select>

                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.edit', $user->id) }}" id="approuv-{{$i}}" class="{{$user->enterprise_id==1?'hidden':''}}">
                                                <button class="btn btn-primary" title="Approuver" >
                                                    <i class="fa fa-check-circle"></i>
                                                </button>
                                            </a>
                                            <a href="#!" data-toggle="modal" data-target="#modalDeleteUser{{ $user['id']}}">
                                                <button type="button" class="btn btn-danger" title="Supprimer">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    </form>
                                    @include('approvUser.modal_delete')
                                </tr>
                            </tbody>
                            @empty
                                <tr>
                                    <td colspan="4">Aucun Utilisateur Non Approuvé pour le moment.</td>
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
