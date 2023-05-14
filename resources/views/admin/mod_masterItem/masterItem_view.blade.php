<title>Master Article</title>

<script type="text/javascript"> 
$(document).ready( function(){
//ini untuk ajax false, dikarenakan jquery mobile gk bisa load sempurna
// $.mobile.ajaxEnabled = false;
// $.mobile.pushStateEnabled = false;
//  
    $('#example').dataTable({
            "iDisplayLength": -1,
            "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
            responsive: true,

            "bLengthChange": false,
            "bFilter": true,
            
            "scrollX": true,
            "bDestroy": true,

            "scrollX": true,
           
            
      
      /*-----membuat grup pada kolom ke 2 bulan----*/
      "columnDefs": [
            { "visible": false, "targets": 2 }],
      "order": [[ 2, 'asc' ]],
      "displayLength": 25,
      
        "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last = null;
        var colonne = api.row(0).data().length;
        var groupid = -1;
        var subtotale = new Array();
                
        var groupadmin = []; 
  
 
       // variabel harus ditaruh diatas function2 yang lainnya dan fucntion ini berfungsi memberikan titik ribuan pada angka
       var myintval = function ( i ) {
            return  i.toFixed(0).replace(/./g, function(c, i, a) {
                return i && c !== "." && ((a.length - i) % 3 === 0) ? '.' + c : c;
              });
          };
                


            api.column(2, {page:'current'} ).data().each( function ( group, i ) {     
                if ( last !== group ) {
                    groupid++;
                    $(rows).eq( i ).before(
                        '<tr class="group" id="'+i+'"><td bgcolor="#EBF1DE"><b>'+group+'</b></td></tr>'
                    );
          groupadmin.push(i);
                    last = group;
                }
        
        
                            
                val = api.row(api.row($(rows).eq( i )).index()).data();      //current order index
                $.each(val,function(index2,val2){
                        if (typeof subtotale[groupid] =='undefined'){
                            subtotale[groupid] = new Array();
                        }
                        if (typeof subtotale[groupid][index2] =='undefined'){
                            subtotale[groupid][index2] = 0;
                        }
                        
            //untuk menghilangkan titik ribuan pada angka
            valore = parseInt(val2.toString().replace(".","").replace(".","").replace(".","").replace(".",""))
            
                        subtotale[groupid][index2] += valore;
                       
                });
       
            } );     
      
                for( var k=0; k < groupadmin.length; k++){
// Code added for adding class to sibling elements as "group_<id>"  
                  $("#"+groupadmin[k]).nextUntil("#"+groupadmin[k+1]).addClass(' group_'+groupadmin[k]); 
               // Code added for adding Toggle functionality for each group
                    $("#"+groupadmin[k]).click(function(){
                        var gid = $(this).attr("id");
                         $(".group_"+gid).slideToggle(300);
                    });
                     // untuk membuat tampilan jadi default collapse
                    //$("#"+groupadmin[k]).trigger( "click" ); 
                }
                
                   
    $('tbody').find('.group').each(function (i,v) {
                    var rowCount = $(this).nextUntil('.group').length;
            $(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' ('+rowCount+')' })));
                         var subtd = '';
      
                        for (var a=2;a<colonne;a++) {
                subtd += '<td bgcolor="#EBF1DE">'+''+'</td>';
                            }
                        $(this).append(subtd);
                });
            
          }
  
    });
           
                        
  });

</script>


<table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th>Code</th>
            <th>Category</th>
            <th>Date</th>
            <th>Position</th>
            <th>Opsi</th>
          </tr>
        </thead>
    
        <tbody>
        <?php $no=1; foreach($data as $list) { ?>             
        <tr>
            <td><?php echo $list->br_code; ?></td>
            <td><?php echo $list->cat_nm; ?></td>
            <td><?php echo date_format(date_create($list->br_date_post),"m/Y"); ?></td>
            <td><?php echo $list->br_pcc; ?></td>
            <td><a href="masterItem/filterItem/<?php echo $list->br_id; ?>" class="btn btn-danger btn-sm">Edit</a></td>
        </tr>
       <?php } ?>         
   </tbody>
  </table>
    
