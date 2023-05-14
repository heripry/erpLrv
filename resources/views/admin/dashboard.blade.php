@extends('admin/layout/main_dashboard')

@section('container')  
   
        <!-- ============ Body content start ============= -->

                  <!-- Content Wrapper. Contains page content -->
                  <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                      <strong>WELCOME, <a href="#"><?php echo (session()->get('userLogin')[0]->Name); ?></a></strong>
                      </br>
                      <ol class="breadcrumb">
                        <li><a href="{{ route('admin/dashboard') }}" target=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li><a onClick="javascript:history.go(0)" data-icon="refresh">Refresh</a></li>
                      </ol>
                    </section>
                    
                    <!-- Main content -->
                    <section class="content">
                         

                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->
                  <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                      <!--<b>Version</b> 2.4.0-->
                    </div>
                    <!--<strong>Copyright &copy; 2017-<?php //echo date("Y");?>,</strong> All rights reserved.-->
                  </footer>

                </body>
                </html>

        <!-- ============ Body content end ============= -->    

@endsection
