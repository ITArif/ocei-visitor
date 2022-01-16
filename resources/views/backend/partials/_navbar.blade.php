<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- SEARCH FORM -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i>{{session('name')}}
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{session('name')}}</span>
        <div class="dropdown-divider"></div>
        <div class="dropdown-divider"></div>
        <a href="#" onclick="document.getElementById('visitor.logout').submit()" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Logout
          <span class="float-right text-muted text-sm"></span>
        </a>
        <form id="visitor.logout" action="{{route('visitor.logout')}}" method="post" style="display: none">
            @csrf
        </form>
        <div class="dropdown-divider"></div>
      </div>
    </li>
  </ul>
</nav>