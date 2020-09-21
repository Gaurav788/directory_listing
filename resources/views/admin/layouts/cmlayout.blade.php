<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta name="csrf-token" content="{!! csrf_token() !!}">
      <link href="{{asset('backend/css/all.min.css')}}" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
      <link href="{{asset('backend/css/custom_style.css')}}" rel="stylesheet">
      <link href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
      <script src="{{asset('backend/js/jquery.min.js')}}"></script>
      
   </head>
   <body class="bg-gradient-primary">
      @section('header')
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
               <div class="sidebar-brand-icon ">
                  <img src="{{asset('/backend/images/im-logo.png')}}" class="adminlogo">
               </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (Request::is('admin/dashboard') ? 'active' : '') }}">
               <a class="nav-link" href="{{route('admin.dashboard')}}">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
			
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);">
               <i class="fas fa-user"></i>
               <span>Users</span></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);">
               <i class="fas fa-blog"></i>
               <span>Blogs</span></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{route('categories.list')}}">
               <i class="fas fa-film"></i>
               <span>Categories</span></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{route('services.list')}}">
               <i class="fas fa-user"></i>
               <span>Services</span></a>
            </li>

         
            <li class="nav-item">
               <a class="nav-link" href="{{route('tags.list')}}">
               <i class="fas fa-paint-brush"></i>
               <span>Tags</span></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{route('paymentmethods.list')}}">
               <i class="fas fa-user-cog"></i>
               <span>Payment Methods</span></a>
            </li>  

            <li class="nav-item">
               <a class="nav-link" href="{{route('membershipplan.list')}}">
               <i class="fas fa-user-cog"></i>
               <span>Membership Plans</span></a>
            </li>
			
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);">
               <i class="fas fa-file"></i>
               <span>CMS Page Manager</span></a>
            </li>       

            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);">
               <i class="fas fa-quote-left"></i>
               <span>Testimonial</span></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);">
               <i class="fas fa-newspaper"></i>
               <span>Newsletter</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto">
                     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                           <form class="form-inline mr-auto w-100 navbar-search">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </li>
                    
                     <!-- Nav Item - Messages -->
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small captialize"> </span>
                        <img class="img-profile rounded-circle" src="{{asset('backend/images/dummyprofile.jpg')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile Setting
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changepassModal">
                           <i class="fa fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                           Change Password
                           </a>

                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#regadminModal">
                           <i class="fa fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                           Add New Admin
                           </a>
                           <div class="dropdown-divider"></div>
						   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </div>
                     </li>
                  </ul>
               </nav>
               <!-- End of Topbar -->
               @show
               @section('body')
               @show
               @section('footer')
            </div>
            <!-- End of Main Content -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; 2014 - {{now()->year}}, Hosting Seekers </span>
                  </div>
               </div>
            </footer>
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
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
               <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
               </div>
            </div>
         </div>
      </div>
      <!-- Profile Popup model -->
      <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalTitleDepP">Update Profile</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <form class="user" action="" id="modalProfileSubmit">
                  @csrf
                  <div class="modal-body">
                     <div id="successMsgP" class="hidden"></div>
                     <div id="errorsDeprtP" class="hidden"></div>
                     <input type="hidden" name="adminid" value="@if(!empty(Session::get('admin'))){{Session::get('admin')->id}} @endif">
                     <div class="form-group">
                        <input type="text" name="name" id="profilename" value="@if(!empty(Session::get('admin'))){{Session::get('admin')->name}}@endif" class="form-control form-control-user" placeholder="Profile Name">
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" id="profilemail" value="@if(!empty(Session::get('admin'))){{Session::get('admin')->email}}@endif" class="form-control form-control-user" placeholder="Profile Name">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary" id="savedBtnP">Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Change PassWord Model -->

      <!-- Profile Popup model -->
      <div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="changepassModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalTitleDepP">Change Password</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <form class="user" action="" id="modalchangepassSubmit">
                  @csrf
                  <div class="modal-body">
                     <div id="successMsgPass"></div>
                     <div id="errorsDeprtPass"></div>
                     <input type="hidden" name="adminid" value="@if(!empty(Session::get('admin'))) {{Session::get('admin')->id}} @endif">
                     <div class="form-group">
                        <input type="text" name="oldpassword" id="oldpassword" class="form-control form-control-user" placeholder="Enter Old Password!" required/>
                     </div>
                     <div class="form-group">
                        <input type="text" name="newpassword" id="newpassword" class="form-control form-control-user" placeholder="Enter New Password!" required/>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary" id="savedBtnPass">Update</button>
                     <button type="hidden" class="btn btn-primary" id="savedPass" style="display: none;"><i class="fa fa-spinner fa-spin"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- End Profile Popup model -->



     <!-- Admin Popup model -->
      <div class="modal fade" id="regadminModal" tabindex="-1" role="dialog" aria-labelledby="regadminModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalTitleDepP">Admin Registration !</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <form class="user" action="" id="modalregadminSubmit">
                  @csrf
                  <div class="modal-body">
                     <div id="successMsg1"></div>
                     <div id="errorsDeprt1"></div>

                     <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" required/>
                     </div>
                     <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control form-control-user" placeholder="Email" required/>
                     </div>

                     <div class="form-group">
                        <input type="text" name="password" id="password" class="form-control form-control-user" placeholder="password" required/>
                     </div>

                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary" id="savedBtnAddmin">Save</button>
                     <button type="hidden" class="btn btn-primary" id="savedmin" style="display: none;"><i class="fa fa-spinner fa-spin"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- End Admin Popup model -->

      @show
      <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('backend/js/jquery.easing.min.js')}}"></script>
      <script src="{{asset('backend/js/script.js')}}"></script>
      <script src="{{asset('backend/js/custom.js')}}"></script>
      <script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>
    
    @yield('scripts')
   </body>
</html>