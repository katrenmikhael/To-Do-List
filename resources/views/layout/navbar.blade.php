<nav class="navbar navbar-expand-lg position-absolute top-0 w-100">
    <div class="container">
        <a class="navbar-brand" href="#"><span class="fs-4 fw-bold"><i
                    class="fa-solid fa-check-double text-dark fs-2 fw-bolder"></i></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('/') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
