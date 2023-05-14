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
                    filebrowserImageBrowseUrl : '<?php echo base_url('kcfinder/browse.php');?>',
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
          data: "Category="+Category,
          url: "<?php echo base_url('index.php/admin/C_masterItem/paramSubCategory')?>",
          success: function(res) {    
           $("#cSubCategory").html(res);      
          }

        });
   });			

  $("#br").on("change", function(){ 
    var extension = $('#br').val().split('.').pop();
    if (['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'].indexOf(extension) > -1) {
      //cek besar file 
      if ((this.files[0].size) > 1000000) {
           alert('Max Upload Gambar 1Mb, cara memperkecil dengan screenshot foto yang akan anda upload lalu upload yang screenshotnya');
           document.getElementById("br").value = "";             
      }
      //console.log('validated');
    } else {
      //console.log('invalid extension');
      alert('Anda Hanya Boleh Upload Gambar dengan Format (jpg/jpeg/png/webp) Saja');
      document.getElementById("br").value = "";
    }
  });

  $("#br2").on("change", function(){ 
    var extension = $('#br2').val().split('.').pop();
    if (['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'].indexOf(extension) > -1) {
      //cek besar file 
      if ((this.files[0].size) > 1000000) {
           alert('Max Upload Gambar 1Mb, cara memperkecil dengan screenshot foto yang akan anda upload lalu upload yang screenshotnya');
           document.getElementById("br2").value = "";             
      }
      //console.log('validated');
    } else {
      //console.log('invalid extension');
      alert('Anda Hanya Boleh Upload Gambar dengan Format (jpg/jpeg/png/webp) Saja');
      document.getElementById("br2").value = "";
    }
  });

  $("#br3").on("change", function(){ 
    var extension = $('#br3').val().split('.').pop();
    if (['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'].indexOf(extension) > -1) {
      //cek besar file 
      if ((this.files[0].size) > 1000000) {
           alert('Max Upload Gambar 1Mb, cara memperkecil dengan screenshot foto yang akan anda upload lalu upload yang screenshotnya');
           document.getElementById("br3").value = "";             
      }
      //console.log('validated');
    } else {
      //console.log('invalid extension');
      alert('Anda Hanya Boleh Upload Gambar dengan Format (jpg/jpeg/png/webp) Saja');
      document.getElementById("br3").value = "";
    }
  });


  $("#br4").on("change", function(){ 
    var extension = $('#br4').val().split('.').pop();
    if (['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'].indexOf(extension) > -1) {
      //cek besar file 
      if ((this.files[0].size) > 1000000) {
           alert('Max Upload Gambar 1Mb, cara memperkecil dengan screenshot foto yang akan anda upload lalu upload yang screenshotnya');
           document.getElementById("br4").value = "";             
      }
      //console.log('validated');
    } else {
      //console.log('invalid extension');
      alert('Anda Hanya Boleh Upload Gambar dengan Format (jpg/jpeg/png/webp) Saja');
      document.getElementById("br4").value = "";
    }
  });


    function simpan_br(){
             
              var br_id = $('#txtID').val();
              var file_data = $('#br').prop('files')[0];
              var form_data = new FormData();
                
              form_data.append('file', file_data);
     
              $.ajax({ 
                  url: '<?php echo site_url('admin/C_masterItem/aksi_upload_br?br_id=')?>'+br_id, // point to server-side PHP script
                  dataType: 'json',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(data,status){
                    
                  }
              });
    }

    function simpan_br2(){
             
              var br_id = $('#txtID').val();
              var file_data = $('#br2').prop('files')[0];
              var form_data = new FormData();
                
              form_data.append('file', file_data);
     
              $.ajax({ 
                  url: '<?php echo site_url('admin/C_masterItem/aksi_upload_br2?br_id=')?>'+br_id, // point to server-side PHP script
                  dataType: 'json',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(data,status){
                    
                  }
              });
    }

    function simpan_br3(){
             
              var br_id = $('#txtID').val();
              var file_data = $('#br3').prop('files')[0];
              var form_data = new FormData();
                
              form_data.append('file', file_data);
     
              $.ajax({ 
                  url: '<?php echo site_url('admin/C_masterItem/aksi_upload_br3?br_id=')?>'+br_id, // point to server-side PHP script
                  dataType: 'json',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(data,status){
                   
                  }
              });
    }

 $("#br").change(function(){
    simpan_br();
 });

 $("#br2").change(function(){
    simpan_br2();
 });

  $("#br3").change(function(){
    simpan_br3();
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
										url: '<?php echo base_url('index.php/admin/C_masterItem/rubahdataDetail')?>',
										data: {br_id: $('#txtID').val(), br_code: $('#txtCode').val(), br_nm: $('#txtNama').val(), br_hrg: $('#txtHarga').val(), br_date_post: $('#txtDatePost').val(), br_pcc: $('#cPcc').val(), br_color: $('#txtColor').val(), br_cat: $('#cCategory').val(), br_subcat: $('#cSubCategory').val(), cRelated: $('#cRelated').val(), br_note: editorData, br_desc: $('#txtDesc').val(), br_inform: $('#txtInformasi').val(), br_pinned: tPinned, br_sts: tActive},
										dataType: 'html',
										success: function(sData){
											//console.log('function success');
											//console.log(sData);
											//$('#result').html(sData);
                      alert('Data Berhasil di Update');
                      $('#Simpan').prop('disabled', false);
											//window.location.replace("<?php //echo base_url('index.php/admin/C_masterItem')?>");
	
										},
										error:function(e){
											console.log('error : '+e.message);
										}
								   });
 //   }

 }); //tutup simpan
		 

                  
       
}); //tutupnya 'Document Ready Function'

