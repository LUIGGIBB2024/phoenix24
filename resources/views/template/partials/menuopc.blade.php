<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-item">
                    <a href="{{"/"}}" class="active"> <i class="menu-icon fa fa-home"></i>Inicio</a>
                </li>
                <!--<li class="menu-title">Menú Principal</li> -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Ventas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-bar-chart"></i><a href="{{url('ventas/consultarventas')}}">Ventas Diarias</a></li>
                        <li><i class="menu-icon fa fa-list"></i><a href="#">Reportar Entregas</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cubes"></i>Inventarios</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-list-alt"></i><a href="{{url('inventarios/consultar')}}">Consultar Saldos</a></li>
                        <!--<li><i class="menu-icon fa fa-database"></i><a href="{{url('productos/consultar')}}">Actualizar Productos</a></li>-->
                        <li><i class="menu-icon fa fa-camera-retro"></i><a href="{{url('productos/consultar')}}">Productos (Fotos)</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon pe-7s-cash"></i>Consultar Cartera</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-money"></i><a href="{{url('cartera/consultarcartera')}}">Cartera Resumida</a></li>
                        <li><i class="menu-icon fa fa-map-marker"></i><a href="{{url('cartera/consultarcarteramapa')}}">Google MAP</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Consultar CxP</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-book"></i><a href="{{url('cuentasxpagar/consultarcxp')}}">CxP Resumida</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-card-o"></i>Consultar Ingresos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-id-card-o"></i><a href="{{url('recibos/consultarrecibos')}}">Rc Caja Detallados</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book-o"></i>Consultar Pagos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-address-book-o"></i><a href="{{url('egresos/consultaregresos')}}">Egresos Detallados</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Pedidos/Ordenes</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-cart-plus"></i><a href="{{url('pedidos/consultarpedidos')}}">Consultar Pedidos</a></li>
                        <li><i class="menu-icon fa fa-file-text-o"></i><a href="{{url('pedidos/consultarpedidos')}}">Consultar Ordenes</a></li>

                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pencil-square-o"></i>Actualizaciones</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-camera-retro"></i><a href="{{url('productos/consultar')}}">Productos (Fotos)</a></li>
                        <li><i class="menu-icon fa fa-map-o"></i><a href="{{url('clientes/consclientes')}}">Ubicación (Clientes)</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-line-chart"></i>Estadísticas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="{{url('totales/ventas')}}">Ventas Mensuales</a></li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Por Productos</a></li>
                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Por Clientes</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Configuración</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-cogs"></i><a href="maps-gmap.html">Tabla de Control</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</aside>
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    @include('template.partials.headernew')
    <!-- Content -->

</div>
 <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
 <script defer="" src="{{ asset('js/menuside/popper.min.js') }}">  </script>
 <script defer="" src="{{ asset('js/menuside/bootstrap.min.js') }}">  </script>
 <script defer="" src="{{ asset('js/menuside/main.js')}}">  </script>
 <script defer="" src="{{ asset('js/menuside/jquery.matchHeight.min.js') }}"></script>

