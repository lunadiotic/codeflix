<nav class="navbar fixed-top navbar-expand-lg bg-body-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <i class="text-white fa-solid fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">
            <img class="navbar-icon" src="assets/img/codeflix_logo.png" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <x-category-nav />
            <form class="d-flex me-md-5" role="search">
                <input class="form-control search-box" type="search" placeholder="Cari Disini" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </form>
            <ul class="pt-3 nav-icon d-flex">
                <li class="dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-bell bell-icon"></i>
                    </a>
                    <ul class="dropdown-menu notification">
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Clock.png" alt="">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">Subscribe Premium<br>Telah Habis!</p>
                                    <span class="notification-date">Hari Ini</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Kingkong.png" alt="">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">Film Baru</p>
                                    <p class="multi-line-text-new-movie">Khong Guan Super</p>
                                    <span class="notification-date">1 Hari Yang Lalu</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Blackhat.png" alt="">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">Film Baru</p>
                                    <p class="multi-line-text-new-movie">Black Hat</p>
                                    <span class="notification-date">2 Hari Yang Lalu</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Kingkong.png" alt="">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">Film Baru</p>
                                    <p class="multi-line-text-new-movie">Laugh Tate</p>
                                    <span class="notification-date">2 Hari Yang Lalu</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-user user-icon"></i>
                    </a>
                    <ul class="dropdown-menu user-info">
                        <li><a class="dropdown-item user-info-item" href="#"><i
                                    class="fa-solid fa-circle-user"></i> Profile Setting</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a class="dropdown-item user-info-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fa-solid fa-right-from-bracket"></i>
                                Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