</script>

<div class="content-wrapper">
  <section class="content-header">
      <h1>Master Article</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>index.php/admin/c_dashboard" target=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
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
  <input type="hidden" id="txtID" value="<?php echo $data->br_id; ?>"/>
 <tr>
  <td>Code</td>
   <td><input type="text" id="txtCode" class="form-control" value="<?php echo $data->br_code; ?>"></td>
 </tr>
<!--  <tr>
  <td>Name</td>
   <td><input type="text" id="txtNama" class="form-control" value="<?php //echo $data->br_nm; ?>"></td>
 </tr> -->
<!--  <tr>
  <td>Harga</td>
  <td><input type="text" id="txtHarga" class="form-control" value="<?php //echo $data->br_hrg; ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
 </tr> -->
 <tr>
  <td>Date Post</td>
   <td><input type="text" id="txtDatePost" class="form-control date-input-css" value="<?php echo date_format(date_create($data->br_date_post), 'Y-m-d H:i:s'); ?>"></td>
 </tr>
 <tr>
  <td>Category</td>
   <td><select id="cCategory" data-mini="true" class="form-control">
                   <option value='' selected>-Pilih-</option>
                   <?php $no=1; foreach($data2 as $list) {
                       if ($data->br_cat==$list['ID']){
                         echo "<option value='".$list['ID']."' selected>".$list['Name']."</option>";
                        }else{
                         echo "<option value='".$list['ID']."'>".$list['Name']."</option>";
                       } 
                   } ?>
       </select>
   </td>
 </tr>
  <tr>
  <td>Sub Category</td>
  <td><select id="cSubCategory" data-mini="true" class="form-control">
         <option value=0 selected>-Pilih-</option>
         <?php if ($data->br_subcat!=0){
              echo "<option value='".$data->br_subcat."' selected>".$data->br_subcatnm."</option>";
             }
         ?>    
    </select>
 </tr>
 <tr>
  <td>Related</td>
  <td><select id="cRelated" data-mini="true" class="form-control select2" multiple="multiple" style="width: 100%;">
         <?php $no=1; foreach($data3 as $list) { ?> 
             <option value="<?php echo $list['br_id'];?>" <?php echo ($list['rl_br_related_id']==  $data->br_id) ? ' selected="selected"' :  '';?>><?php echo str_replace('-', ' ', $list['br_code']);?></option>  
         <?php $no++; } ?>
    </select>
 </tr>
 <tr>
  <td>Position</td>
   <td><select id="cPcc" data-mini="true" class="form-control">
                  <?php if ($data->br_pcc == 'article'){ ?>
                     <option value="article" selected="selected">article</option>
                     <option value="recommendation">recommendation</option>
                     <option value="slider" >slider</option>
                  <?php }else if ($data->br_pcc == 'recommendation'){ ?>
                     <option value="article">article</option>
                     <option value="recommendation" selected="selected">recommendation</option>
                     <option value="slider" >slider</option>   
                  <?php }else if ($data->br_pcc == 'slider'){ ?>
                     <option value="article">article</option>
                     <option value="recommendation">recommendation</option>
                     <option value="slider" selected="selected">slider</option> 
                  <?php } ?>   
       </select>
   </td>
 </tr>
 <!-- <tr>
  <td>Warna</td>
  <td><input type="text" id="txtColor" class="form-control" value="<?php //echo $data->br_color; ?>"></td>
 </tr> -->
