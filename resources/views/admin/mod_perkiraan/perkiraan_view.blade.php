@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>Master Perkiraan</title>
<script type="text/javascript">
$(document).ready(function(){
 
          $("#gridContainer").dxDataGrid({
                  dataSource: <?php echo json_encode($data); ?>,
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
                                  return $("<a>", { "href": "perkiraan/form_rubahdata/" + options.data.Perkiraan}).text('EDIT'); 
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
                },
                export: {
                    enabled: true
                },
                onExporting: function(e) {
                  var workbook = new ExcelJS.Workbook();
                  var worksheet = workbook.addWorksheet('Perkiraan');
                  
                  DevExpress.excelExporter.exportDataGrid({
                    component: e.component,
                    worksheet: worksheet,
                    autoFilterEnabled: true
                  }).then(function() {
                    workbook.xlsx.writeBuffer().then(function(buffer) {
                      saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Perkiraan.xlsx');
                    });
                  });
                  e.cancel = true;
                }
        });        

       
}); //tutupnya 'Document Ready Function'

</script>


<footer class="main-footer">
  <div class="pull-right hidden-xs">
      <button type="submit" onclick="javascript:window.location.href='perkiraan/form_tambahdata'" class="btn btn-primary btn-block" ><i class="fa fa-plus-circle"></i> Add</button>
  </div>
    <h4>Master Perkiraan</h4>
</footer>


<div class="content-wrapper">
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Master Perkiraan</h3>
            </div>
                    <div class="box-body"> 

                        <div id="gridContainer" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></div>
                         <?php //echo json_encode($data); ?>
                         
                    </div>
                
                </div>
            </div>
         </div>
       </section>
     </div>


<!-- ============ Body content end ============= -->    

@endsection
