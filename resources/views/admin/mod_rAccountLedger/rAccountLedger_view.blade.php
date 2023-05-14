<?php error_reporting(0); ?>
<title>Account Ledger</title>

<script type="text/javascript"> 
$(document).ready( function(){

  $('#example').dataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      "bSort": false,

      
      "scrollX": true,
      "bDestroy": true,
      "dom": 'lBfrtip',
            
            "buttons": [
                  //{ extend: 'copyHtml5', footer: true },
                  { extend: 'excelHtml5', footer: true },
                  //{ extend: 'csvHtml5', footer: true },
                  { extend: 'pdfHtml5', footer: true },
                  { extend: 'print' }
                ],
          
          
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

                  // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };
            

            var myintval = function ( i ) {
                    return  i.toFixed(0).replace(/./g, function(c, i, a) {
                            return i && c !== "," && ((a.length - i) % 3 === 0) ? ',' + c : c;
                        });
                };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
               intVal(pageTotal)
            );

            // Total over all pages
            total2 = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Total over this page
            pageTotal2 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
               intVal(pageTotal2)
            );

            // Total over all pages
            total3 = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                   return intVal(a) + intVal(b);
                   // return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Total over this page
            pageTotal3 = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                	return intVal(a) + intVal(b);
                    //return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
               intVal(pageTotal3)
            );

          }
          /*--------------batas sum----------------*/         
            
    });

});
</script>


<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th>Date</th>
            <th>Number</th>
            <th>Debit</th>
            <th>Credit</th> 
            <th>Balance</th>    
          </tr>
        </thead>
         <tfoot>
            <tr>
                <!-- <th colspan="2" style="text-align:right">Total:</th>
                <th style="text-align:right"></th>
                <th style="text-align:right"></th>
                <th style="text-align:right"></th> -->
            </tr>
        </tfoot>

        <tbody>
        <?php $no=1; foreach($data as $list) { ?>             
        <tr>
            <td><?php echo date_format(date_create($list->Date), 'd/m/Y'); ?></td>  
            <td><?php echo $list->Number.' / '.$list->Info.' / '.$list->Notes; ?></td>
            <td align="right"><?php echo number_format($list->Debit,1); ?></td>
            <td align="right"><?php echo number_format($list->Credit,1); ?></td>
            <td align="right"><?php echo number_format($list->Balance,1); ?></td>            

    <?php } ?>

     </tr>        
   </tbody>
  </table>
    
