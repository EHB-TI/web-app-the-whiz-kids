<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href=" {{ route('content.index') }} ">OSD Events</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('content.index') }} ">HOME
                        @if (Request::is('/'))
                        <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->is('calendar') ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('content.calendar') }} ">KALENDER
                        @if (Request::is('calendar'))
                        <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('content.about') }} ">OVER ONS
                        @if (Request::is('about'))
                        <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="language" src="https://cdn.webshopapp.com/shops/94414/files/54693228/nederland-vlag-afbeelding-gratis-downloaden.jpg" alt="">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><img class="language" src="https://cdn.webshopapp.com/shops/94414/files/54693228/nederland-vlag-afbeelding-gratis-downloaden.jpg" alt=""> Nederlands</a>
                        <a class="dropdown-item" href="#"><img class="language" src="https://cdn.webshopapp.com/shops/94414/files/54002808/frankrijk-vlag-icon-gratis-downloaden.jpg" alt=""> Français</a>
                        <a class="dropdown-item" href="#"><img class="language" src="https://cdn.webshopapp.com/shops/94414/files/54956666/het-verenigd-koninkrijk-vlag-icon-gratis-downloade.jpg" alt=""> English</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>