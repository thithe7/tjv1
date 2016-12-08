<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>"/>
        <title>TravelJinni | Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ URL::asset('theme/admin/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('theme/admin/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/iCheck/all.css') }}">

        <link rel="stylesheet" href="{{ URL::asset('theme/admin/dist/css/skins/skin-blue.min.css') }}">

        <link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/datatables/dataTables.bootstrap.css') }}">
        <!--Date Picker-->
        <link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/datepicker/datepicker3.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/toastr/toastr.min.css') }}">

        <!-- include tinymce js-->
        <script src="{{ URL::asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>


        <style type="text/css">
            table td{word-break: break-all;}
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini" oncontextmenu="return false">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="{!! url('/admin') !!}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>J</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Travel</b>Jinni</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{ URL::asset('theme/admin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{{Auth::guard('web_admin')->user()->username}}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{ URL::asset('theme/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{{Auth::guard('web_admin')->user()->username}}}
                                            <!-- <small>Admin since {{{date("Y M d", Auth::guard('web_admin')->user()->created_at)}}}</small> -->
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Begin Sidebar Menu -->
                    {!!$menu!!}
                    <!-- End Sidebar Menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    Developed By <a href="http://qqltech.org" target="_blank">Quantum Leap</a>
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="https://traveljinni.com/">traveljinni.com</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- jQuery UI -->
        <script src="{{ URL::asset('theme/admin/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ URL::asset('theme/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('theme/admin/dist/js/app.min.js') }}"></script>

        <!-- DataTables -->
        <script src="{{ URL::asset('theme/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('theme/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <!-- Date Picker -->
        <!-- <script src="{{ URL::asset('theme/admin/plugins/datepicker/moment.min.js') }}"></script> -->
        <script src="{{ URL::asset('theme/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ URL::asset('theme/admin/plugins/select2/select2.full.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/bootbox/bootbox.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
        <!-- include tinymce js-->
        <script src="{{ URL::asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>

        <!-- iCheck 1.0.1 -->
        <script src="{{ URL::asset('theme/admin/plugins/iCheck/icheck.min.js') }}"></script>

        <script src="{{ URL::asset('assets/plugins/jquery-ui/jquery.blockUI.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/rowreordering/jquery.dataTables.rowReordering.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {

                tinymce.init({
          selector: "textarea.tinymce",theme: "modern",height: 300,
          plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
          ],
          toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
          toolbar2: " link unlink anchor | image media | forecolor backcolor  | print preview code ",
          // toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
          image_advtab: true ,
          convert_urls: false,
          relative_urls: false,
          // autosave_ask_before_unload: false,
          autosave_ask_before_unload: false,

          external_filemanager_path:"{{ URL::asset('assets/plugins/responsive_filemanager/filemanager/') }}/",
          filemanager_title:"Inap Filemanager" ,
          external_plugins: { "filemanager" : "{{ URL::asset('assets/plugins/responsive_filemanager/filemanager/plugin.min.js') }}"},
          templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
          ],
          content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
          ],
          remove_script_host: true,
          setup : function(ed){
            ed.on('change', function(e){
              tinyMCE.triggerSave();
            });
            ed.on('SetContent', function(e){
              tinyMCE.triggerSave();
            });
          }
        });
                
            });
        </script>
    </body>
</html>
