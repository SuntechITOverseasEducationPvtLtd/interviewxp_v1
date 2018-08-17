<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
         
 
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/themeassets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/themeassets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/themeassets/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/themeassets/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/themeassets/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
 
      
 
 <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/pages/dashboard.js"></script>
           <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/plugins/pickers/daterangepicker.js"></script>

   
       
 <script type="text/javascript" src="{{ url('/') }}/themeassets/assets/js/core/app.js"></script>
        



    </head>
    <body class="{{ theme_body_color() }}">
    <?php
            $admin_path = config('app.project.admin_panel_slug');
    ?>
       <script type="text/javascript">
        var site_url = "{{ url('/') }}";
        </script> 
<!-- BEGIN Theme Setting -->


    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/').'/'.$admin_path }}/dashboard"> <img src="{{ url('/') }}/images/logoxp.png" style="height: 30px;  margin-top: -6px;  float: left;">

   <!-- {{ config('app.project.name') }} --> Admin

            </a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-git-compare"></i>
                        <span class="visible-xs-inline-block position-right">User updates</span>
                        <span class="badge bg-warning-400">2</span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            User updates
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-sync"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                   User <a href="#">Payment </a> Added
                                    <div class="media-annotation">4 minutes ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
                                </div>
                                
                                <div class="media-body">
                                   Three transaction made
                                    <div class="media-annotation">36 minutes ago</div>
                                </div>
                            </li>

                           
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>
            </ul>

            <p class="navbar-text"><span class="label bg-success">Active</span></p>

            <ul class="nav navbar-nav navbar-right">
              

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <span class="badge bg-warning-400">2</span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Messages
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-compose"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body">
                            <li class="media">
                                <div class="media-left">
                                    <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                    <span class="badge bg-danger-400 media-badge">5</span>
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">James Alexander</span>
                                        <span class="media-annotation pull-right">04:58</span>
                                    </a>

                                    <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                    <span class="badge bg-danger-400 media-badge">4</span>
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">Margo Baker</span>
                                        <span class="media-annotation pull-right">12:16</span>
                                    </a>

                                    <span class="text-muted">That was something he was unable to do because...</span>
                                </div>
                            </li>

                           

                         
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="assets/images/placeholder.jpg" alt="">
                        <span>Admin</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                      
                        <li class="divider"></li>
                        <li><a href="{{ url('/').'/'.$admin_path }}/change_password"><i class="icon-cog5"></i> Change Password</a></li>
                        <li><a href="{{ url('/').'/'.$admin_path }}/logout"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <div class="page-container">

       