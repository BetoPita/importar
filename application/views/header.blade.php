<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{base_url('inicio')}}">
                <b>
                    <img src="{{ base_url() }}assets_admin/images/logo-icon.png" alt="homepage" class="dark-logo" />
                    <img src="{{ base_url() }}assets_admin/images/logo_jbc.png" alt="homepage" class="light-logo" />
                </b>
                <span>
                    <img src="{{ base_url() }}assets_admin/images/logo-text.png" alt="homepage" class="dark-logo" />
                    <!--<img src="{{ base_url() }}assets_admin/images/logo-light-text.png" class="light-logo" alt="homepage" />-->
                </span>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                        href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item"> <a
                        class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{{ base_url() }}assets_admin/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li><a href="{{base_url('administradores/perfil')}}"><i class="fa fa-user"></i>Mi perfil</a></li>
                            <li><a href="{{base_url('login/cerrar_sesion')}}"><i class="fa fa-power-off"></i>Cerrar sesión</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
