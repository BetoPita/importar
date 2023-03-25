<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile"
            style="background: url({{ base_url() }}assets_admin/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ base_url() }}assets_admin/images/users/profile.png" alt="user" />
            </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="true">{{ $_SESSION['nombre'] }}</a>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Admin</li>
                @if ($_SESSION['perfil_id'] == 1)
                    <li>
                        <a href="{{ base_url('import') }}" aria-expanded="false"><i class="fa fa-file"></i><span
                                class="hide-menu">Importar</span></a>
                    </li>
                    <li>
                        <a href="{{ base_url('import/informacion') }}" aria-expanded="false"><i
                                class="fa fa-file"></i><span class="hide-menu">Información importada</span></a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{ base_url('login/cerrar_sesion') }}" class="link" data-toggle="tooltip" title="Cerrar sesión"><i
                class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>
