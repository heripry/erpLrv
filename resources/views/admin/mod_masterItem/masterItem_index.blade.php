@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->


<title>Master Article</title>

<script type="text/javascript"> 
$(document).ready( function(){
    
    loadBrowse();

    $( ".date-input-css" ).datepicker({
         format:'dd/mm/yyyy',
         autoclose: true,
         todayHighlight: true,
     });

    $("#txtFirstDate").on("change", function(){
      loadBrowse();
    });

    $("#txtLastDate").on("change", function(){
      loadBrowse();
    });

    $("#cmbFilter").on("change", function(){
      loadBrowse();
    });

    $("#cmbFilter2").on("change", function(){
      loadBrowse();
    });

   function loadBrowse(){
    var firstDate = $("#txtFirstDate").val();
    var lastDate = $("#txtLastDate").val();
    var cmbFilter = $("#cmbFilter").val();
    var cmbFilter2 = $("#cmbFilter2").val();

     $.ajax({
      type: "POST",
      data:  { "_token": "{{ csrf_token() }}", firstDate: firstDate, lastDate: lastDate, cmbFilter: cmbFilter, cmbFilter2: cmbFilter2 },
      url: "{{ route('admin/masterItem/browse_SO') }}",
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
      <h1>Master Article</h1>
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
                <div class="col-xs-2">
                  <input type="text" id="txtFirstDate" class="date-input-css" value="<?php echo date("01/m/Y"); ?>" style="z-index:2000; position:relative" readonly  />
                </div>
                <div class="col-xs-1">
                  <p>to</p>
                </div>
                <div class="col-xs-2">
                  <input type="text" id="txtLastDate" class="date-input-css" value="<?php echo date("t/m/Y"); ?>"  style="z-index:0; position:relative" readonly />
                </div>
              </div>     
              <br>
              <div class="row">
                <div class="col-xs-1">
                  <p>Filter</p>
                </div>
                <div class="col-xs-3">
                <select id="cmbFilter" data-mini="true" class="form-control">
                     <option value="1" >Release</option>
                     <option value="0" selected="selected">Draft</option>
                </select>
                </div>
                <div class="col-xs-3">
                <select id="cmbFilter2" data-mini="true" class="form-control">
                     <option value="1" selected="selected">Active</option>
                     <option value="0" >inActive</option>
                </select>
                </div>
                <div class="col-xs-3">
                  <button type="button" class="btn btn-block btn-default" onclick="javascript:window.location.href='masterItem/form_tambahdata'">Add</button>
                </div>
              </div>            

            </div>


<div id='tampil_browse_SO'></div>

<!-- ============ Body content end ============= -->    

@endsection 