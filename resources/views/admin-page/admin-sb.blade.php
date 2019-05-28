<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('tittle')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('public/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('public/css/sb-admin.css')}}" rel="stylesheet">
  
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{route('index')}}">Giang Tuan</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0 ">
      @if(Auth::check())
      <div style="display: flex; align-items: center; color: wheat;">Hi {{Auth::user()->name}}!</div>
      @endif
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          {{-- <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a> --}}
          <span class="dropdown-item" data-toggle="modal" data-target="#changePass">Change password</span>
          <a class="dropdown-item" href="{{route('logout')}}" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            {{-- <h6 class="dropdown-header">Login Screens:</h6> --}}
            <a class="dropdown-item" href="{{route('ticket')}}">Vé</a>
            <a class="dropdown-item" href="{{route('route')}}">Tuyến xe</a>
            <a class="dropdown-item" href="{{route('buses')}}">Chuyến xe</a>
            <a class="dropdown-item" href="{{route('place')}}">Điểm</a>
            <a class="dropdown-item" href="{{route('passenger')}}">Khách hàng</a>
            <a class="dropdown-item" href="{{route('buses_detail')}}">Chi tiết chuyến xe</a>
            {{-- <a class="dropdown-item" href="{{route('create_data_ticket_detail')}}">Tạo dữ liệu</a> --}}
          </div>
        </li>
        @if(Auth::user()->role_id == '1')
        <li class="nav-item">
          <a class="nav-link" href="{{route('users')}}">
            <i class="fas fa-users"></i>
            <span>User</span>
          </a>
        </li>
        @endif
        
      </ul>

      {{-- @yield('ticket-table') --}}

      <!-- /.content-wrapper -->
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">@yield('link')</li>
          </ol>

          <!-- DataTables Example -->
          @yield('table')


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © NCKH Giang-Hao-Duy Website 2019</span>
            </div>
          </div>
        </footer>

      </div>

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">

      <i class="fas fa-angle-up ml-auto mr-0"></i>
    </a>

    @yield('action-form')
    {{-- Change password --}}
    <div class="modal fade" id="changePass" tabindex="10" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
        <div class="modal-content">
          <div class="card-header">
            <span>Đổi mật khẩu</span>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required="required">
                  <label for="inputConfirmPassword">Confirm Password</label>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-block" id="changePass-button" data-login-id="{{Auth::user()->id}}">Đổi mật khẩu</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{asset('public/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/vendor/datatables/dataTables.bootstrap4.js')}}"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/js/sb-admin.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{asset('public/js/demo/datatables-demo.js')}}"></script>
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}

    @yield('javascript')
    <script src="{{asset('public/js/admin/admin.js')}}"></script>
    <script src="{{asset('public/js/myscript.js')}}"></script>
    </body>

    </html>
