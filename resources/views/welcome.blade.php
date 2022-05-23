<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page de Business - Longrich Bénin</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/imagehover.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
    Theme Name: Mentor
    Theme URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <!--Navigation bar-->
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
            <img src="img/logo.png" alt="" title="logo" style="height:60px;" />
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#calculatrice">Calculatrice</a></li>
          <li><a href="#organisations">À-propos</a></li>
            @guest
                @if (Route::has('login'))
                    <li><a href="{{route('login')}}">Se connecter</a></li>
                    <li><a href="{{route('register')}}">S'inscrire</a></li>
                @endif
            @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('admin.home')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                        </a>
                    </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Navigation bar-->
  <!--Modal box-->
  <div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Se Connecter</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Identifiez-vous.</p>
            <div class="form-group">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  <span class="fa fa-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" name="password" required autocomplete="current-password"/>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                  <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                      <table style="border-collapse:separate; border-spacing: 10px 10px;">
                        <td><div class="checkbox icheck">
                            <label>
                                <input type="checkbox" id="loginrem"> Se Souvenir
                            </label>
                        </div></td>

                        <td>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:14px;">Mot De Passe Oublié?</a>
                            @endif
                        </td>
                      </table>
                  </div>
                  <div class="col-xs-12">
                    <button type="submit" style="width:50%;" class="btn btn-green btn-block btn-flat" onclick="userlogin()">Connexion</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="modal fade" id="register" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">S'inscrire</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Enregistrez vous.</p>
            <div class="form-group">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  <span class="fa fa-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" name="password" required autocomplete="current-password"/>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                  <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                      <table style="border-collapse:separate; border-spacing: 10px 10px;">
                        <td><div class="checkbox icheck">
                            <label>
                                <input type="checkbox" id="loginrem"> Se Souvenir
                            </label>
                        </div></td>

                        <td>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:14px;">Mot De Passe Oublié?</a>
                            @endif
                        </td>
                      </table>
                  </div>
                  <div class="col-xs-12">
                    <button type="submit" style="width:50%;" class="btn btn-green btn-block btn-flat" onclick="userlogin()">Connexion</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--/ Modal box-->
  <!--Banner-->
  <div class="banner">
    <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="banner-text text-center">
            <div class="text-border">
              <h2 class="text-dec">Better Life - Better Future</h2>
            </div>
            <div class="intro-para text-center quote">
              <p class="big-text">Meilleur vie . . . Meilleur Avenir.</p>
              <p class="small-text">Longrich est une multinationale qui fabrique plus de 2.000 gammes de produits de qualité
                  dans les secteurs d’activités du cosmétique,
                  de soins, de santé, de l’électroménager...
                  Longrich est celle qui vous assure un bon quotidien et un bon avenir.</p>
              <a href="#footer" class="btn get-quote">SUIVEZ-NOUS</a>
            </div>
            <a href="#calculatrice" class="mouse-hover">
              <div class="mouse"></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Banner-->
  <!--Calculatrice-->
  <section id="calculatrice" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Calculatrice</h2>
          <p>Calculer ici vos commissions sur vos sélections.</p>
          <hr class="bottom-line">
        </div>
        <div class="calculatrice-info">
          @include('table_calculator')
        </div>
      </div>
    </div>
  </section>
  <!--/ calculatrice-->
  <!--Organisations-->
  <section id="organisations" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3>75%</h3>
              <p>Disent Oui!!</p>
              <i class="fa fa-male"></i>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3>15%</h3>
              <p>Disent Non!!</p>
              <i class="fa fa-male"></i>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3>10%</h3>
              <p>Sont Néants!!</p>
              <i class="fa fa-male"></i>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-info">
            <hgroup>
              <h3 class="det-txt"> S'inscrire à Longrich c'est Oui à un avenir joyeux!</h3>
              <h4 class="sm-txt">(Longrich c'est du Better Life Better Future)</h4>
            </hgroup>
            <p class="det-p">Contactez-nous dès maintenant pour devenir partenaire et profiter aussi de nos prix exceptionnels.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Organisations-->

  <!--Contact-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Contactez Nous</h2>
          <p>Ecrivez nous aujourd'hui, pour devenir membre et profiter des multiples avantages du business.</p>
          <hr class="bottom-line">
        </div>
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <form action="" method="post" role="form" class="contactForm">
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="form-group">
              <input type="text" name="name" class="form-control form" id="name" placeholder="Votre Nom" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-xs-12">
            <!-- Button -->
            <button type="submit" id="submit" name="submit" class="form contact-form-button light-form-button oswald light">ENVOYER EMAIL</button>
          </div>
        </form>

      </div>
    </div>
  </section>
  <!--/ Contact-->
  <!--Footer-->
  <footer id="footer" class="footer">
    <div class="container text-center">

      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
      </ul>
      Longrich Bénin&copy;<script>document.write(new Date().getFullYear());</script>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mentor
        -->
        Site web Développé par <a href="https://kdlfourniture.com/">KDL Fournitures</a>
      </div>
    </div>
  </footer>
  <!--/ Footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
