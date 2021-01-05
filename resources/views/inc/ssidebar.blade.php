<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src='/storage/storage/livepetal.png' alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">FINSMART</span>
  </a>
{{-- DESKTOP-I4LD4M4 <?php //$sinfo = session()->get('sinfo'); ?> --}}
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/storage/storage/{{Auth::user()->photo}}" class="img-circle" alt="User Image">
      </div>
      <div class="info">
          <p class="text-white"><span class="mr-1">{{ Auth::user()->surname.' '. Auth::user()->othername}}</span></p>
          
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="/dashboard" class="nav-link active">
            <i class="fa fa-home"></i>
            <p>
              Dashboard 
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="/myprofile" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>My Profile</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Manage Loans
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/usercreateloan" class="nav-link">
                <i class="fas fa-money-check nav-icon"></i>
                <p>Loan Applications</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/loanrecords" class="nav-link">
                <i class="fas fa-money-check nav-icon"></i>
                <p>Loan Records</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/paymentmethod" class="nav-link">
                <i class="fas fa-money-check nav-icon"></i>
                <p>Link Debit/Credit Cards</p>
              </a>
            </li>
          </ul>
        </li>  
        
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-money-check-alt"></i>
              <p>Manage Savings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
  
              <li class="nav-item">
                <a href="/createsavings" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Create Savings Plan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/savingsaccount" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Savings Records</p>
                </a>
              </li>
            </ul>
          </li>   

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-money-check-alt"></i>
              <p>Manage Investment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
  
              <li class="nav-item">
                <a href="/createinvestment" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>New Investment Plan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentorders" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Investment Records</p>
                </a>
              </li>
            </ul>
          </li>   
         
          <li class="nav-item has-treeview menu-open">
            <a href="/logout" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
               LogOut
              </p>
            </a>
          </li>


         
        
        <li class="nav-item has-treeview">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            {{-- <x-jet-responsive-nav-link href="{{ route('logout') }}" class="btn btn-block btn-danger" onclick="event.preventDefault(); this.closest('form').submit();">
               <i class="fa fa-power-off"></i> Logout
            </x-jet-responsive-nav-link> --}}
          </form>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
