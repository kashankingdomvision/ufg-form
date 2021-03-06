<nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-shadow">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto mr-1">
    <li class="nav-item dropdown border rounded">
      <a class="nav-link align-middle" data-toggle="dropdown" href="#">
        <i class="fa fa-user text-dark pr-1" aria-hidden="true"></i>
        <span class="text-dark">{{ (Auth::user()->name) }}</span> &nbsp;
        <i class="fa fa-caret-down text-secondary" aria-hidden="true"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm border">
        <div class="dropdown-divider"></div>
        <a href="{{ route('users.edit', [encrypt(Auth::id()), 'profile']) }}" class="dropdown-item">
          <i class="fas fa-user-edit mr-2 text-dark"></i>Edit Profile
        </a>   
        <div class="dropdown-divider"></div>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" >
          @csrf
          <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
            <i class="fas fa-sign-out-alt mr-2 text-red"></i>Logout
          </a>    
        </form>
      </div>
    </li>
  </ul>
  
</nav>

{{-- <a href="#" >
  <i class="fas fa-sign-out-alt mr-2"></i>Logout --}}
  {{-- <span class="float-right text-muted text-sm">2 days</span> --}}
{{-- </a> --}}
