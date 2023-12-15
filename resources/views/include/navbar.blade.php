<body class="hold-transition sidebar-mini sidebar-collapse text-sm">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="changepassword()" data-toggle="modal"
                            data-target="#changepassword">
                            <i class="fa fa-key mr-2"></i> Change Password
                            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
                        </a>

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit(); "
                                class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @php $team = Auth::user()->current_team_id; @endphp
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-info  elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">COGENT</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('images/logo.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('manageuser.list') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Manage User</p>
                                </a>
                            </li>
                        </ul>



                        <ul class="nav nav-item has-treeview nav-pills nav-sidebar flex-column" data-widget="treeview"
                            role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-star"></i>
                                    <p> Manage SR <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('excel') }}" class="nav-link ">
                                            <i class="nav-icon fas fa-upload"></i>
                                            <p>Upload Data</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('report') }}" class="nav-link ">
                                            <i class="nav-icon fas fa-file-alt"></i>
                                            <p>Report</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </form>

        <div class="modal fade" id="changepassword">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Change Password</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="card-body" id="changepasswordbody">
                    </div>
                </div>
            </div>
        </div>
        <script>
            function changepassword(id) {
                $.ajax({
                    type: "get",
                    url: "{{ route('changepassword') }}",
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        console.log(data.url);
                        $("#changepassword").modal('show');
                        $('#changepasswordbody').html(data.html);
                    }
                });
            };
        </script>
