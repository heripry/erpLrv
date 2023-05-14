@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>AR Payment (Add)</title>

<script type="text/javascript">
$(document).ready(function(){ 

/************************************Variable Global**************************************************************/
    var dataMDckDtl = [];
    var ID = [];
/*****************************************************************************************************************/

   //function buat memberikan titik pada nilai ribuan 
   var myintval = function ( i ) {
            return  i.toFixed(0).replace(/./g, function(c, i, a) {
                return i && c !== "," && ((a.length - i) % 3 === 0) ? ',' + c : c;
              });
          }; 
  
    //function buat rounded desimal ex round(1.005, 2); // hasil 1.01
   function round(value, decimals) {
         return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
      } 


  $("#Simpan").click(function(){
     ID.length = 0;
     
      $("input[id='checkbox']:checked").each(function() {
           ID.push($(this).val()+'*'+$(this).parents("tr").find("#txtPayment").val()); 
      });
 
    
    if ($("#txtInvPayment").val() == ''){
           alert('Payment harus di isi');
           $("#txtInvPayment").trigger('click');
           $("#txtInvPayment").focus();

     }else if ($("#txtTotal").val() != $("#txtInvPayment").val()){
           alert('Payment harus sama dengan total');
           $("#txtInvPayment").focus();
     
     }else{ 
                $('#Simpan').prop('disabled', true);
                      
                  $.ajax({
                    type: 'POST',
                    url:  "{{ route('admin/arPaymentRcv/tambahdataDetail') }}",
                    data: {"_token": "{{ csrf_token() }}", 'datanya_MDck':dataMDckDtl, ID: ID, txtNumber: $('#txtNumber').val(), txtDate: $('#txtDate').val(), cmbCustomer: $('#cmbCustomer').val(), cmbAccount: $('#cmbAccount').val(), cmbMethod: $('#cmbMethod').val(), txtChequeDueDate: $('#txtChequeDueDate').val(), txtChequeNumber: $('#txtChequeNumber').val(), cmbCoa: $('#cmbCoa').val(), txtInvPayment: $('#txtInvPayment').val(), txtNotes: $('#txtNotes').val()},
                    dataType: 'html',
                    success: function(sData){
                      console.log('function success');
                      console.log(sData);
                       $('#result').html(sData);
                        window.location.replace("{{ route('admin/arPaymentRcv') }}");
  
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });
    }                
         
 }); //tutup simpan

  $("#txtInvPayment").on("click", function(){
      var Total  = 0;
      $("input[id='checkbox']:checked").each(function() {
           Total = parseFloat(Total) + parseFloat($(this).parents("tr").find("#txtPayment ").val());
      }); 
      $("#txtTotal").val(Total);    
  });

     
  $("#cmbCustomer").on("change", function(){
      
    $.ajax({
          type: "POST",
          data: {"_token": "{{ csrf_token() }}", ID: $('#cmbCustomer').val()},
          url:  "{{ route('admin/arPaymentRcv/paramCustomer') }}",
          dataType: 'JSON',
          success: function(res) {
           
           console.log(res);
           
           for (var a = 0; a < res.length; a++){
        
             dataMDckDtl.push({
                MDckDtlID: res[a].ID,   
                MDckDtlDocType: res[a].DocType,
                MDckDtlDate: res[a].DateVcr,
                MDckDtlNumber: res[a].Number,
                MDckDtlGrandTotal: res[a].GrandTotal,
                MDckDtlOpenAmount: res[a].OpenAmount,
              });

           }
         
            loadTable_MDck();
         
          }

        });
      });


function loadTable_MDck(){               
  var tableContent = [];

          //untuk mengkosongkan data sebelum looping kalau tidak ada ini maka jika datanya 1 masih tetep nyantol tampil
          $('#example5 tbody').html(''); 

          for (var a = 0; a < dataMDckDtl.length; a++){
            tableContent.push([
            '<tr>',
            '<td style ="display:none"><input type="checkbox" id="checkbox" value='+dataMDckDtl[a].MDckDtlID+'$'+dataMDckDtl[a].MDckDtlDocType+'&'+dataMDckDtl[a].MDckDtlNumber+' checked></td>',
            '<td style ="display:none">'+dataMDckDtl[a].MDckDtlID+'</td>',
            '<td>'+dataMDckDtl[a].MDckDtlDate+'</td>',
            '<td>'+dataMDckDtl[a].MDckDtlNumber+'</td>',
            '<td>'+myintval(parseFloat(dataMDckDtl[a].MDckDtlGrandTotal))+'</td>',
            '<td>'+myintval(parseFloat(dataMDckDtl[a].MDckDtlOpenAmount))+'</td>',
            '<td><input type="text" id="txtPayment" value="0"></td>',
            '</tr>',
             ].join(''));


            if (tableContent.length) $('#example5 tbody').html(tableContent);

          }          
 }

 

}); //tutupnya 'Document Ready Function'

</script>

<style type="text/css">
   .besar {
   font-size: 50px;
   }
</style>


<div class="content-wrapper">
  <section class="content-header">
      <h1><div class="besar"> AR Payment (Add)</div></h1>
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

            <table id="example" class="table table-bordered" cellspacing="0" width="100%">

                  <tr>
                    <td>Number</td>
                    <td><input type="text" id="txtNumber" class="form-control" readonly style=""></td> 
                    <td>Method</td>
                    <td><select id="cmbMethod" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         <option value="CS" >Cash</option>
                         <option value="TF" >Transfer</option>
                         <option value="CQ" >Cheque</option>
                    </td>
                    <td rowspan="4">Notes</td>
                    <td rowspan="4"><textarea id="txtNotes" class="form-control"></textarea></td>
                  </tr>
                  <tr>
                    <td>Date</td>
                    <td><input type="date" id="txtDate" class="form-control" value="<?php echo date("Y-m-d"); ?>"  style="z-index:0; position:relative" ></td> 
                    <td>Due Date</td>
                    <td><input type="date" id="txtChequeDueDate" class="form-control" value="<?php echo date("Y-m-d"); ?>"  style="z-index:0; position:relative" ></td> 
                    
                  </tr>
                  <tr>
                    <td>Customer</td>
                    <td> <select id="cmbCustomer" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         <?php $no=1; foreach($data as $list) 
                            { 
                             echo "<option value='".$list->ID."'>".$list->Name." | ".$list->Address." | ".$list->City."</option>";
                            } 
                         ?>
                         </select>
                    </td>
                    <td>Cheque No</td>
                    <td><input type="text" id="txtChequeNumber" class="form-control"></textarea></td>
                    
                  </tr>
                  <tr>
                   <td>Account</td>
                    <td> <select id="cmbAccount" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         <?php $no=1; foreach($data2 as $list) 
                            { 
                             echo "<option value='".$list->ID."'>".$list->Code." | ".$list->Name."</option>";
                            } 
                         ?>
                         </select>
                    </td> 
                    <td>Coa</td>
                    <td><select id="cmbCoa" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         <?php $no=1; foreach($data3 as $list) 
                            { 
                             echo "<option value='".$list->ID."'>".$list->Name."</option>";
                            } 
                         ?>
                         </select>
                    </td>
                    
                  </tr>
            </table>
            <br>
            <br>


 <table id="example5" class="table table-bordered table-striped" cellspacing="0" width="100%" >
       <thead >
            <tr bgcolor="#ECF0F5">
              <th>Date</th>
              <th>Number</th>
              <th>Total</th>
              <th>OpenAmount</th>
              <th>Payment</th>
            </tr> 
        </thead>    
         <tfoot>
           <tr>
            <th colspan="3"></th>
            <th>Total</th>
            <td><input type="text" id="txtTotal" disabled></td>
           </tr>
           <tr>
            <th colspan="3"></th>
            <th>Payment</th>
            <td><input type="text" id="txtInvPayment"></td>
           </tr>
         </tfoot>
  <tbody></tbody>       
</table>
<br>
<br>

<table class="table">
      <tr>
        <td><button type="submit" id="Simpan" class="btn btn-primary btn-block">Save </button></td>            
      </tr>
</table>   

<!-- ============ Body content end ============= -->    

@endsection  