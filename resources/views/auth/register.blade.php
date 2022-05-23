<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images_login/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css_login/util.css">
	<link rel="stylesheet" type="text/css" href="css_login/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="index.html">Men<span>tor</span></a> -->
                    <a class="logo" href="{{url('/')}}">
                        <img src="img/logo.png" alt="" title="longrich-benin" style="height:52px;" />
                    </a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <a href="{{route('login')}}">
                            <li><img src="{{asset('login.png')}}" title="Se connecter" style="box-shadow: 5px 5px 5px gray; margin:0 5px; width: 40px; border-radius:20%"/></li>
                        </a>
                    </ul>
                </div>
                </div>
            </nav>
				<div class="login100-form-title" style="background-image: url(images_login/bg-01.jpg);">
					<span class="login100-form-title-1">
						S'inscrire
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Code is required">
						<span class="label-input100">Code</span>
						<input class="input100 @error('code') is-invalid @enderror" type="text" id="code" name="code" placeholder="Entrer votre code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert" style="color:red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nom is required">
						<span class="label-input100">Nom</span>
						<input class="input100 @error('nom') is-invalid @enderror" type="text" id="nom" name="nom" placeholder="Entrer votre nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                        @error('nom')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Prenom is required">
						<span class="label-input100">Prénom</span>
						<input class="input100 @error('prenom') is-invalid @enderror" type="text" id="prenom" name="prenom" placeholder="Entrer votre Prénom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                        @error('prenom')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100 @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Entrer votre email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Adresse is required">
						<span class="label-input100">Adresse</span>
						<input class="input100 @error('adresse') is-invalid @enderror" type="text" id="adresse" name="adresse" placeholder="Entrer votre adresse" value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                        @error('adresse')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>

                    <input class="input100" type="hidden" id="enterprise_id" name="enterprise_id" value="1">

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Téléphone is required">
						<span class="label-input100">Téléphone</span>
						<input class="input100 @error('tel') is-invalid @enderror" type="number" id="tel" name="tel" placeholder="Entrer votre téléphone" value="{{ old('tel') }}" required autocomplete="tel" autofocus>
                        @error('tel')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Mot de passe</span>
						<input class="input100 @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Entrer votre mot de passe" required autocomplete="new-password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Confirmer le mot de passe</span>
						<input class="input100" id="password-confirm" type="password" name="password_confirmation" placeholder="Entrer votre mot de passe" required autocomplete="new-password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Inscription
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendor_login/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/bootstrap/js/popper.js"></script>
	<script src="vendor_login/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/daterangepicker/moment.min.js"></script>
	<script src="vendor_login/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js_login/main.js"></script>

</body>
</html>
