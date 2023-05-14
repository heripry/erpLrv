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
      <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/plugins/iCheck/all.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assetsAdminLTEprem/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- fancyBox-->
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
  

   <!-- DevExtreme theme -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>DevExt/themebuilder-scss/tests/data/scss/bundles/dx.light.scss">  -->
    

   <!-- DevExtreme library -->
    <!-- <script type="text/javascript" src="<?php //echo base_url(); ?>DevExt/js/dx.all.js"></script> -->


  <!-- jQuery 3 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery/dist/jquery.min.js') }}"></script>    
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- DataTables -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('assetsAdminLTEprem/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <!-- date-range-picker -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <!-- bootstrap time picker -->
  <script src="{{ asset('assetsAdminLTEprem/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('assetsAdminLTEprem/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assetsAdminLTEprem/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('assetsAdminLTEprem/dist/js/demo.js') }}"></script>
    <!-- CK Editor -->
  <script src="{{ asset('assetsAdminLTEprem/bower_components/ckeditor/ckeditor.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('assetsAdminLTEprem/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>


  <script type="text/javascript"  src="{{ asset('assets/js/jquery-barcode.js') }}"></script>
  
  <script type="text/javascript"  src="{{ asset('assets/js/jquery.number.js') }}"></script>

  <script type="text/javascript"  src="{{ asset('assets/js/jquery.printThis.js') }}"></script>




  <!-- DataTables -->
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <!-- InputMask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


    <!-- DevExtreme theme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.2.8/css/dx.light.css">
 
    <!-- DevExtreme library -->
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.8/js/dx.all.js"></script>
    <!-- <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.1.3/js/dx.web.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.1.3/js/dx.viz.js"></script> -->



</head>

<style type="text/css">
   /*--buat header--*/
  .dx-datagrid-headers .dx-datagrid-table .dx-row.dx-header-row td {
    background: #E6ECF7;
    color: #000;
    font-size: 13px;
   } 

   /*--buat row--*/
  .dx-datagrid {  
    font-size:12px;  
   }  

 /* .dx-pivotgridfieldchooser {
    background: #E6ECF7;
    color: #000;
    font-size: 13px;
   } */

   .dx-pivotgrid  {
    font-size:12px;
   } 

   .dx-datagrid .dx-data-row > td.bullet {
    padding-top: 0;
    padding-bottom: 0;
   }

</style>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

   //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })


  })
</script>
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