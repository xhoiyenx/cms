<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title></title>
    {{ Theme::style('asset/css/bootstrap.min.css') }}
    {{ Theme::style('asset/css/responsive.css') }}
    {{ Theme::style('asset/css/stylesheet.css') }}
  </head>
  <body>
    <div class="wrap">
      <div class="body">

        <!-- mobile menu template -->
        <div class="mobile-menu">
        </div>
        <!-- mobile menu template -->

        <!-- site template -->
        <div class="main">

          <div id="honako">
            <div class="header">
                
              <div class="top-bar">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8"></div>
                  </div>
                </div>
              </div>

              <header>
                <div class="container">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="logo">
                        <a href="#"><img src="{{ Theme::url('asset/img/logo-placeholder.png') }}"></a>
                      </div>
                    </div>
                    <div class="col-md-9">
                      
                    </div>
                  </div>
                </div>
              </header>

            </div>
          </div>
          
        </div>
        <!-- site template -->

      </div>
    </div>
    {{ Theme::script('asset/js/jquery-3.1.0.min.js') }}
    {{ Theme::script('asset/js/application.js') }}
  </body>
</html>