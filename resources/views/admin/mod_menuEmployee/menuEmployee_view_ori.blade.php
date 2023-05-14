<title>Daftar Menu Employee</title>
 <?php error_reporting(0); ?>
<script type="text/javascript">
$(document).ready(function(){

   $('#example1').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
       "ordering": false,
      
      "bDestroy": true

   });
   
  $('#example2').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      
      "scrollX": true,
      "bDestroy": true

   });

  $('#example3').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      
      "scrollX": true,
      "bDestroy": true

   });

  $('#example4').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      
      "scrollX": true,
      "bDestroy": true

   });

  $('#example5').DataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      
      "scrollX": true,
      "bDestroy": true

   });

	/*membuat text berisi tanggal*/
		$(function(){
			$( ".date-input-css" ).datepicker({
				  format:'dd/mm/yyyy',
				  autoclose: true,
				  todayHighlight: true,
			  });
			});
   /*batas*/	

   $('#exampleTAB').dataTable({
      "iDisplayLength": -1,
      "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
      responsive: true,

      "bLengthChange": false,
      "bFilter": false,
      
      "scrollX": false,
      "bDestroy": false,
      "scrollCollapse": false,
      "paging": false,

            "dom": 'lBfrtip',
            "buttons": [
                  //{ extend: 'copyHtml5', footer: true },
                  { extend: 'excelHtml5', footer: true },
                  //{ extend: 'csvHtml5', footer: true },
                  { extend: 'pdfHtml5', footer: true },
                  { extend: 'print' }
                ]
            
    });
    
  
  $("#Save").click(function(){
    saveMenuEmployee();
   // saveMenuWarehouse();
   // saveMenuItemGroup();
   // saveMenuItemType();
   // saveMenuAccessType();
  });
    

  function saveMenuEmployee(){
      var table = $('#example1').DataTable();
      table
       .search( '' )
       .columns().search( '' )
       .draw();

      var ID = new Array();
      $("input[id='checkbox']:checked").each(function() {
           ID.push($(this).val()+'-'+$(this).parents("tr").find("#AccessVOID").val()+'*'+$(this).parents("tr").find("#AccessADD").val()+'&'+$(this).parents("tr").find("#AccessEDT").val()+'$'+$(this).parents("tr").find("#AccessEXP").val());
      });     

  //  data=  {ID: ID, UserID: $('#txtEmpID').val()};

//console.log(data);

              $.ajax({
                      type: 'POST',
                      data:  {"_token": "{{ csrf_token() }}", ID: ID, UserID: $('#txtEmpID').val()},
                      url: "{{ route('admin/menuEmployee/insertMenu') }}",
                      dataType: 'html',
                      success: function(sData){
                        console.log('function success');
                        //console.log(sData);
                        //$('#result').html(sData);

                       window.location.replace("{{ route('admin/menuEmployee') }}"); 
    
                      },
                      error:function(e){
                        console.log('error : '+e.message);
                      }
              });   

  
  }

  function saveMenuWarehouse(){
      var table = $('#example2').DataTable();
      table
       .search( '' )
       .columns().search( '' )
       .draw();

      var ID = new Array();
      $("input[id='checkbox2']:checked").each(function() {
           ID.push($(this).val());
      });          
              $.ajax({
                      type: 'POST',
                      data:  {"_token": "{{ csrf_token() }}", ID: ID, empID: $('#txtIDEmpWarehouse').val()},
                      url: "{{ route('admin/menuEmployee/insertMenuWarehouse') }}",
                      dataType: 'html',
                      success: function(sData){
                        console.log('function success');
                        console.log(sData);
                        $('#result').html(sData);
                        window.location.replace("{{ route('admin/menuEmployee') }}");
    
                      },
                      error:function(e){
                        console.log('error : '+e.message);
                      }
              });   

  
  }

  function saveMenuItemGroup(){
      var table = $('#example3').DataTable();
      table
       .search( '' )
       .columns().search( '' )
       .draw();

      var ID = new Array();
      $("input[id='checkbox3']:checked").each(function() {
           ID.push($(this).val());
      });          
              $.ajax({
                      type: 'POST',
                      data:  {"_token": "{{ csrf_token() }}", ID: ID, empID: $('#txtIDEmpItemGroup').val()},
                      url: "{{ route('admin/menuEmployee/insertMenuItemGroup') }}",
                      dataType: 'html',
                      success: function(sData){
                        console.log('function success');
                        console.log(sData);
                        $('#result').html(sData);
                        window.location.replace("{{ route('admin/menuEmployee') }}");
    
                      },
                      error:function(e){
                        console.log('error : '+e.message);
                      }
              });   

  
  }

  function saveMenuItemType(){
      var table = $('#example4').DataTable();
      table
       .search( '' )
       .columns().search( '' )
       .draw();

      var ID = new Array();
      $("input[id='checkbox4']:checked").each(function() {
           ID.push($(this).val());
      });          
              $.ajax({
                      type: 'POST',
                      data:  {"_token": "{{ csrf_token() }}", ID: ID, empID: $('#txtIDEmpItemType').val()},
                      url: "{{ route('admin/menuEmployee/insertMenuItemType') }}",
                      dataType: 'html',
                      success: function(sData){
                        console.log('function success');
                        console.log(sData);
                        $('#result').html(sData);
                        window.location.replace("{{ route('admin/menuEmployee') }}");
    
                      },
                      error:function(e){
                        console.log('error : '+e.message);
                      }
              });   

  
  }
   
  function saveMenuAccessType(){
      var table = $('#example5').DataTable();
      table
       .search( '' )
       .columns().search( '' )
       .draw();

      if ($("#checkboxVOID").prop('checked') == true) {
          var cbVOID = 1 ;
      }else{
          var cbVOID = 0 ;
      }

      if ($("#checkboxVOT").prop('checked') == true) {
          var cbVOT = 1 ;
      }else{
          var cbVOT = 0 ;
      }

      if ($("#checkboxEDT").prop('checked') == true) {
          var cbEDT = 1 ;
      }else{
          var cbEDT = 0 ;  
      }

              $.ajax({
                      type: 'POST',
                      data:  {"_token": "{{ csrf_token() }}", cbVOID: cbVOID, cbVOT: cbVOT, cbEDT: cbEDT, empID: $('#txtIDEmpAccessType').val()},
                      url: "{{ route('admin/menuEmployee/insertMenuAccessType') }}",
                      dataType: 'html',
                      success: function(sData){
                        console.log('function success');
                        console.log(sData);
                        $('#result').html(sData);
                    //    window.location.replace("{{ route('admin/menuEmployee') }}");
    
                      },
                      error:function(e){
                        console.log('error : '+e.message);
                      }
              });   

  
  }

}); //tutupnya 'Document Ready Function'

