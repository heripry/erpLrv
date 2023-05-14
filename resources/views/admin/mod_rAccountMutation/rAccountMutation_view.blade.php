<?php error_reporting(0); ?>
<title>Account Mutation</title>

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
                ]
            
    });

});
</script>


<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Beginning</th>            
            <th>Debit</th>
            <th>Credit</th> 
            <th>Balance</th>    
          </tr>
        </thead>
    
        <tbody>
        <?php $no=1; foreach($data as $list) { ?>             
        <tr>
            <td><?php echo $list->AccountCode; ?></td>
            <td><?php echo $list->AccountName; ?></td>
            <td><?php echo number_format($list->Beginning,1); ?></td>
            <td><?php echo number_format($list->Debit,1); ?></td>
            <td><?php echo number_format($list->Credit,1); ?></td>
            <td><?php echo number_format($list->Balance,1); ?></td>            

    <?php } ?>

     </tr>        
   </tbody>
  </table>
    
