@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

<title>Master Article</title>
 
<script type="text/javascript">
$(document).ready(function(){
  
    // $(function(){
    //   CKEDITOR.replace('editor1',
    //             {
                   
    //                 filebrowserBrowseUrl : '<?php //echo base_url();?>ckfinder/ckfinder.html',
    //                 filebrowserImageBrowseUrl : '<?php //echo base_url();?>ckfinder/ckfinder.html?type=Images',
    //                 filebrowserFlashBrowseUrl : '<?php //echo base_url();?>ckfinder/ckfinder.html?type=Flash',
    //             });
 
    //   //bootstrap WYSIHTML5 - text editor
    //   $('.textarea').wysihtml5()
    // });

    $(function(){
      CKEDITOR.replace('editor1',{
                    filebrowserImageBrowseUrl : "{{ asset('kcfinder/browse.php') }}",
                    height: '400px'})
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    });
  
  
  /*membuat text berisi tanggal*/
    $(function(){
      $( ".date-input-css" ).datetimepicker({
          format:'yyyy-mm-dd hh:ii:ss',
          // startDate: '0d',
          // startDate: '+7d',
         // endDate: '+14d',
          autoclose: true,
          todayHighlight: true,
        });
      });
   /*batas*/  

    $(function(){
        // Set up the number formatting.
        $('#txtHarga').number( true, 0 );
    }); 
  
    $("#cCategory").on("change", function(){
        var Category = $("#cCategory").val();
         
      $.ajax({
          type: "POST",
          data: {"_token": "{{ csrf_token() }}", Category: Category},
          url: "{{ route('admin/masterItem/paramSubCategory') }}",
          success: function(res) {    
           $("#cSubCategory").html(res);      
          }

        });
   });




  $("#Simpan").click(function(){
    
    // var re = /^\w+$/;
    // if (!re.test($('#txtCode').val())) {
    //   alert("Gunakan _ untuk pemisah kata");
    //   $('#txtCode').focus();
    // }else {

        var tPinned = 0;
                  if ($("#cPinned").prop('checked') == true) {
                        tPinned = 1;
                   }else{
                        tPinned = 0;
                  }

        var tActive = 0;
                  if ($("#cActive").prop('checked') == true) {
                        tActive = 1;
                   }else{
                        tActive = 0;
                  }


        var editorData = CKEDITOR.instances['editor1'].getData();
          
                $('#Simpan').prop('disabled', true);
           
                  $.ajax({
                    type: 'POST',
                    url:  "{{ route('admin/masterItem/tambahdataDetail') }}",
                    data: {"_token": "{{ csrf_token() }}", br_id: $('#txtID').val(), br_code: $('#txtCode').val(), br_nm: $('#txtNama').val(), br_hrg: $('#txtHarga').val(), br_date_post: $('#txtDatePost').val(), br_pcc: $('#cPcc').val(), br_color: $('#txtColor').val(), br_cat: $('#cCategory').val(), br_subcat: $('#cSubCategory').val(), cRelated: $('#cRelated').val(),  br_note: editorData, br_desc: $('#txtDesc').val(), br_inform: $('#txtInformasi').val(), br_pinned: tPinned, br_sts: tActive},
                    dataType: 'html',
                    success: function(sData){
                      //console.log('function success');
                      //console.log(sData);
                      //$('#result').html(sData);
                      alert('Data Berhasil di Input');
                      //window.location.replace("<?php //echo base_url('index.php/admin/C_masterItem/tambahItem')?>");
  
                    },
                    error:function(e){
                      console.log('error : '+e.message);
                    }
                   });
  //  }

 }); //tutup simpan
     

                  
       
}); //tutupnya 'Document Ready Function'

</script>

