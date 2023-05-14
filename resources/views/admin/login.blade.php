<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" name="theme-color" content="#3C8DBC">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
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
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- jQuery 3 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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
  <script src="{{ asset('assetsAdminLTEprem/bower_components/chart.js/Chart.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('assetsAdminLTEprem/dist/js/demo.js') }}"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
	          <li class="dropdown user user-menu">
	            
	               
	             <!-- 
	              <li class="user-header">
	                <img src="<?php //echo base_url(); ?>assetsAdminLTEprem/dist/img/logox.png" class="header-image" alt="User Image">
	              </li>
	             --> 
	            
	            <ul class="dropdown-menu">
	              <!-- User image -->
	              
	             
	              <!-- Menu Footer-->
	             
	            </ul>
	          </li>
	          <!-- Control Sidebar Toggle Button -->
	          <li>
	            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
<!--*****************************************************************************************************************************************************************-->
   
<!--*****************************************************************************************************************************************************************--> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>	

<div class="content-wrapper">	  
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
	           
	            <div class="box-header with-border">
	              <h1 class="box-title"><font color="#0099CC">Log In</font></h1>
	            </div>
	            
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form" action="{{ route('admin/login/validasi') }}" method="post">
	             {{ csrf_field() }}
	              <div class="box-body">
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Username</label>
	                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" required autofocus>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputPassword1">Password</label>
	                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required autofocus>
	                </div>
	              </div>
	              <!-- /.box-body -->
	            <div class="box-footer">
	                <button type="submit" class="btn btn-primary btn-block">Login</button>
	              </div>
	            </form>
	         	         
	        </div>
	    </div>
	  </div>
  </section>
</div>	              

       
</body>
</html>


