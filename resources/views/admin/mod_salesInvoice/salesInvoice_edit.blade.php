@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->


<title>Sales Invoice (Edit)</title>

<script type="text/javascript">
$(document).ready(function(){ 

/************************************Variable Global**************************************************************/
    var dataMDckDtl = [];
/*****************************************************************************************************************/

/************************************fungsi ini saat page on load************************************************/
    loadTablefromDB_MDck();
/*****************************************************************************************************************/
    // $( ".date-input-css" ).datepicker({
    //      format:'dd/mm/yyyy',
    //      autoclose: true,
    //      todayHighlight: true,
    //  });

   //function buat memberikan titik pada nilai ribuan 
	 var myintval = function ( i ) {
				return  i.toFixed(0).replace(/./g, function(c, i, a) {
						return i && c !== "," && ((a.length - i) % 3 === 0) ? ',' + c : c;
					});
	    }; 


  $("#Simpan").click(function(){
   var tVoid = 0;

    if ($("#cVoid").prop('checked') == true) {
        var msgbox = confirm("Apakah Anda Yakin Data Ini di Void");
        if (msgbox == true) {              
           tVoid = 1;    
           fsimpan(tVoid);   
       }else {  
             return;
        }
   }else if ($("#cVoid").prop('checked') == false){
         tVoid = 0;
         fsimpan(tVoid); 
  }    
 });   

   function fsimpan(tVoid){

                $('#Simpan').prop('disabled', true);

                  $.ajax({
                    type: 'POST',
                    url:  "{{ route('admin/salesInvoice/rubahdataDetail') }}",
                    data: {"_token": "{{ csrf_token() }}", 'datanya_MDck':dataMDckDtl, txtDocID: $('#txtDocID').val(), txtDocNo: $('#txtDocNo').val(), txtNumber: $('#txtNumber').val(), txtDate: $('#txtDate').val(), cmbCustomer: $('#cmbCustomer').val(), cmbBranch: $('#cmbBranch').val(), cmbSales: $('#cmbSales').val(), cmbWarehouse: $('#cmbWarehouse').val(), cmbTemplate: $('#cmbTemplate').val(), cmbPaymentType: $('#cmbPaymentType').val(), txtTerm: $('#txtTerm').val(), txtNotes: $('#txtNotes').val(), txtRounded: $('#txtRounded').val(), txtDiscount: $('#txtDiscount').val(), lblTax: $('#lblTax').html(), lblInvoice: $('#lblInvoice').html(), lblGrandTotal: $('#lblGrandTotal').html(), txtVoid: tVoid},
                    dataType: 'html',
                    success: function(sData){
                      console.log('function success');
                      console.log(sData);
                       $('#result').html(sData);
                        window.location.replace("{{ route('admin/salesInvoice') }}");
  
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });
                      
         
 }; 
     
  $("#cmbItem").on("change", function(){
      
    $.ajax({
          type: "POST",
          data: {"_token": "{{ csrf_token() }}", ItemID: $('#cmbItem').val(), cmbWarehouse: $('#cmbWarehouse').val()},
          url:  "{{ route('admin/salesInvoice/paramItem') }}",
          dataType: 'JSON',
          success: function(res) {
           
            $("#txtItemCode").val(res['data'][0].Code);
            $("#txtItemName").val(res['data'][0].Name);
            $("#txtUnit").val(res['data'][0].Unit);
            $("#lblStockLast").html(res['data2'][0]['Balance']);
            $("#txtPrice").val(res['data'][0].Price);
            $("#txtSubTotal").val(res['data'][0].SubTotal);
          }

        });
      });


     $("#cmbWarehouse").on("change", function(){
      
        $("#lblStockLast").html('');
      }); 
//batas   



/**********************************************************************************************************************************************************************************/    
function loadTablefromDB_MDck() {  
       var tableContent = []; 
       var list = []; 
       var sum = 0;
       var PPN = 0;
       var Discount = 0;
       var Rounded = 0;


    $.ajax({
        url: "{{ route('admin/salesInvoice/ambilDtl') }}",
        type: 'POST',
        data: {"_token": "{{ csrf_token() }}", txtDocID: $('#txtDocID').val()},
        dataType: 'JSON',
        success: function(list){    

             for (var a = 0; a < list.length; a++){

                var MDckDtlItemID1 = list[a].ItemID;  
                var MDckDtlItemCode1 = list[a].ItemCode;
                var MDckDtlItemName1 = list[a].ItemName;
                var MDckDtlUnit1 = list[a].Unit;
                var MDckDtlQty1 = list[a].Qty;
                var MDckDtlPrice1 = list[a].Price;
                var MDckDtlSubTotal1 = list[a].SubTotal;
               
        
             dataMDckDtl.push({
                MDckDtlItemID: MDckDtlItemID1,  
                MDckDtlItemCode: MDckDtlItemCode1,
                MDckDtlItemName: MDckDtlItemName1,
                MDckDtlUnit: MDckDtlUnit1,
                MDckDtlQty: MDckDtlQty1,
                MDckDtlPrice: MDckDtlPrice1,
                MDckDtlSubTotal: MDckDtlSubTotal1,
              });


            tableContent.push([
            '<tr>',
              '<td style ="display:none">'+list[a].ItemID+'</td>',
              '<td>'+list[a].ItemCode+' | '+list[a].ItemName+'</td>',
              '<td>'+list[a].Unit+'</td>',
              '<td></td>',
              '<td style="text-align:right">'+myintval(parseFloat(list[a].Qty))+'</td>',
              '<td style="text-align:right">'+myintval(parseFloat(list[a].Price))+'</td>',
              '<td style="text-align:right">'+myintval(parseFloat(list[a].SubTotal))+'</td>', 
              '<td>'+'<a href="'+dataMDckDtl.indexOf(dataMDckDtl[a])+'" id="editMDck" class="fa fa-edit"></a>'+'&nbsp;&nbsp;'+'<a href="'+dataMDckDtl.indexOf(dataMDckDtl[a])+'" id="delMDck" class="fa fa-trash"></a>'+'</td>',
            '</tr>',
             ].join(''));

            
            Rounded =  $("#txtRounded").val();
            Discount =  $("#txtDiscount").val();

            sum = ((parseFloat(sum) + parseFloat(Rounded)) - parseFloat(Discount)) + parseFloat(dataMDckDtl[a].MDckDtlSubTotal);
            
            $('#cmbTemplate').prop('disabled', true);

            if ($("#cmbTemplate").val() == 'PPN'){
                PPN = sum * (10/100);  
             }else if ($("#cmbTemplate").val() == 'NON-PPN'){
                PPN = 0;
            } 
    
            
            if (tableContent.length) $('#example5 tbody').html(tableContent);

            
            $("#lblInvoice").html(sum+PPN);
            $("#lblTax").html(PPN);
            $("#lblGrandTotal").html(sum+PPN);

            $("#lblInvoicex").html(myintval(parseFloat(sum+PPN)));
            $("#lblTaxx").html(myintval(parseFloat(PPN)));
            $("#lblGrandTotalx").html(myintval(parseFloat(sum+PPN)));

          }
        }  
    });
 

  }           


$(document).on('click', '#editMDck', function(e){
 //menghindari <a> agar tidak masuk di halaman baru
 e.preventDefault();
 
 if ($('#txtUnit').val() != '' || $('#txtQty').val() != '' || $('#txtPrice').val() != '' || $('#txtSubTotal').val() != ''){
  alert('Selesaikan dulu data yang mau dirubah sebelumnya');
  return;
 } 
 
 //mendapatkan data.indexOf(..) yang disimpan pada href
 var index = $(this).attr('href');
 
  for(var i = 0; i < dataMDckDtl.length; i++) {
          $('#cmbItem').val(dataMDckDtl[index].MDckDtlItemID);
          $('#txtItemCode').val(dataMDckDtl[index].MDckDtlItemCode);
          $('#txtItemName').val(dataMDckDtl[index].MDckDtlItemName);
          $('#txtUnit').val(dataMDckDtl[index].MDckDtlUnit);
          $('#txtQty').val(dataMDckDtl[index].MDckDtlQty);
          $('#txtPrice').val(dataMDckDtl[index].MDckDtlPrice);
          $('#txtSubTotal').val(dataMDckDtl[index].MDckDtlSubTotal);

          $("#cmbItem").trigger("change");
       }
 
 //untuk remove data yang di pilih
 dataMDckDtl.splice(index,1);

 //load data yang ditampilkan
  loadTable_MDck(); 
});


$(document).on('click', '#delMDck', function(e){
 //menghindari <a> agar tidak masuk di halaman baru
 e.preventDefault();
 
 //mendapatkan data.indexOf(..) yang disimpan pada href
 var index = $(this).attr('href');
 
 //untuk remove data yang di pilih
 dataMDckDtl.splice(index,1);
 
 //load data yang ditampilkan
  fBersihComponenDetail_MDck();
  loadTable_MDck(); 
});

function fBersihComponenDetail_MDck(){
      $('#cmbItem').append('<option value=0 selected="selected"></option>');
      $('#txtItemCode').val('');
      $('#txtItemName').val('');
      $('#txtUnit').val('');
      $('#lblStockLast').html('');
      $('#txtQty').val('');
      $('#txtPrice').val('');
      $('#txtSubTotal').val('');
}


function loadTable_MDck(){               
  var tableContent = [];
  var sum = 0;
  var PPN = 0;
  var Discount = 0;
  var Rounded = 0;

          //untuk mengkosongkan data sebelum looping kalau tidak ada ini maka jika datanya 1 masih tetep nyantol tampil
          $('#example5 tbody').html(''); 

          for (var a = 0; a < dataMDckDtl.length; a++){
            tableContent.push([
            '<tr>',
            '<td style ="display:none">'+dataMDckDtl[a].MDckDtlItemID+'</td>',
            '<td>'+dataMDckDtl[a].MDckDtlItemCode+' | '+dataMDckDtl[a].MDckDtlItemName+'</td>',
            '<td>'+dataMDckDtl[a].MDckDtlUnit+'</td>',
            '<td></td>',
            '<td style="text-align:right">'+myintval(parseFloat(dataMDckDtl[a].MDckDtlQty))+'</td>',
            '<td style="text-align:right">'+myintval(parseFloat(dataMDckDtl[a].MDckDtlPrice))+'</td>',
            '<td style="text-align:right">'+myintval(parseFloat(dataMDckDtl[a].MDckDtlSubTotal))+'</td>',
            '<td>'+'<a href="'+dataMDckDtl.indexOf(dataMDckDtl[a])+'" id="editMDck" class="fa fa-edit"></a>'+'&nbsp;&nbsp;'+'<a href="'+dataMDckDtl.indexOf(dataMDckDtl[a])+'" id="delMDck" class="fa fa-trash"></a>'+'</td>',
            '</tr>',
             ].join(''));


            Rounded =  $("#txtRounded").val();
            Discount =  $("#txtDiscount").val();

            sum = ((parseFloat(sum) + parseFloat(Rounded)) - parseFloat(Discount)) + parseFloat(dataMDckDtl[a].MDckDtlSubTotal);
            
            $('#cmbTemplate').prop('disabled', true);

            if ($("#cmbTemplate").val() == 'PPN'){
                PPN = sum * (10/100);  
             }else if ($("#cmbTemplate").val() == 'NON-PPN'){
                PPN = 0;
            } 
    
            
            if (tableContent.length) $('#example5 tbody').html(tableContent);

            
            $("#lblInvoice").html(sum+PPN);
            $("#lblTax").html(PPN);
            $("#lblGrandTotal").html(sum+PPN);

            $("#lblInvoicex").html(myintval(parseFloat(sum+PPN)));
            $("#lblTaxx").html(myintval(parseFloat(PPN)));
            $("#lblGrandTotalx").html(myintval(parseFloat(sum+PPN)));

          }          
 }

 


 $("#SimpanMDckDtlDetail").on("click", function(){
    //if cektexbox apakah kosong 
    
      if ($('#cmbItem').val() == '') {alert('Item Harus Diisi'); $('#cmbItem').focus();}
              else if ($('#txtUnit').val() == '') {alert('Unit Harus Diisi'); $('#txtUnit').focus();}
              else if ($('#txtQty').val() == '') {alert('Qty Harus Diisi'); $('#txtQty').focus();}
              else if ($('#txtPrice').val() == '') {alert('Price Harus Diisi'); $('#txtPrice').focus();}
              else if ($('#txtSubTotal').val() == '') {alert('SubTotal Harus Diisi'); $('#txtSubTotal').focus();}
              else{
                      dataMDckDtl.push({
                         MDckDtlItemID: $('#cmbItem').val(),  
                         MDckDtlItemCode: $('#txtItemCode').val(),
                         MDckDtlItemName: $('#txtItemName').val(),
                         MDckDtlUnit: $('#txtUnit').val(),
                         MDckDtlQty: $('#txtQty').val(),
                         MDckDtlPrice: $('#txtPrice').val(),
                         MDckDtlSubTotal: $('#txtSubTotal').val(),

                       });
                      
                      fBersihComponenDetail_MDck();
                      loadTable_MDck();
      }                               
  });


 $("#txtRounded").on("change", function(){
      if ($("#lblInvoice").html() != '') {

      	 var sum = 0;
         var PPN = 0;
         var Discount = 0;
         var Rounded = 0;

          //untuk mengkosongkan data sebelum looping kalau tidak ada ini maka jika datanya 1 masih tetep nyantol tampil
          

          for (var a = 0; a < dataMDckDtl.length; a++){
           
            Rounded =  $("#txtRounded").val();
            Discount =  $("#txtDiscount").val();

            sum = ((parseFloat(sum) + parseFloat(Rounded)) - parseFloat(Discount)) + parseFloat(dataMDckDtl[a].MDckDtlSubTotal);
            
            $('#cmbTemplate').prop('disabled', true);

            if ($("#cmbTemplate").val() == 'PPN'){
                PPN = sum * (10/100);  
             }else if ($("#cmbTemplate").val() == 'NON-PPN'){
                PPN = 0;
            } 
            
            $("#lblInvoice").html(sum+PPN);
            $("#lblTax").html(PPN);
            $("#lblGrandTotal").html(sum+PPN);

            $("#lblInvoicex").html(myintval(parseFloat(sum+PPN)));
            $("#lblTaxx").html(myintval(parseFloat(PPN)));
            $("#lblGrandTotalx").html(myintval(parseFloat(sum+PPN)));

          }          

      } //end if
    });

  $("#txtDiscount").on("change", function(){
      if ($("#lblInvoice").html() != '') {

      	 var sum = 0;
         var PPN = 0;
         var Discount = 0;
         var Rounded = 0;

          //untuk mengkosongkan data sebelum looping kalau tidak ada ini maka jika datanya 1 masih tetep nyantol tampil
          

          for (var a = 0; a < dataMDckDtl.length; a++){
           
            Rounded =  $("#txtRounded").val();
            Discount =  $("#txtDiscount").val();

            sum = ((parseFloat(sum) + parseFloat(Rounded)) - parseFloat(Discount)) + parseFloat(dataMDckDtl[a].MDckDtlSubTotal);
            
            $('#cmbTemplate').prop('disabled', true);

            if ($("#cmbTemplate").val() == 'PPN'){
                PPN = sum * (10/100);  
             }else if ($("#cmbTemplate").val() == 'NON-PPN'){
                PPN = 0;
            } 
            
            $("#lblInvoice").html(sum+PPN);
            $("#lblTax").html(PPN);
            $("#lblGrandTotal").html(sum+PPN);

            $("#lblInvoicex").html(myintval(parseFloat(sum+PPN)));
            $("#lblTaxx").html(myintval(parseFloat(PPN)));
            $("#lblGrandTotalx").html(myintval(parseFloat(sum+PPN)));

          }          

      } //end if
    });

    $("#txtDate").on("change", function(){
       var a = new Date($("#txtDateOri").val());
       var date1 = a.getMonth()+'-'+a.getFullYear();
       
       var b = new Date($("#txtDate").val());
       var date2 = b.getMonth()+'-'+b.getFullYear();
       
       if(date1 != date2) {
           alert('Tidak Boleh Ganti Tanggal Beda Bulan');
           $("#txtDate").val($("#txtDateOri").val());
       }

    }); 

    $("#txtQty").on("change", function(){
       $("#txtSubTotal").val($("#txtPrice").val() * $("#txtQty").val());  
    
    });

    $("#txtPrice").on("change", function(){
       $("#txtSubTotal").val($("#txtPrice").val() * $("#txtQty").val());  
    
    });


}); //tutupnya 'Document Ready Function'

</script>

<style type="text/css">
   .besar {
   font-size: 50px;
   }
</style>


<div class="content-wrapper">
  <section class="content-header">
      <h1><div class="besar">Sales Invoice (Edit)</div></h1>
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
                   <td>Void</td>
                   <td><input type="checkbox" id="cVoid" ></td>
                  </tr>  

                  <tr>
                    <td>Number</td>
                        <input type="hidden" id="txtDocID" class="form-control" readonly value="<?php echo $data3[0]->ID; ?>">
                        <input type="hidden" id="txtDocNo" class="form-control" readonly value="<?php echo $data3[0]->No; ?>">
                    <td><input type="text" id="txtNumber" class="form-control" readonly value="<?php echo $data3[0]->Number; ?>"></td> 
                    <td>Branch</td>
                    <td><select id="cmbBranch" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected"></option>
                         <?php $no=1; foreach($data5 as $list) {
                          if ($data3[0]->BranchID==$list->ID){
                             echo "<option value='".$list->ID."' selected>".$list->Name."</option>";
                           }else{  
                             echo "<option value='".$list->ID."' >".$list->Name."</option>";
                           } 
                          } 
                         ?>
                         </select>
                    </td>
                    <td>Payment Type</td>
                    <td><select id="cmbPaymentType" data-mini="true" class="form-control select2" >
                         <?php if ($data3[0]->PaymentType == 'CREDIT'){  ?>
                           <option value="">-</option>
                           <option value="CREDIT" selected="selected">CREDIT</option>
                           <option value="CASH">CASH</option>
                         <?php }else if ($data3[0]->PaymentType == 'CASH'){  ?> 
                           <option value="">-</option>
                           <option value="CREDIT">CREDIT</option>
                           <option value="CASH" selected="selected">CASH</option>
                         <?php }else { ?>
                           <option value="" selected="selected">-</option>
                           <option value="CREDIT">CREDIT</option>
                           <option value="CASH">CASH</option>
                         <?php } ?>

                        </select> 
                    </td>
                  </tr>
                  <tr>
                    <td>Date</td>
                    <td><input type="date" id="txtDate" class="form-control" value="<?php echo date('Y-m-d',strtotime($data3[0]->Date)) ?>"  style="z-index:0; position:relative" ></td>
                        <input type="hidden" id="txtDateOri" class="form-control" value="<?php echo date('Y-m-d',strtotime($data3[0]->Date)) ?>" >
                    <td>Sales</td>
                    <td> <select id="cmbSales" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected"></option>
                         <?php $no=1; foreach($data6 as $list) {
                           if ($data3[0]->SalesID==$list->ID){
                             echo "<option value='".$list->ID."' selected>".$list->Name."</option>";
                           }else{  
                             echo "<option value='".$list->ID."' >".$list->Name."</option>";
                           } 
                          } 
                         ?>
                         </select>
                    </td>
                    <td>Term</td>
                    <td><input type="text" id="txtTerm" value="<?php echo $data3[0]->Term; ?>" class="form-control" disabled="disabled"></td>
                  </tr>
                  <tr>
                    <td>Customer</td>
                    <td> <select id="cmbCustomer" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         <?php $no=1; foreach($data4 as $list) {
                          if ($data3[0]->CustomerID==$list->ID){
                             echo "<option value='".$list->ID."' selected>".$list->Name."</option>";
                           }else{  
                             echo "<option value='".$list->ID."' >".$list->Name."</option>";
                           } 
                          } 
                         ?>
                         </select>
                    </td> 
                    <td>Warehouse</td>
                    <td> <select id="cmbWarehouse" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected"></option>
                         <?php $no=1; foreach($data2 as $list) {
                          if ($data3[0]->WarehouseID==$list->ID){
                             echo "<option value='".$list->ID."' selected>".$list->Name."</option>";
                           }else{  
                             echo "<option value='".$list->ID."' >".$list->Name."</option>";
                           } 
                          } 
                         ?>
                         </select>
                    </td>
                    <td rowspan="2">Notes</td>
                    <td rowspan="2"><textarea id="txtNotes" class="form-control"><?php echo $data3[0]->Notes; ?></textarea></td>
                  </tr>
                  <tr>

                    <td>Reff Number</td>
                    <td> <select id="cmbReffNumber" data-mini="true" class="form-control select2" >
                         <option value="" selected="selected">-Pilih-</option>
                         </select>
                    </td> 
                    <td>Template</td>
                    <td><select id="cmbTemplate" data-mini="true" class="form-control select2" >
                         

                         <?php if ($data3[0]->Template == 'PPN'){  ?>
                           <option value="">-</option>
                           <option value="PPN" selected="selected">PPN</option>
                           <option value="NON-PPN">NON-PPN</option>
                         <?php }else if ($data3[0]->Template == 'NON-PPN'){  ?> 
                           <option value="">-</option>
                           <option value="PPN">PPN</option>
                           <option value="NON-PPN" selected="selected">NON-PPN</option>
                         <?php }else { ?>
                           <option value="" selected="selected">-</option>
                           <option value="PPN">PPN</option>
                           <option value="NON-PPN">NON-PPN</option>
                         <?php } ?>

                        </select> 
                    </td>
                  </tr>

            </table>
            <br>
            <br>


 <table id="example5" class="table table-bordered table-striped" cellspacing="0" width="100%" >
       <thead >
            <tr bgcolor="#ECF0F5">
              <th>Item</th>
              <th>Unit</th>
              <th>InStc</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Sub Total</th>
              <th>Opsi</th>
            </tr>
       
         <tr>
        
                  <td><select id="cmbItem" data-mini="true" class="form-control select2">
                         <option value='0' selected="selected"></option>
                         <?php $no=1; foreach($data as $list) 
                            { 
                             echo "<option value='".$list->ID."'>".$list->Code." | ".$list->ItemName." | ".$list->ItemCategoryName."</option>";
                            } 
                         ?>
                    </select>
                    <input id="txtItemCode" type="hidden" class="form-control" />
                    <input id="txtItemName" type="hidden" class="form-control" />
                  </td>
              
            
                 <td><input id="txtUnit" type="text" class="form-control" disabled/></td>
                 <td><div id="lblStockLast" style=""></div></td>

                <td><input id="txtQty" type="tel" class="form-control" /></td>
                <td><input id="txtPrice" type="tel" class="form-control" /></td>
                <td><input id="txtSubTotal" type="tel" class="form-control" /></td>

                <td><center><a class="fa fa-plus-square" id="SimpanMDckDtlDetail"></a></center></td>
         </tr> 
        </thead>     
<tbody></tbody>
</table>

<br><br>

<table class="table" border="0">
  <tr>  
    <td colspan="4"></td>
    <td align="right">Rounded</td>
    <td align="right" width="20px"><input id="txtRounded" type="number" value="<?php echo $data3[0]->Rounded; ?>" /></td>
  </tr>
  <tr>  
    <td colspan="4"></td>
    <td align="right">Discount</td>
    <td align="right" width="20px"><input id="txtDiscount" type="number"  value="<?php echo $data3[0]->DiscountAmount; ?>"/></td>
  </tr>
  <tr>  
    <td colspan="4"></td>
    <td align="right">Invoice</td>
    <td align="right"><div style="display: none;" id="lblInvoice"></div>
    	              <div id="lblInvoicex"></div>
    </td>
  </tr>
  <tr>  
    <td colspan="4"></td>
    <td align="right">Tax</td>
    <td align="right"><div style="display: none;" id="lblTax"></div>
                      <div id="lblTaxx"></div> 
    </td>
  </tr>
  <tr>  
    <td colspan="4"></td>
    <td align="right">Grand Total</td>
    <td align="right"><div style="display: none;" id="lblGrandTotal"></div>
                      <div id="lblGrandTotalx"></div>
    </td>
  </tr>
</table>
</form>

<table class="table">
      <tr>
        <td><button type="submit" id="Simpan" class="btn btn-primary btn-block">Save </button></td>            
      </tr>
</table>      

<!-- ============ Body content end ============= -->    

@endsection 