<div class="content-wrapper">
  <section class="content-header">
      <h1>Master Article</h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin/dashboard') }}" target=""><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a onClick="javascript:history.go(0)" data-icon="refresh">Refresh</a></li>
      </ol>
    </section>  

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

 <table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%">
  
 <tr>
  <td>Code</td>
   <td><input type="text" id="txtCode" class="form-control" ></td>
 </tr>
<!--  <tr>
  <td>Name</td>
   <td><input type="text" id="txtNama" class="form-control" ></td>
 </tr> -->
<!--  <tr>
  <td>Harga</td>
  <td><input type="text" id="txtHarga" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
 </tr> -->
 <tr>
  <td>Date Post</td>
   <td><input type="text" id="txtDatePost" class="form-control date-input-css" value="<?php echo date('Y-m-d h:i:s'); ?>" ></td>
 </tr> 
 <tr>
  <td>Category</td>
   <td><select id="cCategory" data-mini="true" class="form-control">
                     <option value='' selected>-Pilih-</option>
                    <?php $no=1; foreach($data2 as $list) { 
                        echo "<option value='".$list->ID."'>".$list->Name."</option>";
                     } ?>
       </select>
   </td>
 </tr>
 <tr>
  <td>Sub Category</td>
  <td><select id="cSubCategory" data-mini="true" class="form-control">
         <option value=0 selected>-Pilih-</option>
    </select>
 </tr>
  <tr>
  <td>Related</td>
  <td><select id="cRelated" data-mini="true" class="form-control select2" multiple="multiple" style="width: 100%;">
         <?php $no=1; foreach($data3 as $list) { ?> 
             <option value="<?php echo $list->br_id;?>"><?php echo str_replace('-', ' ', $list->br_code);?></option>  
         <?php $no++; } ?>
    </select>
 </tr>
  <tr>
  <td>Position</td>
   <td><select id="cPcc" data-mini="true" class="form-control">
                     <option value="article" selected="selected">article</option>
                     <option value="recommendation">recommendation</option>
                     <option value="slider" >slider</option>
       </select>
   </td>
 </tr>
<!--  <tr>
  <td>Warna</td>
  <td><input type="text" id="txtColor" class="form-control"></td>
 </tr> -->
<!-- <tr>
  <td>Thumbnail Image</td>
  <td><br>
      <input name='br' id='br' class="form-control" type='file'  accept="image/jpg,image/jpeg,image/png,image/webp">
      <p>**Khusus Gambar Category</p>  
  </td>
 </tr> -->
 <tr>
  <td></td>
  <td><h3 class="box-title">Article
      </h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                    <textarea id="editor1" rows="100" cols="200">
                                           
                    </textarea>
              </form>
            </div>
          </div>
          <!-- /.box -->
  </td>
 </tr>
<!--  <tr>
  <td>Description</td>
   <td><textarea  id="txtDesc" class="form-control" ></textarea></td>
 </tr>
 <tr>
  <td>Informasi</td>
   <td><textarea  id="txtInformasi" class="form-control" ></textarea></td>
 </tr> -->

<!-- <tr>
  <td>Gambar 2</td>
  <td><br>
      <input name='br2' id='br2' class="form-control" type='file'  accept="image/jpg,image/jpeg,image/png,image/webp">  
  </td>
 </tr>
 <tr>
  <td>Gambar 3</td>
   <td><br>
      <input name='br3' id='br3' class="form-control" type='file'  accept="image/jpg,image/jpeg,image/png,image/webp">  
  </td>
 </tr> -->
 <tr>
  <td><label for="cPinned">Pinned</label></td>
  <td><input type="checkbox" id="cPinned" ></td>
 </tr>
 
 <tr>
  <td><label for="cActive">Active</label></td>
  <td><input type="checkbox" id="cActive" checked="checked" ></td>
 </tr>

 <tr>
  <td colspan="2"><button type="submit" id="Simpan" class="btn btn-primary btn-block">Simpan</button></td>
 </tr>   
</table>

<!-- ============ Body content end ============= -->    

@endsection  

            


