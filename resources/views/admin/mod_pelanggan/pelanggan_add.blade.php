@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>Add Master Menu</title>
<script type="text/javascript"> 
</script>

<script type="text/javascript">
$(document).ready(function(){ 

  $("#Simpan").click(function(){

                $('#Simpan').prop('disabled', true);
                      
                var tinActive = 0;
                  if ($("#inActive").prop('checked') == true) {
                        tinActive = 1;
                   }else{
                        tinActive = 0;
                  }

                  $.ajax({
                    type: "POST",
                    url:  "{{ route('admin/menu/tambahdataDetail') }}",
                    data: {"_token": "{{ csrf_token() }}", cbParentID: $('#cbParentID').val(), txtCode: $('#txtCode').val(), txtName: $('#txtName').val(), inActive: tinActive, txtIcon: $('#txtIcon').val(), txtisLeaf: $('#txtisLeaf').val(), txtLevel: $('#txtLevel').val(), txtOrdering: $('#txtOrdering').val()},
                    dataType: 'html',
                    success: function(sData){
                      console.log('function success');
                      console.log(sData);
                       $('#result').html(sData);
                        window.location.replace("{{ route('admin/menu') }}");
  
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });
                         
         
 }); //tutup simpan
       
}); //tutupnya 'Document Ready Function'

</script>


<div class="content-wrapper">
  <section class="content-header">
      <h1><i class="fa fa-user"></i> Master Menu</h1>
      <ol class="breadcrumb">
        <<li><a href="{{ route('admin/dashboard') }}" target=""><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a onClick="javascript:history.go(0)" data-icon="refresh">Refresh</a></li>
      </ol>
    </section>  

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">


               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Parent Menu</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <select id="cbParentID" class="form-control">
                      <option value="0">-Pilih-</option>
                      <?php 
                        $no=1; foreach($data as $list) {
                          echo "<option value='".$list->ID."'>".$list->Name."</option>";
                        }
                      ?>
                  </select>
                  <div id="lblCode" style="display:none"></div>
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Code</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtCode" class="form-control" >
                </div>
               </div>

               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Name</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtName" class="form-control" >
                </div>
               </div>

               
               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Icon</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtIcon" class="form-control" >
                </div>
               </div>  
             
               <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Is Leaf</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtisLeaf" class="form-control" >
                </div>
               </div>


              <div class="row">
                <div class="col-md-2 form-group mb-1">
                  <p>Level</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtLevel" class="form-control" >
                </div>
              </div>       


              <div class="row"> 
                <div class="col-md-2 form-group mb-1">
                  <p>Ordering</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="text" id="txtOrdering" class="form-control" >
                </div>
              </div>             
 
              
              <div class="row"> 
                <div class="col-md-2 form-group mb-1">
                  <p>inActive</p>
                </div>
                <div class="col-md-4 form-group mb-3">
                  <input type="checkbox" id="inActive" class="minimal">
                </div>
              </div>

             <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <button type="submit" id="Simpan" class="btn btn-primary btn-block">Save </button>
                </div>
              </div>
    
              
         
          </div>
        </div>
      </div>
     </div> 

<!-- ============ Body content end ============= -->    

@endsection          