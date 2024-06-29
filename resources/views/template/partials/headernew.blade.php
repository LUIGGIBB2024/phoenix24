<!-- Header-->
<header id="header" class="header color-header">
    <div class="top-left">
        <div class="navbar-header color-header" >
            <a class="navbar-brand color-header" href="./" style="text-align: center;"><img src="{{asset('img/logo.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden color-header" href="./"><img src="{{asset('img/logo1.png')}}" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars" style="font-size:30px;color:rgb(109, 107, 107);"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">

                <a style="font-size:11px;"><strong>{{Auth::user()->name}}</strong></a>

                <!--<button class="search-trigger"><i class="fa fa-search" style="font-size:20px;color:rgb(109, 107, 107);"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div> -->

                <div class="dropdown for-notification">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" style="font-size:20px;color:rgb(109, 107, 107);"></i>
                        <span class="count bg-danger">3</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="notification">
                        <p class="red">You have 3 Notification</p>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-check"></i>
                            <p>Server #1 overloaded.</p>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-info"></i>
                            <p>Server #2 overloaded.</p>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-warning"></i>
                            <p>Server #3 overloaded.</p>
                        </a>
                    </div>
                </div>

                <div class="dropdown for-message">
                   <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="count bg-primary">4</span>
                    </button>
                   <div class="dropdown-menu" aria-labelledby="message">
                        <p class="red">You have 4 Mails</p>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Jonathan Smith</span>
                                <span class="time float-right">Just now</span>
                                <p>Hello, this is an example msg</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Jack Sanders</span>
                                <span class="time float-right">5 minutes ago</span>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Cheryl Wheeler</span>
                                <span class="time float-right">10 minutes ago</span>
                                <p>Hello, this is an example msg</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Rachel Santos</span>
                                <span class="time float-right">15 minutes ago</span>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </a>

                    </div> -->

                </div>
            </div>

            <div class="user-area dropdown float-right">
                <div class="widget-content-left">
                    <!--<div><strong style="font-size: .7rem"> {{ Auth::user()->name }}</strong></div>
                    <div class="widget-subheading opacity-8">
                        {{ Auth::user()->rol }}
                    </div>-->
                </div>
                <a href="#" class="dropdown-toggle active" style="right:0px !important;" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" >
                    <!--<img class="user-avatar rounded-circle"
                        src="{{ asset('img') }}/usuarios/{{ Auth::user()->avatar }}" alt="User Avatar"> -->
                    <img class="user-avatar rounded-circle"
                        src="{{ asset('img/usuarioconectado.jpg')}}" alt="User Avatar">
                </a>
                <!--<a>{{Auth::user()->name}}</a>-->
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                    <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span
                            class="count">13</span></a>

                    <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>
                    <li class="nav-item-btn text-center nav-item nav-item me-3 me-lg-0">
                        <a class="btn-wide btn btn-primary btn-sm " href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </div>

            </div>

        </div>
    </div>
</header>

