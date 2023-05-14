@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>Edit Master Perkiraan</title>

<script type="text/javascript">
$(document).ready(function(){ 

  $('#example').dataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": true,
      "bFilter": true,
      
      "scrollX": true,
      "bDestroy": true,
      "scrollY": "350px",
      "scrollCollapse": true,
      "paging": false
            
  });

 $("#gridContainer").dxDataGrid({
                  dataSource: <?php echo json_encode($data2); ?>,
                  columns: [{
                                dataField: "Perkiraan",
                                headerCellTemplate: function(container) {
                                   container.append($("<strong>Perkiraan</strong>"));
                                }
                            }, {
                                dataField: "Parent",
                                headerCellTemplate: function(container) {
                                   container.append($("<strong>Parent</strong>"));
                                }
                            }, {
                                dataField: "Keterangan",
                                headerCellTemplate: function(container) {
                                   container.append($("<strong>Keterangan</strong>"));
                                } 
                             }, {
                                dataField: "NonAktif",
                                cellTemplate: function(container, options) {
                                  if (options.data.NonAktif == 0) {
                                    return $("<span class='label label-success'>Yes</span>"); 
                                  }else{
                                    return $("<span class='label label-danger'>No</span>");
                                  }
                                },
                                headerCellTemplate: function(container) {
                                   container.append($("<strong>Active</strong>"));
                                }     
                             }, {
                                 dataField: "Perkiraan",
                                 cellTemplate: function(container, options) {
                                  //return $("<a>", { "href": "perkiraan/form_rubahdata/" + options.data.Perkiraan}).text('Edit'); 
                                    $("<div />").dxButton({  
                                        //icon: 'back',
                                        text: 'Pilih',
                                        onClick: function (e) {  
                                            
                                             $("#cbGroubPerkiraan").val( options.text );
                                             closeModal();
                                        }  
                                    }).appendTo(container); 
                                },
                                headerCellTemplate: function(container) {
                                    container.append($("<strong>Opsi</strong>"));
                                }

                           }],         
                  
                  summary:  {
                  totalItems: [{
                                  column: "Perkiraan",
                                  summaryType: "count"
                                 
                             
                              }]           
                            },

                showBorders: true,
                rowAlternationEnabled: true,
                allowColumnResizing: true,
                columnAutoWidth: true,
                filterRow: { visible: true },
                columnFixing: {
                 enabled: false
                },
                searchPanel: {
                  visible: false
                },
                selection: {
                  mode: "single"
                },
                paging: { 
                  enabled: false 
                },
                columnChooser: {
                  enabled: true,
                  mode: "select"
                }
        });    

  // $('#example').on('click', '#btnCabID', function() { 
  //    $("#cbGroubPerkiraan").val( $(this).closest('tr').find('td:eq(0)').text() );
  // });

 $('#btnModal').click(function() { 
    $("#myModal").modal('show');
  });  


 function closeModal (){
    $("#myModal").modal('hide');
 }

  $("#Simpan").click(function(){


                $('#Simpan').prop('disabled', true);
                document.getElementById("Simpan").value= "Processing..";
                      
                var tinActive = 0;
                  if ($("#inActive").prop('checked') == true) {
                        tinActive = 1;
                   }else{
                        tinActive = 0;
                  }

                  $.ajax({
                    type: "POST",
                    url:  "{{ route('admin/perkiraan/rubahdataDetail') }}",
                    data: {"_token": "{{ csrf_token() }}", ID: $('#txtID').val(), Perkiraan: $('#txtPerkiraan').val(), GroupPerkiraan: $('#cbGroubPerkiraan').val(), Keterangan: $('#txtKeterangan').val(), inActive: tinActive, CabID: $('#cbCabID').val(), Kelompok: $('#cbKelompok').val(), GenOrDet: $('#cbGenOrDet').val(), MataUang: $('#cbMataUang').val(), DebOrKre: $('#cbDebOrKre').val(), NoNeraca: $('#txtNoNeraca').val(), KodeBukti: $('#txtKodeBukti').val()},
                    dataType: 'html',
                    success: function(sData){
                      console.log('function success');
                      console.log(sData);
                       $('#result').html(sData);
                        window.location.replace("{{ route('admin/perkiraan') }}");
  
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });
                         
         
 }); //tutup simpan
       
}); //tutupnya 'Document Ready Function'

</script>

  <style>
      .input-container{
        width: 250px;
        border: 1px solid #a9a9a9;
        display: inline-block;
       }
       .input-container input:focus, .input-container input:active {
          outline: none;
       }
       .input-container input {
          width: 80%;
          border: none;
       }

       .input-container button {
          float: right;
       }

      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }

      .example-modal .modal {
        background: transparent !important;
      }
  </style>


<footer class="main-footer">
  <div class="pull-right hidden-xs">
      <button type="submit" id="Simpan" class="btn btn-primary btn-block"><i class="fa fa-floppy-o"></i> Save</button>
  </div>
    <h4>Master Perkiraan</h4>
</footer>


