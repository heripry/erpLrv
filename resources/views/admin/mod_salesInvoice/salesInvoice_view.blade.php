<title>Sales Invoice</title>

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
            "paging": false
						
    });

});
</script>

<table>
<tr>
   <td>
      <button type="button" class="btn btn-block btn-default" onclick="javascript:window.location.href='salesInvoice/form_tambahdata'">Add</button>
   </td>               
</tr>
</table>
<br>

<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
	     <thead bgcolor="#ECF0F5">
            <tr>
                <th>Number</th>
				<th>Date</th>
				<th>Warehouse</th>
				<th>Grand Total</th>
				<th>Notes</th>
				<th>Opsi</th>
            </tr>
        </thead>
          
	
		<tbody>
		<?php $no=1; foreach($data as $list) { ?>  
                    
		<tr>
			<td><?php echo $list->Number; ?></a></td>
			<td><?php echo $list->Date; ?></td>
			<td><?php echo $list->WarehouseName; ?></td>
			<td align="right"><?php echo number_format($list->GrandTotal); ?></td>
			<td><?php echo $list->Notes; ?></td>
		  <?php if ($list->Void == 0) { ?>
			<td><a href="salesInvoice/form_rubahdata/<?php echo Crypt::encryptString($list->ID); ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i>Edit</a></td> 
		  <?php }else{ ?>
            <td></td> 
		  <?php } ?>	    
		
		</tr>
		<?php } ?>
   </tbody>
  </table>
	
