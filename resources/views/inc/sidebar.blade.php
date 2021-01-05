@php
    use App\Http\Controllers\Controller;
    $fin = new Controller;
@endphp
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

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-user-alt"></i>
            <p>Manage Clients
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/clients" class="nav-link">
                <i class="fas fa-user-alt"></i>
                <p>Registered Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/newclient" class="nav-link">
                <i class="fas fa-user-alt"></i>
                <p>Add New Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/displayclients" class="nav-link">
                <i class="fas fa-search"></i>
                <p>Search Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/smsclients" class="nav-link">
                <i class="fas fa-sms"></i>
                <p>SMS Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/emailclients" class="nav-link">
                <i class="fas fa-envelope"></i>
                <p>Email Clients</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-money-check-alt"></i>
              <p>Manage Loans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/loansetup" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Loan Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/activateloan" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Create Loan Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loanapplications" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Loan Applications</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countLoans(1)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loanapproved" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Approved Loans</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countLoans(2)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loanprocessing" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Processing Loans</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countLoans(3)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loandisbursed" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Disbursed Loans</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countLoans(4)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loanterminated" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Liquidated Loans</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countLoans(5)?>
                   </span>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-wallet"></i>
              <p>Manage Savings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/savingssetup" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Savings Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/activatesavings" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Create Savings Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/inactivesavingsaccount" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Inactive Savings Account</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countSavings(1)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/adminsavingsaccount" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Active Savings</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countSavings(2)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/expiredsavingsaccount" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Liquidated Savings</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countSavings(3)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/savingsdeposits" class="nav-link">
                  <i class="fas fa-wallet"></i>
                  <p>Savings Deposits</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-coins"></i>
              <p>Manage Investment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/investmentsetup" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Investment Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/activateinvestment" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Create Investment Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentorder" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Investment Applications</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countInv(1)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentpending" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Pending Investment</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countInv(2)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentactive" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Active Investment</p>
                  <span class="pull-right-container">
                    <?php echo $fin->countInv(3)?>
                   </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentexpired" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Liquidated Investment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/investmentdeposits" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Investment Deposits</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-money-bill-alt"></i>
              <p>Manage Expenses
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/manageexpense" class="nav-link">
                  <i class="fas fa-money-bill-alt"></i>
                  <p>Add & View Expenses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/expensesummary" class="nav-link">
                  <i class="fas fa-money-bill-alt"></i>
                  <p>Expense Summary</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
          $uid = auth()->user()->userid;
          if($fin->adminName($uid,'o2')==1){  ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-clipboard"></i>
              <p>Financial Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
              $i = 1;
               while($i<=20){
                 $e = $i++;
                 $title = Reports($e);
                 if(!empty($title)){
                   echo '<li class="nav-item"><a class="nav-link" href="operationaltransaction?index='.sha1($e).$e.'">
                    <i class="fas fa-clipboard"></i> '.$title.'</a></li>';
             } } ?>

              <li class="nav-item">
                <a href="/expectedrepayment" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Expected Loan Repayment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/operationalcredit" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Operational Credit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/operationaldebit" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Operational Debit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/accountsummary" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Annual Account Summary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/accountsummaryq" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Flexible Account Summary</p>
                </a>
              </li>

            </ul>
            <?php }?>
          </li>
          <?php if($fin->adminName($uid,'o1')==1){  ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-sync-alt"></i>
                <p>System Setup
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="/finreports" class="nav-link">
                          <i class="fas fa-sync-alt"></i>
                          <p>Reports Control</p>
                      </a>
                  </li>

                <li class="nav-item">
                  <a href="/systemsetup" class="nav-link">
                    <i class="fas fa-sync-alt"></i>
                    <p>System Information</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/systemadmin" class="nav-link">
                    <i class="fas fa-sync-alt"></i>
                    <p>System Administrator Roles</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/createadmin" class="nav-link">
                    <i class="fas fa-sync-alt"></i>
                    <p>Manage Admin Roles</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-user-alt"></i>
                <p>Staffs
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="/staffs" class="nav-link">
                    <i class="fas fa-user-alt"></i>
                    <p>Staff Setup</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/allstaffs" class="nav-link">
                    <i class="fas fa-user-alt"></i>
                    <p>All Staffs</p>
                  </a>
                </li>
              </ul>
            </li>



          <?php }?>
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
