<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" name="theme-color" content="#3C8DBC">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/dist/css/skins/_all-skins.min.css') }}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assetsAdminLTEprem/dist/js/adminlte.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap  -->
  <script src="{{ asset('assetsAdminLTEprem/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/bower_components/chart.js/chartjs-plugin-datalabels.min.js') }}"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('assetsAdminLTEprem/dist/js/demo.js') }}"></script>
</head>



<?php 
  function isMobileDevice() {
      return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
  }

  if(isMobileDevice()){ ?> 
    <body class="hold-transition skin-blue sidebar-mini">
  
  <?php }else { ?>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
       
  <?php } ?>


<div class="wrapper">

    <header class="main-header">
      <!-- Logo -->

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
          
            <!-- User Account: style can be found in dropdown.less -->

            <!-- Control Sidebar Toggle Button -->
            <li>
               <a href="#" data-toggle="control-sidebar"><span class="fa fa-gears" style="font-size:18px;"></span></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ route('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

<!--*****************************************************************************************************************************************************************-->             
     <?php foreach ($menu as $d1) { ?>

      <li class="treeview">
        <a href="#" class="nav-link">
          <i class="fa <?php echo $d1['icon']; ?>"></i>
            <span><?php echo $d1['name']; ?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </a>

        <?php if (isset($d1['menu'])) { ?>

        <ul class="treeview-menu">

          <?php foreach ($d1['menu'] as $d2) { ?>
          
            <?php if (isset($d2['menu'])) { ?>

             <li class="treeview">
               <a href="<?php echo $d2['code']; ?>" class="nav-link">
                <i class="fa <?php echo $d2['icon']; ?>"></i>
                  <span><?php echo $d2['name']; ?></span>
                  <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
               </a>
            
             <?php } else { ?>

             <li>
               <a href="<?php echo route($d2['code']); ?>" class="nav-link">
                <i class="fa <?php echo $d2['icon']; ?>"></i>
                  <span><?php echo $d2['name']; ?></span>
               </a>
            
             <?php } ?>


            <?php if (isset($d2['menu'])) { ?>

            <ul class="treeview-menu">

              <?php foreach ($d2['menu'] as $d3) { ?>

              <li>
                <a href="<?php echo route($d3['code']); ?>" class="nav-link">
                  <i class="fa <?php echo $d3['icon']; ?>"></i>
                    <span><?php echo $d3['name']; ?></span>
                </a>
              </li>

              <?php } ?> <!-- $d3 -->

            </ul>

            <?php } ?> <!-- isset($d2['menu']) -->

          </li>

          <?php } ?> <!-- $d2 -->

        </ul>

        <?php } ?> <!-- isset($d1['menu']) -->

      </li>

      <?php } ?> <!-- $d1 -->
<!--*****************************************************************************************************************************************************************-->
    <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

            <ul class="treeview-menu">            
                <li><a href="#"><i class='fa fa-circle-o'></i> <span>Ubah Password</span></a></li>
            </ul>
   
    </li> <!--sub menu 1--> 
     
<!--*****************************************************************************************************************************************************************--> 

     <li><a href="{{ route('admin/login/logout') }}"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
   
<!--*****************************************************************************************************************************************************************--> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<!-- ============ body content start ============= -->
            
               @yield('container')
            
<!-- ============ body content end ============= -->

