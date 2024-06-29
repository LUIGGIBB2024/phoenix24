<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>

    <div class="scrollbar-sidebar cotainer-menu-laterar" style="overflow: auto;">
        <div class="app-sidebar__inner">

            <ul class="vertical-nav-menu">
                <li>
                    <a href="{{url('/')}}">
                        <i class="metismenu-icon pe-7s-home pe-fw icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Inicio
                    </a>
                    <a href="{{url('ventas/consultarventas')}}">
                        <i class="metismenu-icon pe-7s-graph2 icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Consultar Ventas
                    </a>
                    <a href="{{url('cartera/consultarcartera')}}">
                       <i class="metismenu-icon lnr-store icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Consultar Cartera
                    </a>
                    <a href="{{url('cartera/consultarcarteramapa')}}">
                        <i class="metismenu-icon pe-7s-map-marker icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Consultar Cartera (Google MAP)
                    </a>
                    <a href="{{url('recibos/consultarrecibos')}}">
                        <i class="metismenu-icon pe-7s-portfolio icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Consultar Recibos de Caja
                    </a>
                    <a href="{{url('egresos/consultaregresos')}}">
                        <i class="metismenu-icon pe-7s-box1 icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Consultar Egresos
                    </a>
                    <a href="{{url('pedidos/consultarpedidos')}}">
                        <i class="metismenu-icon pe-7s-note2 icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Consultar Pedidos
                     </a>
                    <a href="{{url('cuentasxpagar/consultarcxp')}}">
                        <i class="metismenu-icon pe-7s-cash icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                         Consultar Cuentas x Pagar
                     </a>
                    <a href="{{url('clientes/consclientes')}}">
                        <i class="metismenu-icon lnr-users icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Actualizar Clientes
                    </a>
                    <a href="{{url('productos/consultar')}}">
                        <i class="metismenu-icon lnr-book icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Actualizar Productos
                    </a>
                    <a href="{{url('inventarios/consultar')}}">
                        <i class="metismenu-icon pe-7s-note icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Consultar Inventarios
                    </a>
                    <a href="{{url('inventarios/consultar')}}">
                        <i class="metismenu-icon pe-7s-graph3 icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                        Estadísticas
                    </a>
                    <a href="{{url('inventarios/consultar')}}">
                        <i class="metismenu-icon pe-7s-settings icon-gradient bg-premium-dark" style="font-weight: bold;"></i>
                       Configuración
                    </a
                </li>
                 {{-- funciones de contabilidad --}}
                 @if(Auth::user()->rol == 'Administrador' || Auth::user()->rol == 'Contabilidad')
                 @endif
            </ul>
        </div>
    </div>
</div>
