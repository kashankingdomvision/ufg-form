<nav class="main-header navbar navbar-expand navbar-white navbar-light">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        {{ (Auth::user()->name) }}
        &nbsp;&nbsp;<i class="fa fa-user" aria-hidden="true"></i>
      </a>


      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
          <a href="{{ route('users.edit', [encrypt(Auth::id()), 'profile']) }}" class="dropdown-item">
            <i class="fas fa-user-edit mr-2"></i>Edit Profile
          </a>   
          <div class="dropdown-divider"></div>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" >
            @csrf
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>    
          </form>

          {{-- <a href="#" >
            <i class="fas fa-sign-out-alt mr-2"></i>Logout --}}
            {{-- <span class="float-right text-muted text-sm">2 days</span> --}}
          {{-- </a> --}}

      </div>
    </li>

  </ul>
</nav>