</script>
<style>


/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;

}



</style>

<table>
  <tr>
    <td><button type="submit" id="Save" class="btn btn-primary btn-block">Save</button></td>
  </tr>
</table>
<br>

<div class="tab">
  <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'data1')">Menu Employee</button>
  <button class="tablinks" onclick="openCity(event, 'data2')">Menu Warehouse</button>
  <button class="tablinks" onclick="openCity(event, 'data3')">Menu Item Group</button>
  <button class="tablinks" onclick="openCity(event, 'data4')">Menu Item Type</button>
</div>

<div id="data1" class="tabcontent">
<div id="dvContents">
<div class='hr'>
    <span class='hr-title'>Menu Employee</span>
</div>

<table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th></th>   
            <th>ID</th>
            <th>Name</th>
            <th>Group Menu</th>
            <th>Code</th>
            <th>Can Void</th>
            <th>Can Add</th>
            <th>Can Edit</th>
            <th>Can Export</th>
            <th>Active</th>
          </tr>
        </thead>
    
  <tbody>  
      <?php foreach($data as $list) { ?>   
        <tr >
         <?php if ($list->Menu == 1) {?> 
            <td><input type='checkbox' id='checkbox' checked="checked" value='<?php echo $list->menuID; ?>' /></td>
         <?php }else{?>
            <td><input type='checkbox' id='checkbox' value='<?php echo $list->menuID; ?>' /></td>
         <?php }?>
            <td><?php echo $list->menuID ?></td>
            <td><?php echo $list->name ?><input type="hidden" id="txtEmpID" name="empID" value="<?php echo $empID;?>" class="form-control" /></td>

            <td><?php echo $list->GroupName ?></td>
            <td><?php echo $list->code ?></td>  
         
         <?php if ($list->AccessVOID == 1) {?> 
            <td><select id='AccessVOID'>
                  <option value="1" selected="selected">Yes</option>
                  <option value="0" >No</option>
                </select> 
            </td>    
         <?php }else{?>
             <td><select id='AccessVOID'>
                  <option value="1" >Yes</option>
                  <option value="0" selected="selected">No</option>
                </select> 
            </td>  
         <?php }?>

         <?php if ($list->AccessADD == 1) {?> 
            <td><select id='AccessADD'>
                  <option value="1" selected="selected">Yes</option>
                  <option value="0" >No</option>
                </select> 
            </td>    
         <?php }else{?>
             <td><select id='AccessADD'>
                  <option value="1" >Yes</option>
                  <option value="0" selected="selected">No</option>
                </select> 
            </td>  
         <?php }?>

         <?php if ($list->AccessEDT == 1) {?> 
            <td><select id='AccessEDT'>
                  <option value="1" selected="selected">Yes</option>
                  <option value="0" >No</option>
                </select> 
            </td>    
         <?php }else{?>
             <td><select id='AccessEDT'>
                  <option value="1" >Yes</option>
                  <option value="0" selected="selected">No</option>
                </select> 
            </td>  
         <?php }?>

         <?php if ($list->AccessEXP == 1) {?> 
            <td><select id='AccessEXP'>
                  <option value="1" selected="selected">Yes</option>
                  <option value="0" >No</option>
                </select> 
            </td>    
         <?php }else{?>
             <td><select id='AccessEXP'>
                  <option value="1" >Yes</option>
                  <option value="0" selected="selected">No</option>
                </select> 
            </td>  
         <?php }?>
         
         <?php if ($list->inActive == 0) {?>
          <td><span class="label label-success">Yes</span></td>
         <?php }else if ($list->inActive == 1) {?>
          <td><span class="label label-danger">No</span></td>
         <?php }?>
         
        </tr>
      <?php } ?>
  </tbody>
