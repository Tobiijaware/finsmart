@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>₦{{ $user }} </h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>₦{{ $loan }} </h3>
              <p>Active Loans</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill"></i>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box text-white" style="background: grey;">
            <div class="inner">
              <h3>₦{{ $saving }} </h3>
              <p>Active Savings</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill"></i>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box text-white" style="background: orangered;">
            <div class="inner">
              <h3>₦{{ $invest }} </h3>
              <p>Active Investment</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-3">
            <div class="small-box text-white" style="background:red ;">
                <div class="inner">
                    <h6>Loan Applications</h6>
                  <h4>₦{{ $loan1 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($loan2,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box text-white" style="background:green ;">
                <div class="inner">
                    <h6>Approved Loans</h6>
                  <h4>₦{{ $loan3 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($loan4,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box text-white" style="background:#000899 ;">
                <div class="inner">
                    <h6>Awaiting Disbursment</h6>
                  <h4>₦{{ $loan5 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($loan6,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box text-white" style="background:#110000 ;">
                <div class="inner">
                    <h6>Liquidated Loans</h6>
                  <h4>₦{{ $loan7 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($loan8,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-3">
            <div class="small-box" style="background:rgba(155, 145, 15, 0.575) ;color:#000;">
                <div class="inner">
                    <h6>Investment Application</h6>
                  <h4>₦{{ $inv1 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($inv2,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box" style="background:rgba(20, 176, 204, 0.575) ;color:#000;">
                <div class="inner">
                    <h6>Approved Investments</h6>
                  <h4>₦{{ $inv3 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($inv4,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box" style="background:rgba(224, 21, 116, 0.575) ;color:#000;">
                <div class="inner">
                    <h6>Liquidated Investments</h6>
                  <h4>₦{{ $inv5 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($inv6,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
          <div class="col-3">
            <div class="small-box" style="background:rgba(25, 59, 27, 0.575) ;color:#fff;">
                <div class="inner">
                    <h6>Liquidated Savings</h6>
                  <h4>₦{{ $sav1 }}</h4>
                  <h4 class="info-box-number"></h4>₦{{number_format($sav2,2)}}</span>
                  {{-- <p></p> --}}
                </div>
                <div class="icon">
                  <i class="fas fa-naira-sign"></i>
                </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
