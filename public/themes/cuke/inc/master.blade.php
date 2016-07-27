<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="SemiColonWeb" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Stylesheets
  ============================================= -->
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
  {{ Theme::style('css/bootstrap') }}
  {{ Theme::style('css/style') }}
  {{ Theme::style('css/dark') }}
  {{ Theme::style('css/custom') }}
  <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

  <link rel="stylesheet" href="css/responsive.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->

  <!-- Document Title
  ============================================= -->
  <title>Menu - Style 7 | Canvas</title>

</head>

<body class="stretched no-transition">
  <div id="wrapper" class="clearfix">

    <div id="top-bar" class="dark"><!-- #top-bar end -->
      <div class="container clearfix">
        <div class="col_half nobottommargin">

          <div class="top-links"><!-- .top-links -->
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="faqs.html">FAQs</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li><a href="login-register.html">Login</a>
                <div class="top-link-section">
                  <form id="top-login" role="form">
                    <div class="input-group" id="top-login-username">
                      <span class="input-group-addon"><i class="icon-user"></i></span>
                      <input type="email" class="form-control" placeholder="Email address" required="">
                    </div>
                    <div class="input-group" id="top-login-password">
                      <span class="input-group-addon"><i class="icon-key"></i></span>
                      <input type="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <label class="checkbox">
                      <input type="checkbox" value="remember-me"> Remember me
                    </label>
                    <button class="btn btn-danger btn-block" type="submit">Sign in</button>
                  </form>
                </div>
              </li>
            </ul>
          </div><!-- .top-links end -->

        </div>
        <div class="col_half fright col_last nobottommargin">
          <div id="top-social"><!-- #top-social -->
            <ul>
              <li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
              <li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
              <li><a href="#" class="si-dribbble"><span class="ts-icon"><i class="icon-dribbble"></i></span><span class="ts-text">Dribbble</span></a></li>
              <li><a href="#" class="si-github"><span class="ts-icon"><i class="icon-github-circled"></i></span><span class="ts-text">Github</span></a></li>
              <li><a href="#" class="si-pinterest"><span class="ts-icon"><i class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a></li>
              <li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
              <li><a href="tel:+91.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+91.11.85412542</span></a></li>
              <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text">info@canvas.com</span></a></li>
            </ul>
          </div><!-- #top-social end -->
        </div>

      </div>
    </div><!-- #top-bar end -->

    <!-- Header
    ============================================= -->
    <header id="header" class="sticky-style-2 dark">

      <div class="container clearfix">

        <!-- Logo
        ============================================= -->
        <div id="logo">
          <a href="index.html" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="Canvas Logo"></a>
          <a href="index.html" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logo@2x.png" alt="Canvas Logo"></a>
        </div><!-- #logo end -->

        <ul class="header-extras">
          <li>
            <i class="i-plain icon-email3 nomargin"></i>
            <div class="he-text">
              Drop an Email
              <span>info@canvas.com</span>
            </div>
          </li>
          <li>
            <i class="i-plain icon-call nomargin"></i>
            <div class="he-text">
              Get in Touch
              <span>1800-1144-551</span>
            </div>
          </li>
        </ul>

      </div>

      <div id="header-wrap">

        <!-- Primary Navigation
        ============================================= -->
        <nav id="primary-menu" class="style-2">

          <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
            {!! $menu !!}

            <!-- Top Cart
            ============================================= -->
            <div id="top-cart">
              <a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i><span>5</span></a>
              <div class="top-cart-content">
                <div class="top-cart-title">
                  <h4>Shopping Cart</h4>
                </div>
                <div class="top-cart-items">
                  <div class="top-cart-item clearfix">
                    <div class="top-cart-item-image">
                      <a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
                    </div>
                    <div class="top-cart-item-desc">
                      <a href="#">Blue Round-Neck Tshirt</a>
                      <span class="top-cart-item-price">$19.99</span>
                      <span class="top-cart-item-quantity">x 2</span>
                    </div>
                  </div>
                  <div class="top-cart-item clearfix">
                    <div class="top-cart-item-image">
                      <a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
                    </div>
                    <div class="top-cart-item-desc">
                      <a href="#">Light Blue Denim Dress</a>
                      <span class="top-cart-item-price">$24.99</span>
                      <span class="top-cart-item-quantity">x 3</span>
                    </div>
                  </div>
                </div>
                <div class="top-cart-action clearfix">
                  <span class="fleft top-checkout-price">$114.95</span>
                  <button class="button button-3d button-small nomargin fright">View Cart</button>
                </div>
              </div>
            </div><!-- #top-cart end -->

            <!-- Top Search
            ============================================= -->
            <div id="top-search">
              <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
              <form action="search.html" method="get">
                <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
              </form>
            </div><!-- #top-search end -->

          </div>

        </nav><!-- #primary-menu end -->

      </div>

    </header><!-- #header end -->

    @yield('content')

    <!-- Footer
    ============================================= -->
    <footer id="footer" class="dark">

      <div class="container">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap clearfix">

          <div class="col_two_third">

            <div class="col_one_third">

              <div class="widget clearfix">

                <img src="images/footer-widget-logo.png" alt="" class="footer-logo">

                <p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards.</p>

                <div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%;">
                  <address>
                    <strong>Headquarters:</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                  </address>
                  <abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
                  <abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
                  <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
                </div>

              </div>

            </div>

            <div class="col_one_third">

              <div class="widget widget_links clearfix">

                <h4>Blogroll</h4>

                <ul>
                  <li><a href="http://codex.wordpress.org/">Documentation</a></li>
                  <li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
                  <li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
                  <li><a href="http://wordpress.org/support/">Support Forums</a></li>
                  <li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
                  <li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
                  <li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
                </ul>

              </div>

            </div>

            <div class="col_one_third col_last">

              <div class="widget clearfix">
                <h4>Recent Posts</h4>

                <div id="post-list-footer">
                  <div class="spost clearfix">
                    <div class="entry-c">
                      <div class="entry-title">
                        <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                      </div>
                      <ul class="entry-meta">
                        <li>10th July 2014</li>
                      </ul>
                    </div>
                  </div>

                  <div class="spost clearfix">
                    <div class="entry-c">
                      <div class="entry-title">
                        <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                      </div>
                      <ul class="entry-meta">
                        <li>10th July 2014</li>
                      </ul>
                    </div>
                  </div>

                  <div class="spost clearfix">
                    <div class="entry-c">
                      <div class="entry-title">
                        <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                      </div>
                      <ul class="entry-meta">
                        <li>10th July 2014</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

          <div class="col_one_third col_last">

            <div class="widget clearfix" style="margin-bottom: -20px;">

              <div class="row">

                <div class="col-md-6 bottommargin-sm">
                  <div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
                  <h5 class="nobottommargin">Total Downloads</h5>
                </div>

                <div class="col-md-6 bottommargin-sm">
                  <div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
                  <h5 class="nobottommargin">Clients</h5>
                </div>

              </div>

            </div>

            <div class="widget subscribe-widget clearfix">
              <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
              <div class="widget-subscribe-form-result"></div>
              <form id="widget-subscribe-form" action="include/subscribe.php" role="form" method="post" class="nobottommargin">
                <div class="input-group divcenter">
                  <span class="input-group-addon"><i class="icon-email2"></i></span>
                  <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">Subscribe</button>
                  </span>
                </div>
              </form>
            </div>

            <div class="widget clearfix" style="margin-bottom: -20px;">

              <div class="row">

                <div class="col-md-6 clearfix bottommargin-sm">
                  <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                    <i class="icon-facebook"></i>
                    <i class="icon-facebook"></i>
                  </a>
                  <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                </div>
                <div class="col-md-6 clearfix">
                  <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                    <i class="icon-rss"></i>
                    <i class="icon-rss"></i>
                  </a>
                  <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                </div>

              </div>

            </div>

          </div>

        </div><!-- .footer-widgets-wrap end -->

      </div>

      <!-- Copyrights
      ============================================= -->
      <div id="copyrights">

        <div class="container clearfix">

          <div class="col_half">
            Copyrights &copy; 2014 All Rights Reserved by Canvas Inc.<br>
            <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
          </div>

          <div class="col_half col_last tright">
            <div class="fright clearfix">
              <a href="#" class="social-icon si-small si-borderless si-facebook">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-twitter">
                <i class="icon-twitter"></i>
                <i class="icon-twitter"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-gplus">
                <i class="icon-gplus"></i>
                <i class="icon-gplus"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-pinterest">
                <i class="icon-pinterest"></i>
                <i class="icon-pinterest"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-vimeo">
                <i class="icon-vimeo"></i>
                <i class="icon-vimeo"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-github">
                <i class="icon-github"></i>
                <i class="icon-github"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-yahoo">
                <i class="icon-yahoo"></i>
                <i class="icon-yahoo"></i>
              </a>

              <a href="#" class="social-icon si-small si-borderless si-linkedin">
                <i class="icon-linkedin"></i>
                <i class="icon-linkedin"></i>
              </a>
            </div>

            <div class="clear"></div>

            <i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +91-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
          </div>

        </div>

      </div><!-- #copyrights end -->

    </footer><!-- #footer end -->
    */
    ?>

  </div><!-- #wrapper end -->

  <!-- Go To Top
  ============================================= -->
  <div id="gotoTop" class="icon-angle-up"></div>

  <!-- External JavaScripts
  ============================================= -->
  {{ Theme::script('js/jquery') }}
  {{ Theme::script('js/plugins') }}

  <!-- Footer Scripts
  ============================================= -->
  {{ Theme::script('js/functions') }}

</body>
</html>