</table>
</div>
</div>

<div id="data2" class="tabcontent">
<div class='hr'>
    <span class='hr-title'>Menu Warehouse</span>
</div>

<table id="example2" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th></th>  
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Active</th>
          </tr>
        </thead>
    
        <tbody>

      <?php foreach($data2 as $list) { ?>   
       <tr>
         <?php if ($list->Status == 1) {?> 
            <td><input type='checkbox' id='checkbox2' checked="checked" value='<?php echo $list->ID; ?>' /></td>
         <?php }else{?>
            <td><input type='checkbox' id='checkbox2' value='<?php echo $list->ID; ?>' /></td>
         <?php }?>
            <td><?php echo $list->ID ?><input type="hidden" id="txtIDEmpWarehouse" name="empID" value="<?php echo $empID;?>" class="form-control" /></td>
            <td><?php echo $list->Code ?></td>
            <td><?php echo $list->Name ?></td>  
         <?php if ($list->inActive == 0) {?>
          <td><span class="label label-success"><i class="fa fa-check"></span></td>
         <?php }else if ($list->inActive == 1) {?>
          <td><span class="label label-danger"><i class="fa fa-close"></span></td>
         <?php }?>
       </tr>
      <?php } ?> 
        </tbody>
</table>
</div>

<div id="data3" class="tabcontent">
<div class='hr'>
    <span class='hr-title'>Menu Item Group</span>
