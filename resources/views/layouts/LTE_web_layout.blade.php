<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link rel="icon" type="{{ asset('PMLogo.png') }}" sizes="16x16" href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/images/favicon.png">
    <title>Preventive Maintenance System</title>
    <!-- Custom CSS -->
    {{-- <link rel="stylesheet" href="{{ URL::asset('style.css') }}"> --}}
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/css/style.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.23.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/quill/dist/quill.snow.css">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/summernote/dist/summernote-bs4.css" rel="stylesheet">
    <link href="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <?php
    $image = asset('PMLogo.png');
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a class="logo" href="/dashboard" aria-expanded="false">
                            <b class="logo-icon">
                            <img src="{{ url('/') }}/logo.png" alt="logo" style="height: 50px !important;" class="dark-logo" />
                            <img src="{{ url('/') }}/logo.png" alt="logo" style="height: 50px !important;" class="light-logo" />
                            </b>
                            <span class="logo-text" style="color: #ffffff;">
                            PMS
                            </span>
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="font-22 mdi mdi-email-outline"></i>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow">
                                    <span class="bg-danger"></span>
                                </span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title text-white bg-danger">
                                            <h4 class="m-b-0 m-t-5">5 New</h4>
                                            <span class="font-light">Messages</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{ asset('PMLogo.png') }}" alt="user" class="rounded-circle">
                                                    <span class="profile-status online pull-right"></span>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/images/users/2.jpg" alt="user" class="rounded-circle">
                                                    <span class="profile-status busy pull-right"></span>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Sonu Nigam</h5>
                                                    <span class="mail-desc">I've sung a song! See you at</span>
                                                    <span class="time">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/images/users/3.jpg" alt="user" class="rounded-circle">
                                                    <span class="profile-status away pull-right"></span>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Arijit Sinh</h5>
                                                    <span class="mail-desc">I am a singer!</span>
                                                    <span class="time">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/images/users/4.jpg" alt="user" class="rounded-circle">
                                                    <span class="profile-status offline pull-right"></span>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link text-dark" href="javascript:void(0);">
                                            <b>See all e-Mails</b>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown border-right">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline font-22"></i>
                                <span class="badge badge-pill badge-info noti">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">4 New</h4>
                                            <span class="font-light">Notifications</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-danger btn-circle">
                                                    <i class="fa fa-link"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Luanch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span>
                                                    <span class="time">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-success btn-circle">
                                                    <i class="ti-calendar"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Event today</h5>
                                                    <span class="mail-desc">Just a reminder that you have event</span>
                                                    <span class="time">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-info btn-circle">
                                                    <i class="ti-settings"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Settings</h5>
                                                    <span class="mail-desc">You can customize this template as you want</span>
                                                    <span class="time">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-primary btn-circle">
                                                    <i class="ti-user"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5 text-dark" href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $image ?>" alt="user" class="rounded-circle" width="40">
                            <span class="m-l-5 font-medium d-none d-sm-inline-block"> <i class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <span class="with-arrow">
                            <span style="background-color: #771a0d;"></span>
                            </span>
                            <div class="d-flex no-block align-items-center p-15 text-white m-b-10" style="background-color: #771a0d;">
                                <div class="">
                                <img src="<?= $image ?>" alt="user" class="rounded-circle" width="60">
                                </div>
                                <div class="m-l-10">
                                <h4 class="m-b-0">Hello There!</h4>
                                <p class=" m-b-0">Plss tell me about your self</p>
                                </div>
                            </div>
                            <div class="profile-dis scrollable">
                                <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center" href="/staffs/2fa">
                                <i class="ti-lock m-r-5 m-l-5"></i> Two-Factor Authentication (2FA)</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="ti-more m-r-5 m-l-5"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <!-- Logout Link -->

                                    <!-- Optional: Divider -->
                                    <div class="dropdown-divider"></div>

                                <div class="dropdown-divider"></div>
                            </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                         {{-- <a><span class="hide-menu">Dashboard</span></a> --}}
                        </li>
                        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-spin fa-cog"></i><span class="hide-menu">Settings</span></a> --}}
                            {{-- <ul aria-expanded="false" class="collapse first-level"> --}}
                                {{-- <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('conducted_by.index') ? 'active' : '' }}" href="{{ Route::has('conducted_by.index') ? route('conducted_by.index') : url('/conducted_by/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Conducted By</span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('custodian-info') ? 'active' : '' }}" href="{{ Route::has('custodian-info') ? route('custodian-info') : url('/custodian-info') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Custodian Checklist </span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('category') ? 'active' : '' }}" href="{{ Route::has('category') ? route('category') : url('/category') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu">  Equipment Types</span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('questionaire.index') ? 'active' : '' }}" href="{{ Route::has('questionaire.index') ? route('questionaire.index') : url('/questionaire/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu">  Questionnaires</span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('response.index') ? 'active' : '' }}" href="{{ Route::has('response.index') ? route('response.index') : url('/response/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Responses</span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('sub_category.index') ? 'active' : '' }}" href="{{ Route::has('sub_category.index') ? route('sub_category.index') : url('/sub_category/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu">  Sub Categories</span></a></li> --}




                                {{-- <li class="sidebar-item"> <a class="has-arrow sidebar-link"  aria-expanded="false"><i class="mdi mdi-adjust"></i> <span class="hide-menu">3. Objectives</span></a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('objective-types') ? 'active' : '' }}" href="{{ Route::has('objective-types') ? route('objective-types') : url('/objective-types') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Types</span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('outcome-types') ? 'active' : '' }}" href="{{ Route::has('outcome-types') ? route('outcome-types') : url('/outcome-types') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Outcome types</span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('objectives') ? 'active' : '' }}" href="{{ Route::has('objectives') ? route('objectives') : url('/objectives') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List</span></a></li>
                                    </ul>
                                </li> --}}


                                {{-- <li class="sidebar-item"> <a class="has-arrow sidebar-link"  aria-expanded="false"><i class="mdi mdi-adjust"></i> <span class="hide-menu">4. Questionnaire</span></a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('questionaire') ? 'active' : '' }}" href="{{ Route::has('questionaire') ? route('questionaire') : url('/questionaire') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List </span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('questionaire.index') ? 'active' : '' }}" href="{{ Route::has('questionaire.index') ? route('questionaire.index') : url('/questionaire/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Questionaire</span></a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="sidebar-item"> <a class="has-arrow sidebar-link"  aria-expanded="false"><i class="mdi mdi-adjust"></i> <span class="hide-menu">5. Outcome</span></a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('outcome.index') ? 'active' : '' }}" href="{{ Route::has('outcome.index') ? route('outcome.index') : url('/outcome/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List</span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('outcome.types') ? 'active' : '' }}" href="{{ Route::has('outcome.types') ? route('outcome.types') : url('/outcome/types') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Types</span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('outcome.types') ? 'active' : '' }}" href="{{ Route::has('strategic-priorities.2fa') ? route('strategic-priorities.2fa') : url('/strategic-priorities/2fa') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> 2FA</span></a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="sidebar-item"> <a class="has-arrow sidebar-link"  aria-expanded="false"><i class="mdi mdi-adjust"></i> <span class="hide-menu">6. Output</span></a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('output.index') ? 'active' : '' }}" href="{{ Route::has('output.index') ? route('output.index') : url('/output/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List</span></a></li>
                                        <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('output-types') ? 'active' : '' }}" href="{{ Route::has('output-types') ? route('output-types') : url('/output-types/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Types</span></a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('project-proposals.index') ? 'active' : '' }}" href="{{ Route::has('initiatives.index') ? route('initiatives.index') : url('/initiatives/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> 7. Initiatives</span></a></li>
                                <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('project-proposals.index') ? 'active' : '' }}" href="{{ Route::has('activity-types.index') ? route('activity-types.index') : url('/activity-types/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> 8. Activity Type</span></a></li> --}}
                            {{-- </ul> --}}
                        </li>
                        {{-- <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('custodian-info') ? 'active' : '' }}" href="{{ Route::has('custodian-info') ? route('custodian-info') : url('/custodian-info') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Custodian Checklist </span></a></li> --}}

                                {{-- <li class="sidebar-item"><a  class="sidebar-link {{ request()->routeIs('project-proposals.index') ? 'active' : '' }}" href="{{ Route::has('cmp-managers.index') ? route('cmp-managers.index') : url('/cmp-managers/index') }}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> CMP Managers</span></a></li> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">

            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('content')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by National Museum of the Philippines.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
               <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-15 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                            <label class="custom-control-label" for="theme-view">Dark Theme</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input sidebartoggler" name="collapssidebar" id="collapssidebar">
                            <label class="custom-control-label" for="collapssidebar">Collapse Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
                            <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
                            <label class="custom-control-label" for="header-position">Fixed Header</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
                            <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/daterangepicker/daterangepicker.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/tinymce/tinymce.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/app.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/app.init.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/app-style-switcher.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/waves.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/sidebarmenu.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/custom.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/calendar/cal-init.js"></script> -->
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/datatable/datatable-advanced.init.js"></script>

    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/forms/select2/select2.init.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/toastr/build/toastr.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/toastr/toastr-init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.23.0/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/sweetalert2/sweet-alert.init.js"></script> -->
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/forms/dual-listbox/dual-listbox.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/forms/mask/mask.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <!-- <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/chart.js/dist/Chart.min.js"></script> -->
    <script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js
"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/chartjs/chartjs.init.js"></script>


    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/dist/js/pages/email/email.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/libs/block-ui/jquery.blockUI.js"></script>
    <script src="https://d6ln97o9ufq72.cloudfront.net/niceadminpro/assets/extra-libs/block-ui/block-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    @push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
@endpush

    {{-- <script src="{{ asset('resources/js/app.js') }}"></script> --}}
</body>

</html>