<!-- <tr>
  <td>Thumbnail Image</td>
  <td><br>
      <a data-fancybox="gallery" href="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr; ?>"><img src="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr; ?>" width="140" height="100"/></a>
      <br>
      <p>*Kosongi Bila Foto Tak Di ubah</p>
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
                          <?php echo $data->br_note; ?>                  
                    </textarea>
              </form>
            </div>
          </div>
          <!-- /.box -->
  </td>
 </tr>
<!--   <tr>
  <td>Description</td>
   <td><textarea id="txtDesc" class="form-control" ><?php //echo $data->br_desc; ?></textarea></td>
 </tr>
 <tr>
  <td>Informasi</td>
   <td><textarea id="txtInformasi" class="form-control" ><?php //echo $data->br_inform; ?></textarea></td>
 </tr> -->
<!-- <tr>
  <td>Gambar 2</td>
  <td><br>
      <a data-fancybox="gallery" href="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr2; ?>"><img src="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr2; ?>" width="140" height="100"/></a>
      <br>
      <p>*Kosongi Bila Foto Tak Di ubah</p>
      <input name='br2' id='br2' class="form-control" type='file'  accept="image/jpg,image/jpeg,image/png,image/webp">  
  </td>
 </tr>
 <tr>
  <td>Gambar 3</td>
   <td><br>
      <a data-fancybox="gallery" href="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr3; ?>"><img src="<?php //echo base_url(); ?>images/PRODUCT/<?php //echo $data->br_gbr3; ?>" width="140" height="100"/></a>
      <br>
      <p>*Kosongi Bila Foto Tak Di ubah</p>
      <input name='br3' id='br3' class="form-control" type='file'  accept="image/jpg,image/jpeg,image/png,image/webp">  
  </td>
 </tr> -->
 <tr>
        <?php if ($data->br_pinned==1){ ?>                             
            <td><label for="cPinned">Pinned</label></td>
            <td><input type="checkbox" id="cPinned" checked="checked" ></td>
        <?php }else{ ?>  
            <td><label for="cPinned">Pinned</label></td>
            <td><input type="checkbox" id="cPinned" ></td> 
       <?php } ?> 
 </tr>

 <tr>
        <?php if ($data->br_sts==1){ ?>                             
            <td><label for="cActive">Active</label></td>
            <td><input type="checkbox" id="cActive" checked="checked" ></td>
        <?php }else{ ?>  
            <td><label for="cActive">Active</label></td>
            <td><input type="checkbox" id="cActive" ></td> 
       <?php } ?> 
 </tr>

 <tr>
  <td colspan="2"><button type="submit" id="Simpan" class="btn btn-primary btn-block">Simpan</button></td>
 </tr>   
</table>


            


