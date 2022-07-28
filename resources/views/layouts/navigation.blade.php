<header class="header-dashboard">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}">
              <img src="{{ asset('img/logo.png') }}" alt="" class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                @auth
              <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
              @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('View Applications'))
              <a class="nav-link active" href="{{ route('applications.index') }}">Applications</a>
              @endif
              <li class="nav-item dropdown" style="display:none;">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    User Management
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a></li>
                  </ul>
              </li>
              @endauth

              @guest
              <a class="nav-link btn login-btn" href="{{ route('login') }}">Login</a>
              @endguest
              @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="nav-link btn login-btn" href="javascript:void(0)"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
              @endauth
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!-- Header End -->
