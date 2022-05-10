<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('system/css/style.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{URL::to('dashboard')}}">PMS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{URL::to('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{URL::to('dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            
                            <div class="sb-sidenav-menu-heading">Project</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMyProjects" aria-expanded="false" aria-controls="collapseMyProjects">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                My Projects
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMyProjects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if(Session::get('user')['isLeader']== TRUE){ ?>
                                    <a class="nav-link" href="{{URL::to('manage/project')}}">Projects</a>
                                    <?php } ?>

                                    <a class="nav-link" href="{{URL::to('manage/role')}}">Roles</a>
                                    <a class="nav-link" href="{{URL::to('manage/task')}}">Tasks</a>
                                    
                                    <!-- <a class="nav-link" href="{{URL::to('my_project/task')}}">Tasks</a> -->
                                    <!-- <a class="nav-link" href="{{URL::to('my_project/assign_user')}}">Assign User</a> -->
                                    <!-- <a class="nav-link" href="{{URL::to('manage/my_task')}}">My Tasks</a> -->
                                </nav>
                            </div>
                            
                            
                            
                            <?php if(Session::get('user')['user_type']=="ADMIN"){ ?>
                            <div class="sb-sidenav-menu-heading">SETTING</div>
                            <a class="nav-link" href="{{URL::to('manage/user')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Users
                            </a>
                            <a class="nav-link" href="{{URL::to('manage/leader')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-clock"></i></div>
                                Leader
                            </a>
                            
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        @if(session()->has('user'))
                        {{Session::get('user')['first_name'].' '.Session::get('user')['last_name'] }}
                        @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PMS <?php echo date("Y")?></div>
                            <div>
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade common_modal" id="common_modal" tabindex="-1" role="dialog" aria-labelledby="common_modal_label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="common_modal_label">Modal title</h5>
                <button type="button" class="close" onclick="hide_modal(this)">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">

              </div>
            </div>
          </div>
        </div>

        <script src="{{ asset('system/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="https://unpkg.com/popper.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('system/js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('system/js/datatables-simple-demo.js') }}"></script>
        <script src="{{ asset('system/plugin/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('system/plugin/jquery-validation/additional-methods.min.js') }}"></script>

        <script>

        function load_modal(heading,content,width=false,height=false,close_previous =false,keep_window_object = false,close_callback = false){

        $('.common_modal').removeClass('last_opened_modal');
        $('.common_modal').removeClass('current_opened_modal');
        $('.common_modal').first().next('.common_modal').addClass('last_opened_modal');

        var modal_clone_id = 'common_modal_'+ heading.replace(/[#|_|;\\/:*?\"<>|&'()~]/g,'').replace(/ /g, '_').toLowerCase();
        already_exist = false;

        if($('#'+ modal_clone_id).length > 0){
          already_exist = true;
        }

        if(already_exist){
          var clone_modal = $('#'+ modal_clone_id);
        }else{
          var clone_modal = $('#common_modal').clone();
          $(clone_modal).attr('id',modal_clone_id);
          $('#common_modal').after(clone_modal);
        }

        if(width){
          $('#' + modal_clone_id + ' .modal-dialog').css('min-width', width);
        }
        if(height){
          $('#' + modal_clone_id + ' .modal-dialog').css('height', height);
        }

        $('#'+ modal_clone_id).on('hidden.bs.modal',function(){
          if($('.common_modal').not(":hidden").length > 0){
            $('body').addClass('modal-open');
          }

          if(!keep_window_object){
            $('#'+ modal_clone_id).remove();
          }
          if(close_callback){
            if(typeof close_callback === "function"){
              close_callback();
            }
          }
        });

        if(close_previous && !already_exist){
          $('.last_opened_modal').remove();
        }

        if(!already_exist){
          var tmp_keep_window_object = false;
        }else{
          var tmp_keep_window_object = keep_window_object;
        }
        if(!tmp_keep_window_object){
          $('#'+ modal_clone_id + ' .modal-title').html('');
          $('#'+ modal_clone_id + ' .modal-body').html('');

          $('#'+ modal_clone_id + ' .modal-title').html("<div class='modal-heading'>" + heading + "</div>");
          $('#'+ modal_clone_id + ' .modal-body').html(content);
        }

        $('#'+ modal_clone_id).addClass('current_opened_modal');
        $('#'+ modal_clone_id).css('z-index', 10000 + $('.common_modal').length);
        $('#'+ modal_clone_id).modal('show');

        return modal_clone_id;
        }

        function hide_modal(element){
        $(element).closest('.modal').modal('toggle');
        }

        </script>

        @stack('scripting')   

        
    </body>
</html>
