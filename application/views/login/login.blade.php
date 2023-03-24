<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{base_url()}}/assets_admin/images/favicon.png">
    <title>{{TITULO_APP}}</title>
    <link href="{{base_url()}}/assets_admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{base_url()}}/css/style.css" rel="stylesheet">
    <link href="{{base_url()}}/css/colors/blue.css" id="theme" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{base_url()}}/assets_admin/images/background/login-register.jpg);">        
            <div class="login-box card">
            <div class="card-body">
            <form class="form-horizontal form-material" method="POST" id="loginform" action="{{base_url('Verifylogin')}}">
                    <h3 class="box-title m-b-20">Inicio de sesión</h3>
                    <span class="label label-warning"><?php echo validation_errors(); ?></span>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="Usuario"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Contraseña"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        
    </section>
    <script src="{{base_url()}}/assets_admin/plugins/jquery/jquery.min.js"></script>
    <script src="{{base_url()}}/assets_admin/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{base_url()}}/assets_admin/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{base_url()}}/js/jquery.slimscroll.js"></script>
    <script src="{{base_url()}}/js/waves.js"></script>
    <script src="{{base_url()}}/js/sidebarmenu.js"></script>
    <script src="{{base_url()}}/assets_admin/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="{{base_url()}}/assets_admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="{{base_url()}}/js/custom.min.js"></script>
    <script src="{{base_url()}}/assets_admin/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>