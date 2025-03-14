<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SmartPayroll Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('/Dashboard/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{url('/Dashboard/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{url('/Dashboard/assets/images/favicon.png')}}" />
    
    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    
  </head>
  <body>

  @php
    use Illuminate\Support\Facades\Session;
    use App\Models\Users;
    $user = Users::where('id', Session::get('id'))->first();
    $userRole = '';
    if (Session::has('role')) {
      $userRole = Session::get('role');
    }
  @endphp

    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="/Admindashboard"><img src="{{url('/Dashboard/assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="/Admindashboard"><img src="{{url('/Dashboard/assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{url('/Dashboard/assets/images/faces/face15.jpg')}}" alt="">
                  <span class="count bg-success"></span>
                </div>
                @if (session()->has('email'))
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{session()->get('name')}}</h5>
                    <span>{{ $user->role==2? "user": "Admin" }}</span>
                </div>
                @else
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">VGOTELL</h5>
                  <span>ADMIN</span>
                </div>
                @endif
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  
                  @if (session()->has('email'))
                  @if ($user)
                  <div class="preview-item-content" style="cursor: pointer;" onclick="window.location.href='{{ url('/Profileedit') }}/{{ $user->id * 548548 }}'">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                    @endif
                @endif
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/Admindashboard">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if (session()->has('email'))
          @if ($user->role == 1)
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-outline"></i>
              </span>
              <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/DbUsers">All Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="/UsersInsert">Users Insert</a></li>
              </ul>
            </div>
          </li>
          @endif
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#department" aria-expanded="false" aria-controls="department">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Departments</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="department">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Departments">All Departments</a></li>
                <li class="nav-item"> <a class="nav-link" href="/DepartmentsInsert">Departments Insert</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Designations" aria-expanded="false" aria-controls="Designations">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Designations</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Designations">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Designations"> All Designations</a></li>
                <li class="nav-item"> <a class="nav-link" href="/DesignationsInsert"> Designations Insert </a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Employee" aria-expanded="false" aria-controls="Employee">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">Employees</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Employee">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Employees"> All Employees</a></li>
                <li class="nav-item"> <a class="nav-link" href="/EmployeesInsert"> Employee Insert </a></li>
              </ul>
            </div>
          </li>

          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Attendance" aria-expanded="false" aria-controls="Attendance">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Attendances</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Attendance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Attendances">All Attendances</a></li>
                <li class="nav-item"> <a class="nav-link" href="/AttendancesInsert">Attendances Insert</a></li>
              </ul>
            </div>
          </li>
          
          @if ($user->role == 1)
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">Transaction Types</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Transactiontypes"> All Transactiontype</a></li>
                <li class="nav-item"> <a class="nav-link" href="/TransactiontypesInsert"> Transactiontype Insert </a></li>
              </ul>
            </div>
          </li>
          @endif
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Deductions" aria-expanded="false" aria-controls="Deductions">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Deductions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Deductions">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Deductions">All Deductions</a></li>
                <li class="nav-item"> <a class="nav-link" href="/DeductionsInsert">Deductions Insert</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Bonuses" aria-expanded="false" aria-controls="Bonuses">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Bonuses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Bonuses">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Bonuses">All Bonuses</a></li>
                <li class="nav-item"> <a class="nav-link" href="/BonusesInsert">Bonuses Insert</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Month" aria-expanded="false" aria-controls="Month">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Months</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Month">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Months">All Months</a></li>
                <li class="nav-item"> <a class="nav-link" href="/MonthsInsert">Months Insert</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Payrolls" aria-expanded="false" aria-controls="Payrolls">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Payrolls</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Payrolls">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Payrolls">All Payrolls</a></li>
                <li class="nav-item"> <a class="nav-link" href="/PayrollsInsert">Payrolls Insert</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#Salaries" aria-expanded="false" aria-controls="Salaries">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Salaries</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Salaries">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/Salaries">All Salaries</a></li>
                <li class="nav-item"> <a class="nav-link" href="/SalariesInsert">Salaries Insert</a></li>
              </ul>
            </div>
          </li>

          {{-- <li class="nav-item menu-items">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Form Elements</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/icons/mdi.html">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="http://code-runner-solution.netlify.app/">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
          @endif
        </ul>
      </nav>
  <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="/Admindashboard"><img src="{{url('/Dashboard/assets/images/logo-mini.svg')}}" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">UI Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Testing</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{url('/Dashboard/assets/images/faces/face4.jpg')}}" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{url('/Dashboard/assets/images/faces/face2.jpg')}}" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{url('/Dashboard/assets/images/faces/face3.jpg')}}" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              
              @php
                                
              use Illuminate\Http\Request;
              use Illuminate\Support\Facades\DB;
              use Illuminate\Support\Facades\Hash;
              $user = Users::where('id', Session::get('id'))->first();
          @endphp

          @if (session()->has('email'))
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    {{-- <img class="img-xs rounded-circle" src="{{url('/Dashboard/assets/images/faces/face15.jpg')}}" alt=""> --}}
                    @if ($user)
                      <img class="img-xs rounded-circle" src="{{ $user->img }}" alt=""
                        style="width: 40px; height: 40px;">
                    @endif
                    
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ session()->get('name') }}</p>
                    
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                @else
                <a href="{{ url('/login') }}" class="btn btn-success my-2">Login</a>
                @endif
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>

                  
                  @if (session()->has('email'))
                  @if ($user)
                  <div class="preview-item-content" style="cursor: pointer;" onclick="window.location.href='{{ url('/Profileedit') }}/{{ $user->id * 548548 }}'">
                    <p class="preview-subject mb-1">My Profile</p>
                  </div>
                    @endif
                @endif

                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content" style="cursor: pointer;" onclick="window.location.href='{{ url('/logout') }}'">
                      @if (session()->has('email'))
                      <p class="preview-subject mb-1" style="cursor: pointer;" onclick="window.location.href='{{ url('/logout') }}'">Log out</p>
                      {{-- <p class="preview-subject mb-1">Settings</p> --}}

                      @endif
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
   <!-- partial -->
        <div class="main-panel">


      @yield('mydashboard')

      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{url('/Dashboard/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{url('/Dashboard/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('/Dashboard/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{url('/Dashboard/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{url('/Dashboard/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{url('/Dashboard/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{url('/Dashboard/assets/js/off-canvas.js')}}"></script>
    <script src="{{url('/Dashboard/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{url('/Dashboard/assets/js/misc.js')}}"></script>
    <script src="{{url('/Dashboard/assets/js/settings.js')}}"></script>
    <script src="{{url('/Dashboard/assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{url('/Dashboard/assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  
  $(document).ready(function() {
        $('#employeeTable').DataTable({
            "paging": true,        // Enable pagination
            "searching": true,     // Enable search
            "ordering": true,      // Enable sorting
            "info": true           // Show info text
        });
    });
</script>
  </body>
</html>