<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title></title>
    {{ Theme::style('asset/css/bootstrap.min.css') }}
    {{ Theme::style('asset/css/stylesheet.css') }}
  </head>
  <body>
    <div class="wrap">
      <div class="body">
        <div class="mobile-menu">
          Foo
        </div>
        <div class="main">
          <a href="#" class="toggle-nav">Click</a>
        </div>
      </div>
    </div>
    {{ Theme::script('asset/js/jquery-3.1.0.min.js') }}
    <script type="text/javascript">
    $(function() {
      $('.toggle-nav').click(function() {
        $('.wrap').toggleClass('show-mobile');
      });
    });
    </script>
  </body>
</html>