</div>

<table id="example3" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th></th>  
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Active</th>
          </tr>
        </thead>
    
        <tbody>

      <?php foreach($data3 as $list) { ?>   
       <tr>
         <?php if ($list->Status == 1) {?> 
            <td><input type='checkbox' id='checkbox3' checked="checked" value='<?php echo $list->ID; ?>' /></td>
         <?php }else{?>
            <td><input type='checkbox' id='checkbox3' value='<?php echo $list->ID; ?>' /></td>
         <?php }?>
            <td><?php echo $list->ID ?><input type="hidden" id="txtIDEmpItemGroup" name="empID" value="<?php echo $empID;?>" class="form-control" /></td>
            <td><?php echo $list->Code ?></td>
            <td><?php echo $list->Name ?></td>
         <?php if ($list->inActive == 0) {?>
          <td><span class="label label-success"><i class="fa fa-check"></span></td>
         <?php }else if ($list->inActive == 1) {?>
          <td><span class="label label-danger"><i class="fa fa-close"></span></td>
         <?php }?>
       </tr>
      <?php } ?> 
        </tbody>
</table>
</div>

<div id="data4" class="tabcontent">
<div class='hr'>
    <span class='hr-title'>Menu Item Type</span>
</div>

<table id="example4" class="table table-bordered table-striped" cellspacing="0" width="100%" >
         <thead bgcolor="#ECF0F5">
          <tr>
            <th>Status</th>
            <th>Code</th>
            <th>Name</th>
          </tr>
        </thead>
    
        <tbody>
          <?php 
            foreach($data4 as $list) { 
              if($list->Type == 'MT'){
                $ItemTypeName = 'Material';
              }elseif($list->Type == 'PK'){
                $ItemTypeName = 'Packaging';
              }elseif($list->Type == 'SF'){
                $ItemTypeName = 'Semi Finished Good';
              }elseif($list->Type == 'FH'){
                $ItemTypeName = 'Finished Good';
              }elseif($list->Type == 'AS'){
                $ItemTypeName = 'Asset';
              }elseif($list->Type == 'NS'){
                $ItemTypeName = 'Non Stock';
              }
          ?>   
       <tr>
         <?php if ($list->Status == 1) {?> 
            <td><input type='checkbox' id='checkbox4' checked="checked" value='<?php echo $list->Type; ?>' /></td>
         <?php }else{?>
            <td><input type='checkbox' id='checkbox4' value='<?php echo $list->Type; ?>' /></td>
         <?php }?>
            <td><?php echo $list->Type ?><input type="hidden" id="txtIDEmpItemType" name="empID" value="<?php echo $empID;?>" class="form-control" /></td>
            <td><?php echo $ItemTypeName ?></td>
       </tr>
      <?php } ?> 
        </tbody>
</table>
</div>

</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

}
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

  $(function () {
      $("#btnPrint").click(function () {
          var contents = $("#dvContents").html();
          var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px" });
          $("body").append(frame1);
          var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
          //Create a new HTML document.
          frameDoc.document.write('<html><head><title>DIV Contents</title>');
          frameDoc.document.write('</head><body>');
          //Append the external CSS file.
          frameDoc.document.write('<link href="<?php asset('assetsAdminLTEprem/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />');
          frameDoc.document.write('<link href="<?php asset('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />');
          //Append the DIV contents.
          frameDoc.document.write(contents);
          frameDoc.document.write('</body></html>');
          frameDoc.document.close();
          setTimeout(function () {
              window.frames["frame1"].focus();
              window.frames["frame1"].print();
              frame1.remove();
          }, 500);
      });
  });
</script>
