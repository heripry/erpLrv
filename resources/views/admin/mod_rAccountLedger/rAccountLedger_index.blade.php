@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->


<title>Account Ledger</title>

<script type="text/javascript"> 
$(document).ready( function(){
 
     loadBrowse();

    $("#txtFirstDate").on("change", function(){
      loadBrowse();
    });

    $("#txtLastDate").on("change", function(){
      loadBrowse();
    });

    $("#cmbAccount").on("change", function(){
      loadBrowse();
    });


    $( ".date-input-css" ).datepicker({
         format:'dd/mm/yyyy',
         autoclose: true,
         todayHighlight: true,
     });

   function loadBrowse(){
    var firstDate = $("#txtFirstDate").val();
    var lastDate = $("#txtLastDate").val();
    var cmbAccount = $("#cmbAccount").val();
    

     $.ajax({
      type: "POST",
      data:  { "_token": "{{ csrf_token() }}", firstDate: firstDate, lastDate: lastDate, cmbAccount: cmbAccount },
      url: "{{ route('admin/rAccountLedger/browse_SO') }}",
      success: function(html){
        $("#tampil_browse_SO").html(html);
        console.log('done');
         }
     });
   };    

});
</script>

<div class="content-wrapper">
  <section class="content-header">
      <h1>Account Ledger</h1>
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

            <div class="box-body">
              <div class="row">
                <div class="col-xs-1">
                  <p>Date</p>
                </div>
               <div class="col-xs-3">
                  <input type="date" id="txtFirstDate" class="form-control" value="<?php echo date("Y-m-d", strtotime('-1 month')); ?>" />
                </div>
              </div>  
              <br>
              <div class="row">
                <div class="col-xs-1">
                  <p>to</p>
                </div>
                <div class="col-xs-3">
                  <input type="date" id="txtLastDate" class="form-control" value="<?php echo date("Y-m-d"); ?>"  />
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-1">
                  <p>Account</p>
                </div>
                <div class="col-xs-6">
                <select id="cmbAccount" data-mini="true" class="form-control select2">
                     <option value="0" selected="selected">-Pilih-</option>
                     <?php $no=1; foreach($data as $list) 
                        { 
                         echo "<option value='".$list->Code."'>".$list->Name."</option>";
                        } 
                     ?>
                </select>
                </div>
              </div>              
              <br>
             

            </div>

<div id='tampil_browse_SO'></div>

<!-- ============ Body content end ============= -->    

@endsection 