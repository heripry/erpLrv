@extends('admin/layout/main_menu')

@section('container')  

<!-- ============ Body content start ============= -->

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
                    filebrowserImageBrowseUrl : "{{ asset('assetsAdminLTEprem/bower_components/kcfinder/browse.php') }}",
                    height: '400px'})
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    });

    }); //tutupnya 'Document Ready Function'

</script>

<table>
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
</table>

<!-- ============ Body content end ============= -->    

@endsection