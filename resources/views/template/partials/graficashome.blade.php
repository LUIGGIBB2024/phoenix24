@php
    $totalventas    = session('vs_totalventas');
    $totalpedidos   = session('vs_totalpedidos');
    $totalcartera   = session('vs_totalcartera');
    $totalcxp       = session('vs_totalcxp');
    $anoproceso     = session('vs_anoproceso');
    if (Auth::user()->tipodeusuario == 2)
    {
        $totalventas    = 0;
        $totalpedidos   = 0;
        $totalcartera   = 0;
        $totalcxp       = 0;
        $anoproceso     = 0;  
    }
@endphp
<div class="content">
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text" ><span style="color:black;margin-left:-16px;">{{number_format($totalventas)}}</span></div>
                                    <div class="stat-heading">Ventas Totales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span style="color:black;margin-left:-16px;">{{number_format($totalpedidos)}}</span></div>
                                    <div class="stat-heading">Total Pedidos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span style="color:black;margin-left:-16px;">{{number_format($totalcartera)}}</span></div>
                                    <div class="stat-heading">Saldo Cartera</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-portfolio"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span style="color:black;margin-left:-16px;">{{number_format($totalcxp)}}</span></div>
                                    <div class="stat-heading">Saldo CxP</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <!--  Ventas  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Ventas Mensuales {{$anoproceso}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card-body">
                                <!-- <canvas id="TrafficChart"></canvas>   -->
                                <div id="traffic-chart" class="traffic-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Visitantes</h4>
                                    <div class="por-txt">96,930 Usuarios (40%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Porcentaje de Rebote</h4>
                                    <div class="por-txt">3,220 Usuarios (24%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Visitantes Únicos</h4>
                                    <div class="por-txt">29,658 Usuarios (60%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Visitantes Objetivos</h4>
                                    <div class="por-txt">99,658 Usuarios (90%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div>
                    </div> <!-- /.row -->
                    <div class="card-body"></div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <!-- Orders -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-8">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-lg-6 col-xl-12">
                                <div class="card br-0">
                                     <div class="card-body">
                                         <div class="chart-container ov-h">
                                              <div id="flotPie1" class="float-chart" ></div>
                                         </div>
                                    </div>
                                </div><!-- /.card -->
                            </div>

                            <div class="col-lg-6 col-xl-12" style="display:none;">
                                <div class="card bg-flat-color-3  ">
                                    <div class="card-body">
                                         <h4 class="card-title m-0  white-color ">August 2018</h4>
                                    </div>
                                    <div class="card-body">
                                         <div id="flotLine5" class="flot-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-4 -->
                </div>
            </div>
            <!-- /.orders -->
            <!-- To Do and Live Chat -->

            <!-- /To Do and Live Chat -->
            <!-- Calender Chart Weather  -->
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="box-title">Chandler</h4> -->
                            <div class="calender-cont widget-calender">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>

                <div class="col-lg-4 col-md-6" >
                    <div class="card ov-h" >
                        <div class="card-body bg-flat-color-2">
                            <div id="flotBarChart" class="float-chart ml-4 mr-4"></div>
                        </div>
                        <div id="cellPaiChart" class="float-chart"></div>
                    </div><!-- /.card -->
                </div>
                <div class="col-lg-4 col-md-6" style="display: none;">
                    <div class="card weather-box">
                        <h4 class="weather-title box-title" >Weather</h4>
                        <div class="card-body">
                            <div class="weather-widget">
                                <div id="weather-one" class="weather-one"></div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /Calender Chart Weather -->
            <!-- Modal - Calendar - Add New Event -->
            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add New Event</strong></h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#event-modal -->
            <!-- Modal - Calendar - Add Category -->
            <div class="modal fade none-border" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add a category </strong></h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Choose Category Color</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="info">Info</option>
                                            <option value="pink">Pink</option>
                                            <option value="primary">Primary</option>
                                            <option value="warning">Warning</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /#add-category -->
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner bg-slate-500">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2022 Enlace Visual
                </div>
                <div class="col-sm-6 text-right">
                    Diseñado por <a href="https://colorlib.com">Enlace Visual</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
