<?php
/**
 * HONAKO THEME
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 05/03/2016
 *
 * Domain: 
 * Public
 *
 * Type:
 * Template
 * 
 * Description:
 * Master template
 */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title>HONAKO.COM</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

  {{ Html::style('public/honako/assets/css/bootstrap.min.css') }}
  {{ Html::style('public/honako/assets/css/font-awesome.min.css') }}
  {{ Html::style('public/honako/assets/css/owl.carousel.css') }}
  {{ Html::style('public/honako/assets/css/youplay.min.css') }}
  {{ Html::style('public/honako/assets/css/style.css') }}

  <!--[if lt IE 9]>
  <![endif]-->
</head>

<body>

  <!-- Preloader -->
  <div class="page-preloader preloader-wrapp">
    {{ Html::image('public/honako/assets/images/logo-site.png') }}
    <div class="preloader"></div>
  </div>
  <!-- /Preloader -->

  <!-- Navbar -->
  <nav class="navbar-youplay navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          {{ Html::image('public/honako/assets/images/logo-site.png') }}
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="#!">
              Jasa Download
            </a>
          </li>
          <li>
            <a href="#!">
              Jasa Pembelian
            </a>
          </li>
          <li>
            <a href="#!">
              Kontak Kami
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- /Navbar -->

  <!-- Main Content -->
  <section class="content-wrap">

    @yield('content')
    <!-- Footer -->
    <footer>
      <div class="wrapper" style="background-image: url(assets/images/footer-bg.jpg)" data-bottom="transform:translate3d(0px,0px,0px);" data-bottom-top="transform:translate3d(0px,-200px,0px);" data-anchor-target="footer">

        <!-- Social Buttons -->
        <div class="social">
          <div class="container" data-bottom-top="opacity: 0;" data-bottom="opacity: 1;">
            <h3>Connect socially with <strong>youplay</strong></h3>

            <div class="row icons">
              <div class="col-xs-6 col-sm-3">
                <a href="#!">
                  <i class="fa fa-facebook-square"></i>
                  <span>Like on Facebook</span>
                </a>
              </div>
              <div class="col-xs-6 col-sm-3">
                <a href="#!">
                  <i class="fa fa-twitter-square"></i>
                  <span>Follow on Twitter</span>
                </a>
              </div>
              <div class="col-xs-6 col-sm-3">
                <a href="#!">
                  <i class="fa fa-twitch"></i>
                  <span>Watch on Twitch</span>
                </a>
              </div>
              <div class="col-xs-6 col-sm-3">
                <a href="#!">
                  <i class="fa fa-youtube-square"></i>
                  <span>Watch on Youtube</span>
                </a>
              </div>
            </div>

          </div>
        </div>
        <!-- /Social Buttons -->

        <!-- Copyright -->
        <div class="copyright">
          <div class="container">
            <strong>nK</strong> &copy; 2015. All rights reserved
          </div>
        </div>
        <!-- /Copyright -->

      </div>
    </footer>
    <!-- /Footer -->
  </section>
  <!-- /Main Content -->

  <!-- Search Block -->
  <div class="search-block">
    <a href="#!" class="search-toggle glyphicon glyphicon-remove"></a>
    <form action="http://html.nkdev.info/youplay/dark/search.html">
      <div class="youplay-input">
        <input type="text" name="search" placeholder="Search...">
      </div>
    </form>
  </div>
  <!-- /Search Block -->

  <!-- jQuery -->
  {{ Html::script('public/honako/assets/js/jquery.min.js') }}

  <!-- Hexagon Progress -->
  {{ Html::script('public/honako/assets/js/jquery.hexagonprogress.min.js') }}

  <!-- Bootstrap -->
  {{ Html::script('public/honako/assets/js/bootstrap.min.js') }}

  <!-- Skrollr -->
  {{ Html::script('public/honako/assets/js/skrollr.min.js') }}

  <!-- Smooth Scroll -->
  {{ Html::script('public/honako/assets/js/smoothscroll.js') }}

  <!-- Owl Carousel -->
  {{ Html::script('public/honako/assets/js/owl.carousel.min.js') }}

  <!-- Countdown -->
  {{ Html::script('public/honako/assets/js/jquery.countdown.min.js') }}

  <!-- youplay -->
  {{ Html::script('public/honako/assets/js/youplay.js') }}
  <!-- init youplay -->
  <script type="text/javascript">
    if(typeof youplay !== 'undefined') {
      youplay.init({
          smoothscroll: false,
      });
    }
  </script>

  <script type="text/javascript">
    $(".countdown").each(function() {
      $(this).countdown($(this).attr('data-end'), function(event) {
        $(this).text(
          event.strftime('%D days %H:%M:%S')
        );
      });
    })
  </script>

</body>
</html>