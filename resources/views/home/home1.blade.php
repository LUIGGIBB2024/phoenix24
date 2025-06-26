<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Inicio BFC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="icon" href="{{asset('homeinicial/images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900">
    <link rel="stylesheet" href="{{asset('homeinicial/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('homeinicial/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('homeinicial/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">



    <style>
        .logoempresa
        {
          width: 100px !important;
          height: 40px !important;
          object-fit:contain;
        }
        .rd-navbar-main-element
        {
          margin-top:-2em;
        }
        .imagencontenido
        {
          width:100% !important;
          height: auto !important;
          max-width: auto !important;
          max-height: auto !important;
         margin-top: 1%;
        }

        @supports(object-fit: cover)
        {
          .imagencontenido
          {
            height: 100%;
            object-fit: contain;
            object-position: center center;
          }
        }
        .d-block {
           color: rgb(11, 133, 47);
        }
        .lead {
          color: rgb(11, 133, 47);
        }
       .encab_home
       {
         margin-top:-0.5em;
         padding:5px;
       }
       .rd-navbar-main-inner
       {
         background-color: rgb(247, 14, 14) !important;
       }
       .footer-classic {
          display:inline;
       }

       .footer-classic
       {
          background-color:black !important;
       }
    </style>

    <style>
        .ie-panel
        {
            display: none;background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);
            clear: both;text-align:center;
            position: relative;z-index: 1;
        }
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel
        {display: block;}
    </style>
  </head>
  <body>
    <div class="ie-panel"><a href="#"><img src="" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
     <div class="preloader">
     <div class="preloader-body">
        <div class="loader">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <p>Cargando...</p>
      </div>
    </div>
    <div class="page"><a class="banner banner-top" href="#" target="_blank"><img src="" alt="" height="0"></a>
      <header class="section page-header rd-navbar-transparent-wrap">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-transparent" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-aside-outer rd-navbar-collapse">
              <div class="rd-navbar-aside">
                <div class="rd-navbar-info" style="display: flex;">
                  <img class="logoempresa" src="{{asset('homeinicial/images/bfcsas.png')}}" alt="" />
                  <div class="icon novi-icon mdi mdi-phone" style="float: right;">
                      <a href="tel:#" class="encab_home">+57 (300) 664 4322</a><br>
                      <span class="encab_home">Cra 7a # 41-18 -  Valledupar</span>
                  </div>
                </div>
                <ul class="list-lined">
                  <li><a href="{{ route('login') }}">Login:</a></li>
                  <li><a href="#">Registrase:</a></li>
                </ul>
              </div>
            </div>
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main-inner" style="height:30px !important;">
                <div class="rd-navbar-main">
                  <!--RD Navbar Panel-->
                  <div class="rd-navbar-panel">
                    <!--RD Navbar Toggle-->
                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    <!--RD Navbar Brand-->
                    <div class="rd-navbar-brand">
                      <!--Brand-->
                         <a class="brand" href="index.html"> </a>
                    </div>
                  </div>
                  <div class="rd-navbar-main-element" >
                    <div class="rd-navbar-nav-wrap">
                      <ul class="rd-navbar-nav">
                        <li class="rd-nav-item active"><a class="rd-nav-link" href="#">Home</a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="#">Acerda de</a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="#">Contactos</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!--Swiper-->
      <section class="section swiper-container swiper-slider swiper-slider-1 context-dark" data-loop="true" data-autoplay="5000" data-simulate-touch="false">
        <div class="swiper-wrapper">
          <div class="swiper-slide imagencontenido" data-slide-bg="{{asset('homeinicial/images/imagenbfc03.jpeg')}}">
            <div class="swiper-slide-caption section-lg">
              <div class="container">
                <div class="row">
                  <div class="col-md-9 col-lg-7 offset-md-1 offset-xxl-0"  style="display:none;">
                    <h1><span class="d-block" data-caption-animate="fadeInUp" data-caption-delay="100">Profesionales en Servicios</span><span class="d-block text-light" data-caption-animate="fadeInUp" data-caption-delay="200">Expertos en Llantas/Baterias/Mecánica Rápida</span></h1>
                    <p class="lead" data-caption-animate="fadeInUp" data-caption-delay="350">Brindamos al Cliente la atención que se merece</p>
                    <div class="button-wrap-default" data-caption-animate="fadeInUp" data-caption-delay="450"><a class="button button-secondary-text" href="#">Leer Más</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide imagencontenido" data-slide-bg="{{asset('homeinicial/images/imagenbfc02.jpeg')}}">
            <div class="swiper-slide-caption section-lg">
              <div class="container">
                <div class="row">
                  <div class="col-md-9 col-lg-7 offset-md-1 offset-xxl-0" style="display:none;">
                    <h1><span class="d-block" data-caption-animate="fadeInUp" data-caption-delay="100">Full Accounting Support</span><span class="d-block text-light" data-caption-animate="fadeInUp" data-caption-delay="200">for Your Business</span></h1>
                    <p class="lead" data-caption-animate="fadeInUp" data-caption-delay="350">Get rid of any accounting issues with our team’s assistance.</p>
                    <div class="button-wrap-default" data-caption-animate="fadeInUp" data-caption-delay="450"><a class="button button-secondary-text" href="#">Read more</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide imagencontenido" data-slide-bg="{{asset('homeinicial/images/imagenbfc01.jpeg')}}">
            <div class="swiper-slide-caption section-lg">
              <div class="container">
                <div class="row">
                  <div class="col-md-9 col-lg-7 offset-md-1 offset-xxl-0" style="display:none;">
                    <h1><span class="d-block" data-caption-animate="fadeInUp" data-caption-delay="100">#1 Tax Services Provider</span><span class="d-block text-light" data-caption-animate="fadeInUp" data-caption-delay="200">Since the Late 1990s</span></h1>
                    <p class="lead" data-caption-animate="fadeInUp" data-caption-delay="350">We offer specialist tax knowledge and full 24/7 support.</p>
                    <div class="button-wrap-default" data-caption-animate="fadeInUp" data-caption-delay="450"><a class="button button-secondary-text" href="#">Read more</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Swiper Pagination-->
        <div class="swiper-pagination-wrap">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-7 offset-md-1 offset-xxl-0">
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Icon List 2-->
      <section class="section section-sm section-sm-bottom-100 bg-primary">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 wow fadeInUp">
              <div class="box-icon-2">
                <div class="icon mercury-icon-calc"></div>
                <h5 class="title">Servicios Especializados</h5>
                <p class="text">Ofrecemos una completa gama de servicios, además de la venta de llantas, baterias, accesorios, y llanatería.</p>
              </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
              <div class="box-icon-2">
                <div class="icon novi-icon mercury-icon-chart"></div>
                <h5 class="title">Nuestros Servicios</h5>
                <p class="text">Alineación, Balanceo, Montallantas, Mecánica Rápida y Revisión de Baterias</p>
              </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
              <div class="box-icon-2">
                <div class="icon novi-icon mercury-icon-time-sand"></div>
                <h5 class="title">Baterias TUDOR (SERVITECA)</h5>
                <p class="text">Somos Distriuidor autorizado, para el Cesar y la Guajira de Baterías TUDOR</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer class="section footer-classic">
        <div class="footer-inner-1">
          <div class="container">
            <div class="row row-40">
              <div class="col-md-5 col-lg-3">
                <h5>Contactanos</h5>
                <ul class="contact-list font-weight-bold" style="display:block;">
                  <li>
                    <div class="unit unit-spacing-xs">
                      <div class="unit-left">
                        <div class="icon icon-sm icon-primary novi-icon mdi mdi-map-marker"></div>
                      </div>
                      <div class="unit-body"><a href="#">Cra 7a # 41-180 <br>Barrio 12 de Octubre, Valledupar</a></div>
                    </div>
                  </li>
                  <li>
                    <div class="unit unit-spacing-xs">
                      <div class="unit-left">
                        <div class="icon icon-sm icon-primary novi-icon mdi mdi-phone"></div>
                      </div>
                      <div class="unit-body"><a href="tel:#">+57 (300) 664 4322</a></div>
                    </div>
                  </li>
                  <li>
                    <div class="unit unit-spacing-xs">
                      <div class="unit-left">
                        <div class="icon icon-sm icon-primary novi-icon mdi mdi-clock"></div>
                      </div>
                      <div class="unit-body">
                        <ul class="list-0">
                          <li>Dias Laborables (Lunes-Sábados): 08:00–18:00</li>
                          <li>Domingos y Festivos:08:00- 12:000</li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul><a class="d-inline-block big" href="mailto:#">ventas@barfacar.com</a>
              </div>
            </div>
          </div>
        </div>
              <!--<div class="col-md-6 col-lg-5">
                <h5>Links</h5>
                <div class="row row-5 justify-content-between">
                  <div class="col-sm-6">
                    <ul class="footer-list big">
                      <li><a href="#">IRS Publications</a></li>
                      <li><a href="#">Record Retention Guide</a></li>
                      <li><a href="#">Tax Due Dates</a></li>
                      <li><a href="#">Tax Forms</a></li>
                      <li><a href="#">Tax Rates</a></li>
                      <li><a href="#">Where is my refund?</a></li>
                      <li><a href="#">Retirement</a></li>
                    </ul>
                  </div>
                  <div class="col-sm-4 col-lg-6 col-xxl-5">
                    <ul class="footer-list big">
                      <li><a href="#">Retirement</a></li>
                      <li><a href="#">Investment</a></li>
                      <li><a href="#">Real Estate</a></li>
                      <li><a href="#">Insurance</a></li>
                      <li><a href="#">Tax</a></li>
                      <li><a href="#">Money</a></li>
                      <li><a href="#">Other Resources</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-4">
                <h5>Partners</h5>
                <div class="row row-30 align-items-center text-center">
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-1-144x70.png" alt="" width="144" height="35"/></a></div>
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-2-121x68.png" alt="" width="121" height="34"/></a></div>
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-3-121x33.png" alt="" width="121" height="16"/></a></div>
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-4-101x76.png" alt="" width="101" height="38"/></a></div>
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-5-107x53.png" alt="" width="107" height="26"/></a></div>
                  <div class="col-6 col-md-4 col-lg-6"><a class="link-image" href="#"><img src="images/footer-1-brand-6-97x52.png" alt="" width="97" height="26"/></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-inner-2">
          <div class="container">
            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. All Rights Reserved. Design by <a href="https://www.templatemonster.com">TemplateMonster</a></p>
          </div>
        </div>-->
      </footer>
    </div>
    <div class="snackbars" id="form-output-global"></div>
    <script src="{{asset('homeinicial/js/core.min.js')}}"></script>
    <script src="{{asset('homeinicial/js/script.js')}}"></script>
    <!--coded by Starlight-->
  </body>
</html>
