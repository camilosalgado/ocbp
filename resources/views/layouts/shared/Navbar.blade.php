<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm mb-5" style="color: white;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/login') }}" style="font-weight: bold; padding: 0;">
            <img src="{{ asset('assets/images/logo_icon.png') }}" alt="NavbarBrandLogo" style="max-height: 35px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth()
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <sub-header :userrol="{{ auth()->user()->id_rol }}"></sub-header>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-weight: bold">
                            {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
