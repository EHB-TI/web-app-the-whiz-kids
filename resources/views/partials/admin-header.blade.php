<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-primary" id="menu-toggle">≡</button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" id="logout" href="{{ route('logout') }}">{{ __('Uitloggen') }}</a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
    <script nonce="2d30e9e8aa324eb0a04076c5abaff625">
        let logout = document.getElementById("logout")
        logout.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        })
    </script>
</nav>