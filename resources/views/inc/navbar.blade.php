<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- SEARCH FORM -->
  {{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search Student" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          this si smys snsishfbhf
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-center" data-toggle="dropdown" href="#">
           
        </a>
      </li>
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user-alt"></i>
        
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/storage/storage/{{Auth::user()->photo}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                {{Auth::user()->othername}}
              </h3>
              <p class="text-sm text-muted"><small>Joined:  {{Auth::user()->created_at}}</small></p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        
       
        <div class="dropdown-divider"></div>
        <div class="d-flex justify-content-between">
          <a href="/myprofile" class="btn btn-default">Profile</a>
          <a href="/logout" class="btn btn-default">SignOut</a>
        </div>
        
      </div>
    </li>
    
    
  </ul>
</nav>

