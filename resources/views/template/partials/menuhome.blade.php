            <!-- Left Panel -->
            @php
                $indestado = 0;
                $fec1 = date('Y-m-d');
                $fec2 = date('Y-m-d');
            @endphp
            <aside id="left-panel" class="left-panel">
                <nav class="navbar navbar-expand-sm navbar-default">
                    <div id="main-menu" class="main-menu collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="menu-item">
                                <a href="{{"/"}}" class="active"> <i class="menu-icon fa fa-home"></i>Inicio</a>
                            </li>
                            <!--<li class="menu-title">Menú Principal</li> -->
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cubes"></i>Inventarios</a>
                                <ul class="sub-menu children dropdown-menu">
                                    <li><i class="menu-icon fa fa-life-ring"></i><a href="{{url('inventarios/consultar_saldos')}}">Saldos por Productos</a></li>
                                    @if (Auth::user()->tipodeusuario == 3 || Auth::user()->tipodeusuario == 1)    
                                        <li><i class="menu-icon fa fa-list-alt"></i><a href="{{url('inventarios/consultar')}}">Consultar Saldos</a></li>
                                        <!--<li><i class="menu-icon fa fa-database"></i><a href="{{url('productos/consultar')}}">Actualizar Productos</a></li>-->
                                        <li><i class="menu-icon fa fa-camera-retro"></i><a href="{{url('productos/consultar')}}">Productos (Fotos)</a></li>
                                        <li><i class="menu-icon fa fa-list"></i><a href="{{url('inventarios/consultar_documentos')}}">Documentos</a></li>
                                    @endif 
                                </ul>
                            </li>
                            
                            @if (Auth::user()->tipodeusuario == 3 || Auth::user()->tipodeusuario == 1)                               

                                <li class="menu-item-has-children dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Ventas</a>
                                    <ul class="sub-menu children dropdown-menu">
                                        <li><i class="menu-icon fa fa-bar-chart"></i><a href="{{url('ventas/consultarventas')}}">Ventas Diarias</a></li>
                                        <li><i class="menu-icon fa fa-list"></i><a href="{{url('ventas/reportarfacturas',['indestado'=>0])}}">Reportar Entregas</a></li>
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
                                        <li><i class="menu-icon fa fa-cogs"></i><a href="{{url('/user') }}">Usuarios (Registrar)</a></li>
                                        {{--  <li><i class="menu-icon fa fa-cogs"></i><a href="{{url('/contenidos/imagenes') }}">Contenidos</a></li>  --}}
                                    </ul>
                                </li>
                            @endif 
                        </ul>
                        
                    </div>
                </nav>
            </aside>
            <!-- Right Panel -->
            <div id="right-panel" class="right-panel">
                <!-- Header-->
                @php
                    $totalventas = 0;
                @endphp
                @include('template.partials.headernew')
                <!-- Content -->
                @include('template.partials.graficashome')

            </div>
            @yield('js')
            <!-- Scripts -->

            <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
            <script defer="" src="{{ asset('js/menuside/popper.min.js') }}">  </script>
            <script defer="" src="{{ asset('js/menuside/bootstrap.min.js') }}">  </script>
            <script defer="" src="{{ asset('js/menuside/jquery.matchHeight.min.js') }}"></script>
            <script defer="" src="{{ asset('js/menuside/main.js')}}">  </script>
            <script src="{{asset('js/menuside/init/fullcalendar-init.js')}}"></script>
            <!--  Chart js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

            <!--Chartist Chart-->
            <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
            <script src="{{asset('js/menuside/init/weather-init.js')}}"></script>

            <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>





        <script>
            jQuery(document).ready(function($) {
                "use strict";
                // Pie chart flotPie1
                var piedata = [
                    { label: "Ventas", data: [[1,32]], color: '#5c6bc0'},
                    { label: "Ingresos", data: [[1,33]], color: '#ef5350'},
                    { label: "Pagos", data: [[1,35]], color: '#66bb6a'}
                ];

                $.plot('#flotPie1', piedata, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            innerRadius: 0.65,
                            label: {
                                show: true,
                                radius: 2/3,
                                threshold: 1
                            },
                            stroke: {
                                width: 0
                            }
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                });
                // Pie chart flotPie1  End
                // cellPaiChart
                var cellPaiChart = [
                    { label: "Ventas Directas", data: [[1,65]], color: '#5b83de'},
                    { label: "Ventas Canal", data: [[1,35]], color: '#00bfa5'}
                ];
                $.plot('#cellPaiChart', cellPaiChart, {
                    series: {
                        pie: {
                            show: true,
                            stroke: {
                                width: 0
                            }
                        }
                    },
                    legend: {
                        show: false
                    },grid: {
                        hoverable: true,
                        clickable: true
                    }

                });
                // cellPaiChart End
                // Line Chart  #flotLine5
                var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

                var plot = $.plot($('#flotLine5'),[{
                    data: newCust,
                    label: 'New Data Flow',
                    color: '#fff'
                }],
                {
                    series: {
                        lines: {
                            show: true,
                            lineColor: '#fff',
                            lineWidth: 2
                        },
                        points: {
                            show: true,
                            fill: true,
                            fillColor: "#ffffff",
                            symbol: "circle",
                            radius: 3
                        },
                        shadowSize: 0
                    },
                    points: {
                        show: true,
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: false
                    }
                });
                // Line Chart  #flotLine5 End
                // Traffic Chart using chartist
                if ($('#traffic-chart').length) {

                    var chart = new Chartist.Line('#traffic-chart', {
                      labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                      series: [
                      [0, 18000, 35000,  25000,  22000,  23000],
                      [0, 33000, 15000,  20000,  15000,  300],
                      [0, 15000, 28000,  15000,  30000,  5000]
                      ]
                  }, {
                      low: 0,
                      showArea: true,
                      showLine: false,
                      showPoint: false,
                      fullWidth: true,
                      axisX: {
                        showGrid: true
                    }
                });

                    chart.on('draw', function(data) {
                        if(data.type === 'line' || data.type === 'area') {
                            data.element.animate({
                                d: {
                                    begin: 2000 * data.index,
                                    dur: 2000,
                                    from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                    to: data.path.clone().stringify(),
                                    easing: Chartist.Svg.Easing.easeOutQuint
                                }
                            });
                        }
                    });
                }
                // Traffic Chart using chartist End
                //Traffic chart chart-js
                if ($('#TrafficChart').length) {
                    var ctx = document.getElementById( "TrafficChart" );
                    ctx.height = 150;
                    var myChart = new Chart( ctx, {
                        type: 'line',
                        data: {
                            labels: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul" ],
                            datasets: [
                            {
                                label: "Visit",
                                borderColor: "rgba(4, 73, 203,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(4, 73, 203,.5)",
                                data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                            },
                            {
                                label: "Bounce",
                                borderColor: "rgba(245, 23, 66, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(245, 23, 66,.5)",
                                pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                            },
                            {
                                label: "Targeted",
                                borderColor: "rgba(40, 169, 46, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(40, 169, 46, .5)",
                                pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                            }
                            ]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            }

                        }
                    } );
                }
                //Traffic chart chart-js  End
                // Bar Chart #flotBarChart
                $.plot("#flotBarChart", [{
                    data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                    bars: {
                        show: true,
                        lineWidth: 0,
                        fillColor: '#ffffff8a'
                    }
                }], {
                    grid: {
                        show: false
                    }
                });
                // Bar Chart #flotBarChart End
            });
        </script>
