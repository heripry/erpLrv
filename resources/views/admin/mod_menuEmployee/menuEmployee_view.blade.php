<title>Daftar Menu Employee</title>
 <?php error_reporting(0); ?>
<script type="text/javascript">
$(document).ready(function(){

var dataItem = [];

// var MenuID = 0;
// var AccessVOID = 0;
// var AccessADD = 0;
// var AccessEDT = 0;
// var AccessEXP = 0;


  $('#tasks').dxTreeList({
    dataSource: <?php echo preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',json_encode($data, JSON_NUMERIC_CHECK)); ?>,
    keyExpr: 'menuID',
    parentIdExpr: 'GroupID',
    columnAutoWidth: true,
    wordWrapEnabled: true,
    showBorders: true,
    autoExpandAll: true,
    searchPanel: {
      visible: true,
      width: 250,
    },
    headerFilter: {
      visible: true,
    },

    columnChooser: {
      enabled: true,
    },
    editing: {
      mode: 'row',
      allowUpdating: true,
    },

    columns: [{   
      dataField: 'menuID',
      caption: 'ID',
    }, {
      dataField: 'name',
      caption: 'Name',
      cellTemplate: function (container, options) {  
           $("<div>").html(options.data.name.replace(/&nbsp;/, ' ')).appendTo(container);  
      }  
    }, {  
      dataField: 'Status',
      caption : 'Status',
      cellTemplate:function (container, options) {
                $("<div/>").dxCheckBox({
                 value: options.data.Status,
                }).appendTo(container); 
      } 
    }, {           
      dataField: 'AccessVOID',
      caption : 'Can Void',
  
      cellTemplate:function (container, options) {
                $("<div/>").dxCheckBox({
                 value: options.data.AccessVOID,
                }).appendTo(container);
      } 
    }, {
      dataField: 'AccessADD',
      caption : 'Can Add',
     
      cellTemplate:function (container, options) {
                $("<div/>").dxCheckBox({
                   value: options.data.AccessADD,
                }).appendTo(container);
      } 
    }, {
      dataField: 'AccessEDT',
      caption : 'Can Edit',
      
      cellTemplate:function (container, options) {
                $("<div/>").dxCheckBox({
                   value: options.data.AccessEDT,
                }).appendTo(container);
      } 
    }, {
      dataField: 'AccessEXP',
      caption : 'Can Export',
    
      cellTemplate:function (container, options) {
               $("<div/>").dxCheckBox({
                  value: options.data.AccessEXP,
                }).appendTo(container);
              
      }          
    }, {
      type: 'buttons',
      caption: 'Opsi',
      buttons: ['edit'],
    },
    ],
    onRowUpdating(e) {
      //if (e.dataField === 'Head_ID' && e.row.data.ID === 1) {
      //  e.cancel = true;
     // }
       var UserID = (e.oldData.UserID);
       var MenuID = (e.oldData.menuID);
     
     if (e.newData.Status != undefined){
       var Status = (e.newData.Status);
     }else{
       var Status = (e.oldData.Status);
     }

     if (e.newData.AccessVOID != undefined){
       var AccessVOID = (e.newData.AccessVOID);
     }else{
       var AccessVOID = (e.oldData.AccessVOID);
     }

     if (e.newData.AccessADD != undefined){
       var AccessADD = (e.newData.AccessADD);
     }else{
       var AccessADD = (e.oldData.AccessADD);
     }

     if (e.newData.AccessEDT != undefined){
       var AccessEDT = (e.newData.AccessEDT);
     }else{
       var AccessEDT = (e.oldData.AccessEDT);
     }

     if (e.newData.AccessEXP != undefined){
       var AccessEXP = (e.newData.AccessEXP);
     }else{
       var AccessEXP = (e.oldData.AccessEXP);
     }               

                 $.ajax({
                    type: "POST",
                    url:  "{{ route('admin/menuEmployee/insertMenu') }}",
                    data: {"_token": "{{ csrf_token() }}", Status: Status, MenuID: MenuID, UserID: UserID, AccessVOID: AccessVOID, AccessADD: AccessADD, AccessEDT: AccessEDT, AccessEXP: AccessEXP},
                    dataType: 'html',
                    success: function(sData){
                     // console.log('function success');
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });

    },
    onInitNewRow(e) {
      e.data.Head_ID = 1;
    }
  });
  
  $("#Save").click(function(){
  
   // console.log(dataItem);
   //console.log($("#tasks").dxTreeList("getDataSource").items());
  });
    
 

}); //tutupnya 'Document Ready Function'

</script>


  <body class="dx-viewport">
  <?php  //var_dump($data); ?>
    <div class="demo-container">
      <div id="tasks"></div>
    </div>
  
  </body>