<div class="content-wrapper">
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Master Perkiraan</h3>
            </div>

              <div class="box-body"> 
               <div class="row">
                 <div class="col-md-2 form-group mb-1">
                  <p>Perkiraan</p>
                </div>
                <div class="col-md-2 form-group mb-3">
                  <input type="hidden" id="txtID" class="form-control" value="<?php echo $data[0]->Perkiraan; ?>">
                  <input type="text" id="txtPerkiraan" class="form-control" value="<?php echo $data[0]->Perkiraan; ?>">
                </div>
                
                <div class="col-md-1 form-group mb-1">
                  <p>inActive</p>
                </div>
                <div class="col-md-1 form-group mb-3">
                  <?php if ($data[0]->NonAktif== 1){ ?>
                     <input type="checkbox" id="inActive" class="minimal" checked="checked">
                  <?php }else {?>
                     <input type="checkbox" id="inActive" class="minimal">  
                  <?php } ?>   
                </div>
                
                <div class="col-md-2 form-group mb-1">
                  <p>Group Perkiraan</p>
                </div>

                 <div class="col-md-2 form-group mb-3">
                  <div class="input-group">
                       <input type="text" id="cbGroubPerkiraan" class="form-control" readonly="readonly" value="<?php echo $data[0]->Parent; ?>">
                       <span class="input-group-addon"><button type="button" id="btnModal">...</button></span>
                  </div>
                 </div>

               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Keterangan</p>
                </div>
                <div class="col-md-10 form-group mb-3">
                  <input type="text" id="txtKeterangan" class="form-control" value="<?php echo $data[0]->Keterangan; ?>" >
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Cab ID</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <select id="cbCabID" class="form-control select2">
                      <!-- <option value="0">-Pilih-</option> -->
                      <?php 
                        $no=1; foreach($data3 as $list) {
                          if($data[0]->KodeCabang == $list->KodeCabang){
                            echo "<option value='".$list->KodeCabang."' selected>".$list->KodeCabang." | ".$list->NamaCabang."</option>";  
                          }else{
                            echo "<option value='".$list->KodeCabang."'>".$list->KodeCabang." | ".$list->NamaCabang."</option>";
                          }
                        }
                      ?>
                  </select>
                </div>
               </div>
               
               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Kelompok</p>
                </div>
                <div class="col-md-2 form-group mb-3">
                  <select id="cbKelompok" class="form-control">
                      <!-- <option value="0">-Pilih-</option> -->
                      <?php 
                        $no=1; foreach($data4 as $list) {
                          if($data[0]->Kelompok == $list->Kelompok){
                            echo "<option value='".$list->Kelompok."' selected>".$list->Kelompok."</option>";  
                          }else{
                            echo "<option value='".$list->Kelompok."'>".$list->Kelompok."</option>";
                          }
                        }
                      ?>
                  </select>
                </div>
               </div>


               <div class="row">
                <div class="col-md-2 form-group mb-1"> 
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1"> 
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1"> 
                </div>
               </div>


               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>General / Detail</p>
                </div>
                <div class="col-md-2 form-group mb-3">
                  <select id="cbGenOrDet" class="form-control">
                      <?php if ($data[0]->Tipe== 0){ ?>
                        <option value="0" selected="selected">General</option>
                        <option value="1">Detail</option>
                     <?php }else if ($data[0]->Tipe== 1){ ?>
                        <option value="0" >General</option>
                        <option value="1" selected="selected">Detail</option> 
                     <?php } ?>  
                  </select>
                </div>
               </div>
               
               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Mata Uang</p>
                </div>
                <div class="col-md-2 form-group mb-3">
                  <select id="cbMataUang" class="form-control">
                    <?php if ($data[0]->Valas== 'IDR') { ?>
                       <option value="IDR" selected="">IDR</option>
                       <option value="US">US</option>
                     <?php }else if ($data[0]->Valas== 'US') { ?>
                        <option value="IDR">IDR</option>
                        <option value="US" selected="selected">US</option>
                     <?php } ?>
                  </select>
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Debet / Kredit</p>
                </div>
                <div class="col-md-2 form-group mb-3">
                  <select id="cbDebOrKre" class="form-control">
                      <?php if ($data[0]->DK== 0){ ?>
                        <option value="0" selected="selected">Debet</option>
                        <option value="1">Kredit</option>
                     <?php }else if ($data[0]->DK== 1){ ?>
                        <option value="0" >Debet</option>
                        <option value="1" selected="selected">Kredit</option> 
                     <?php } ?> 
                  </select>
                </div>
               </div>


               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Nomor Neraca</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtNoNeraca" class="form-control" value="<?php echo $data[0]->Neraca; ?>">
                </div>
               </div>  
             
               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Kode Bukti</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtKodeBukti" class="form-control" >
                </div>
               </div>
         
        </div>
         
          </div>
        </div>


      </div>

         <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Master Perkiraan</h4>
              </div>
              <div class="modal-body">
                     <div id="gridContainer" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></div>
              </div>
              <div class="modal-footer">
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     </div> 
   </section>
 </div>


             
<!-- ============ Body content end ============= -->    

@endsection          