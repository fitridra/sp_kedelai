<!-- ##### Header Area Start ##### -->
<header class="header-area">

    <!-- ***** Navbar Area ***** -->
    <div class="alazea-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="alazeaNav">

                    <!-- Nav Brand -->
                    <a href="{{route('dashboard')}}" class="nav-brand"><img src="{{asset('assets/user/img/core-img/logo.png')}}" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Navbar Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('konsultasi')}}">Konsultasi Hama</a></li>
                                <li><a href="{{route('riwayat',Auth::user()->id)}}">Riwayat Konsultasi</a></li>
                                <li><a href="{{route('info_hama')}}">Informasi Hama</a></li>
                                <li><a href="{{route('logout')}}">Logout</a></li>
                            </ul>

                        </div>
                        <!-- Navbar End -->
                    </div>
                </nav>

            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->