@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>Master Menu</title>
<script type="text/javascript">
$(document).ready(function(){

   $('#example').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
       "ordering": false,
      
      "bDestroy": true

   });

  /*membuat text berisi tanggal*/
    $(function(){
      $( ".date-input-css" ).datepicker({
          format:'dd/mm/yyyy',
          autoclose: true,
          todayHighlight: true,
        });
      });
   /*batas*/  
       
}); //tutupnya 'Document Ready Function'

</script>

<div class="content-wrapper">
  <section class="content-header">
      <h1>Master Menu</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin/dashboard') }}" target=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a onClick="javascript:history.go(0)" data-icon="refresh">Refresh</a></li>
      </ol>
    </section>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

            <div class="box-body">

             <div class="row">
                <div class="col-xs-10">
                </div>                
                <div class="col-xs-2">
                     <button type="button" class="btn btn-block btn-default" onclick="javascript:window.location.href='pelanggan/form_tambahdata'">Add</button>
                </div>
             </div>  
            </div>

<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
	   <thead bgcolor="#ECF0F5">
       <tr>
        <th>ID</th>
        <th>Group Name</th>
				<th>Code</th>
        <th>Active</th>
				<th>Opsi</th>
       </tr>
      </thead>
          
	
		<tbody>
		  <?php $no=1; foreach($data as $list) { ?>
        <tr>
          <td><?php echo $list->menuID; ?></td>
          <td><?php echo $list->name; ?></td>
          <td><?php echo $list->code; ?></td>
          <?php if ($list->inActive == 0) {?>
              <td><span class="label label-success"><i class="fa fa-check"></span></td>
             <?php }else if ($list->inActive == 1) {?>
              <td><span class="label label-danger"><i class="fa fa-close"></span></td>
             <?php }?>
          <td><a href="menu/form_rubahdata/<?php echo Crypt::encryptString($list->menuID); ?>" class="btn btn-danger btn-sm">Edit</a></td>                 
				</tr> 
		  <?php $no++; } ?>
   </tbody>
  </table>
  	
<!-- ============ Body content end ============= -->    

@endsection