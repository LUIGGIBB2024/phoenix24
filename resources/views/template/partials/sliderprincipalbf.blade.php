

    <style>
        @media only screen and (max-width: 550px)
        {


            .carousel-inner
            {
               width: 25em !important;
               margin-left:-3.7em !important;
                /*width:100% !important; */
            }
            .container_home
            {
               margin-top:-4em !important;
            }

            .carousel-control-prev, .carousel-control-next
            {
                 margin-top:7em !important;
            }

            img {
                height: 100%;
                width: 100%;
                object-fit: contain;
               }
               .cat {
                height:300px;
               }

            ol .carousel-indicators
            {
              margin-top: 4em !important;
            }

            .carousel-item
            {
                margin-top: -3.0rem !important;
            }
            .carousel-item img
            {
              height: 175px !important;
            }

        }

    </style>
<div class="slider-content">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div>
            <!--<img src="{{asset('img/imagen04.jpg')}}" alt="">-->
         </div>
        <div class="carousel-inner">
            @foreach ($contenidos as $coleccion)
                <div class="carousel-item container_home {{ $loop->index==0? 'active' : '' }} col-sm-12" align="center">
                    <img class="imagencarrusel01" src="{{asset('img/contenidos_image/'.$coleccion->imagen)}}" alt="First slide">
                    <!--<img class="imagencarrusel01" src="{{asset('img/imagen04.jpg')}}" alt="First slide">-->
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span></a>
    </div>
</div>
