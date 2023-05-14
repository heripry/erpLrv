@extends('admin/layout/main_menu')

@section('container')

<!-- ============ Body content start ============= -->

<?php
 error_reporting(0);
?>
<title>Daftar Menu Employee</title>

<script type="text/javascript"> 
$(document).ready( function(){
   
    refreshBtn();

	$("#refresh").click(function(){
    refreshBtn();  
  });
  
  function refreshBtn(){
	    var userID =$("#cbUserID").val();
     
     $.ajax({
			type: "POST",
			url: "{{ route('admin/menuEmployee/filtermenuEmployee') }}",
			data: {"_token": "{{ csrf_token() }}", userID: userID},
			success: function(html){
				$("#tampil_filterSales").html(html);
				console.log('done');
        }
     });
  }
     
	

});
</script>
   
<div class="content-wrapper">
  <section class="content-header">
      <h1>Daftar Menu Employee</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin/dashboard') }}" target=""><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a onClick="javascript:history.go(0)" data-icon="refresh">Refresh</a></li>
      </ol>
    </section>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">    
		

<table class="table">
<tr>
  <td>Employee:&nbsp;&nbsp;&nbsp;</td> 
  <td><select class="form-control select2" id="cbUserID" style="width: 100%;">
       <option value="-" selected="selected">-Pilih-</option>
     
         <?php if (count($data) > 1) { ?>     
             <optgroup label="Active" style="font:bold;">
             <?php $no=1; foreach($data as $list) { 
               if ($list->Status == 0) { ?>
             <option value="<?php echo $list->ID;?>"><?php echo $list->Code. " | " .$list->Name. " | " .$list->DivisionName. " | " .$list->JobTitleName;?></option>  
              
             <?php } $no++; 
               } ?>

              <optgroup label="Resign" style="font:bold;">
             <?php $no=1; foreach($data as $list) { 
               if ($list->Status == 1) { ?>
             <option value="<?php echo $list->ID;?>"><?php echo $list->Code. " | " .$list->Name. " | " .$list->DivisionName. " | " .$list->JobTitleName;?></option>   
               
             <?php } $no++; 
               } ?>
         <?php }else{ ?>
             <?php $no=1; foreach($data as $list) { ?> 
             <option value="<?php echo $list->ID;?>"><?php echo $list->Code. " | " .$list->Name. " | " .$list->DivisionName. " | " .$list->JobTitleName;?></option>  
             <?php $no++; } ?> 
         <?php } ?>

    </select></td>
</tr>  
<tr>
   <td>&nbsp;</td>
   <td>
     <button type="button" class="btn btn-block btn-default" id="refresh">Refresh</button>
   </td>
   <td>           
</tr>
<tr></tr>
</table>
</br>   			
<div id="tampil_filterSales"></div>


<!-- ============ Body content end ============= -->    

@endsection 
	

