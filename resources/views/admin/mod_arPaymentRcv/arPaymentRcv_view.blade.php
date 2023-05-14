<title>AR Payment</title>

<script type="text/javascript"> 
$(document).ready( function(){

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
            "paging": false,

            /*--------membuat sum di footer colom --------*/
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseInt(a.toString().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(b.toString().replace(",","").replace(",","").replace(",","").replace(",",""));
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
               myintval(pageTotal)
            );
          }
           /*--------------batas sum----------------*/

						
    });

});
</script>

<table>
<tr>
   <td>
     <button type="button" class="btn btn-block btn-default" onclick="javascript:window.location.href='arPaymentRcv/form_tambahdata'">Add</button>
   </td>               
</tr>
</table>
<br>

<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
	     <thead bgcolor="#ECF0F5">
            <tr>
                <th>Number</th>
				<th>Date</th>
				<th>Account</th>
				<th>Customer</th>
				<th>Payment</th>
				<th>Notes</th>
				<th>Opsi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align:right">Total:</th>
                <th style="text-align:right"></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
	
		<tbody>
		<?php $no=1; foreach($data as $list) { ?>  
                    
		<tr>
			<td><?php echo $list->Number; ?></td>
			<td><?php echo $list->Date; ?></td>
			<td><?php echo $list->AccountName; ?></td>
			<td><?php echo $list->CustomerName; ?></td>
			<td align="right"><?php echo number_format($list->InvPayment); ?></td>
			<td><?php echo $list->Notes; ?></td>
		  <?php if ($list->Void == 0) { ?>
            <td><a href="arPaymentRcv/form_rubahdata/<?php echo Crypt::encryptString($list->ID); ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i>Edit</a></td>
          <?php }else{ ?>
            <td></td> 
          <?php } ?>

            	    
		
		</tr>
		<?php } ?>
   </tbody>
  </table>
	
