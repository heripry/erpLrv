<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class masterItemController extends Controller{

  public function __construct() {
    
      // $this->middleware(function ($request, $next){

      //       if (session()->has('userLogin') != 'true' ) {
      //         return redirect('admin/login');
      //       }
                   
      //           /* hak akses menu */
      //            $data = session()->get("aksesmenu");
      //            $a = 0;

      //             foreach ($data as $list){  
      //               if ($list->ID == 1188) { //adalah ID menu nya
      //                 $a = 1;
      //               }
      //             }
                 
      //             if ($a == 0) {
      //                return redirect('admin/dashboard');
      //             }
      //          /* hak akses menu */
                       

      //    return $next($request);
      // });

  }
	

 function index() {     
     $data['menu'] = session()->get('menu');
     
     $data = array('menu'  => $data['menu']);

     return view('admin/mod_masteritem/masteritem_index', $data);
 }  


  function browse_SO(Request $request){ 
        $firstDate = Carbon::createFromFormat('d/m/Y', $request->firstDate)->format('Y-m-d');     
        $lastDate = Carbon::createFromFormat('d/m/Y', $request->lastDate)->format('Y-m-d');

      $cmbFilter = $request->cmbFilter;
      $cmbFilter2 = $request->cmbFilter2;
       
       if ($cmbFilter == 1) {
         $rs = DB::select("SELECT a.*, b.Name as cat_nm, c.Name as subcat_nm FROM barang a 
                              left join wgroupmenu b on a.br_cat = b.ID
                              left join wmenu c on a.br_subcat = c.ID
                              where a.br_date_post <= CURRENT_TIMESTAMP AND (a.br_date_post BETWEEN '$firstDate' AND '$lastDate') and a.br_sts='$cmbFilter2'");  
       }else {
         $rs = DB::select("SELECT a.*, b.Name as cat_nm, c.Name as subcat_nm FROM barang a 
                              left join wgroupmenu b on a.br_cat = b.ID
                              left join wmenu c on a.br_subcat = c.ID
                              where a.br_date_post > CURRENT_TIMESTAMP and a.br_sts='$cmbFilter2'");
       }
      
     $data['menu'] = session()->get('menu');
     
     $data = array('menu'  => $data['menu'],
                   'data'  => $rs);

    //echo $firstDate.$lastDate.$cmbFilter.$cmbFilter2;
    //var_dump($rs);
    return view('admin/mod_masterItem/masterItem_view', $data);

   } 


  function paramSubCategory(Request $request){
      $Category = $request->Category;
      $data = DB::select("SELECT * FROM wmenu WHERE inActive = 0 AND ParentID='$Category'");
  
      return view('admin/mod_masterItem/masterItem_subCategory', $data);    
   }



 function form_tambahdata() {
	      $data['menu'] = session()->get('menu');

        $rs = DB::select("SELECT max(br_id) as br_id FROM barang");
        $rs2 = DB::select("SELECT * FROM wgroupmenu WHERE Project = 'Public'");
        $rs3 = DB::select("SELECT DISTINCT a.*, b.Name as cat_nm, c.Name as subcat_nm FROM barang a 
                                  left join wgroupmenu b on a.br_cat = b.ID
                                  left join wmenu c on a.br_subcat = c.ID 
                                  where a.br_sts=1 and a.br_pcc='article'                            
                               order by a.br_id");
        
        $data = array('menu' => $data['menu'],
                      'data'  => $rs,
                      'data2'  => $rs2,
                      'data3'  => $rs3);

		 return view('admin/mod_masterItem/masterItem_add', $data); 
 }   


 function filterItem($ID) {
	      $data['menu'] = json_decode(trim($_SESSION["menu"]), TRUE);

		    $query = $this->m_admin->cari_masterItem($ID);
        $query2 = $this->m_admin->daftar_masterCategory();
        $query3 = $this->m_admin->daftar_masterItemRlEdit($ID);
		   
        $data = array('menu' => $data['menu'],
        	            'data'  => $query,
                      'data2'  => $query2,
                      'data3'  => $query3,
					            'isi'   => 'admin/mod_masterItem/masterItem_edit');
		$this->load->view('admin/layout/wrapper', $data); 
 }   



  // function paramCekCode(){
  //       $Code = $this->input->post('Code');
  //       $query['data'] = $this->m_admin->cari_code_item($Code);

  //       echo json_encode($query['data']);
  // }


 // function sendMail($ID,$CusID) { 
 //    $data['menuPublic'] = json_decode(trim($_SESSION["menuPublic"]), TRUE);
    
 //        $query = $this->M_public->daftar_viewProductMail($ID);
    
 //      $data = array('menuPublic' => $data['menuPublic'],
 //              'data' => $query,
 //              'CusID' => $CusID);
 //    $this->load->view('public/sendMailProduct_view', $data); 
       
 //  }

 function tambahdataDetail(Request $request){ 	
    $br_id = $request->br_id;

     $br_code = str_replace("'", "''",$request->br_code);
     $br_nm = str_replace("'", "''",$request->br_nm);

     $br_hrg = str_replace("'", "''",$request->br_hrg);
       

     $br_date_post = $request->br_date_post;

     $br_cat = str_replace("'", "''",$request->br_cat);
     $br_subcat = str_replace("'", "''",$request->br_subcat);
     
     $br_related_id = $request->cRelated; 

     $br_pcc = str_replace("'", "''",$request->br_pcc);
     $br_color = str_replace("'", "''",$request->br_color);
     $br_desc = str_replace("'", "''",$request->br_desc);
     $br_inform = str_replace("'", "''",$request->br_inform);          
     $br_note = str_replace("'", "''",$request->br_note);
     $br_pinned = str_replace("'", "''",$request->br_pinned);
     $br_sts = str_replace("'", "''",$request->br_sts); 


     $created_date = date('Y-m-d H:i:s');
     $created_id = session()->get('userLogin')[0]->ID;
    
    DB::beginTransaction(); 
    
    try {

      if ($br_related_id <> null){
        foreach ($br_related_id as $Sign_br_related_id) {
         DB::insert("INSERT INTO related_item (rl_br_related_id, rl_br_id) values ('$br_id', '$Sign_br_related_id')");
        } 
      }

      DB::insert("INSERT INTO barang (br_code, br_nm, br_hrg, br_date_post, br_cat, br_subcat, br_pcc,br_color, br_desc,br_inform,br_note,br_pinned,br_sts,created_id,created_date) values 
              ('$br_code', '$br_nm','$br_hrg', '$br_date_post', '$br_cat', '$br_subcat', '$br_pcc','$br_color', '$br_desc','$br_inform','$br_note','$br_pinned','$br_sts','$created_id','$created_date')");
  	  
      DB::commit();
          echo 'commit';
      } catch (\Exception $e) {
          DB::rollback();
          throw $e;
          echo 'rollback';
      } catch (\Throwable $e) {
          DB::rollback();
          throw $e;
          echo 'rollback';
      }

  }


 function rubahdataDetail(){
    $br_id = $this->input->post('br_id');
 	 
     $br_code = str_replace("'", "''",$this->input->post('br_code'));
     $br_nm = str_replace("'", "''",$this->input->post('br_nm'));

     $br_hrg = str_replace("'", "''",$this->input->post('br_hrg'));
     
     //    $DateIndo = $this->input->post('br_date_post');
     //    $date1 = date($DateIndo);
     // $br_date_post = ubahformatTgl($date1).' '.date('H:i:s');

     $br_date_post = $this->input->post('br_date_post');

     $br_cat = str_replace("'", "''",$this->input->post('br_cat'));
     $br_subcat = str_replace("'", "''",$this->input->post('br_subcat'));

     $br_related_id = $this->input->post('cRelated'); 

     $br_pcc = str_replace("'", "''",$this->input->post('br_pcc'));
     $br_color = str_replace("'", "''",$this->input->post('br_color'));
     $br_desc = str_replace("'", "''",$this->input->post('br_desc'));
     $br_inform = str_replace("'", "''",$this->input->post('br_inform'));          
     $br_note = str_replace("'", "''",$this->input->post('br_note'));
     $br_pinned = str_replace("'", "''",$this->input->post('br_pinned')); 
     $br_sts = str_replace("'", "''",$this->input->post('br_sts')); 
     $edited_date = date('Y-m-d H:i:s');
     $edited_id = $this->session->userdata('userID');
    
    //echo($br_id.$br_nm.$br_hrg.$br_desc.$br_inform.$br_note.$br_sts.$edited_id.$edited_date); 



     $this->db->trans_begin(); 
       
          $this->m_admin->simpan_relatedItemSet0($br_id);
      
      if ($br_related_id <> null){
       foreach ($br_related_id as $Sign_br_related_id) {
          $this->m_admin->simpan_relatedItem($br_id,$Sign_br_related_id);
       } 
      }

        $this->m_admin->simpan_masterItemRubahOri($br_id,$br_code,$br_nm,$br_hrg, $br_date_post, $br_cat,$br_subcat,$br_pcc,$br_color,$br_desc,$br_inform,$br_note,$br_pinned,$br_sts,$edited_id,$edited_date);
 
           
    //$this->db->trans_complete();
 	if ($this->db->trans_status() === FALSE) {
            echo 'rollback';
            //if something went wrong, rollback everything
            $this->db->trans_rollback();
          return FALSE;
    } else {
        	echo 'commit';
            //if everything went right, commit the data to the database
            $this->db->trans_commit();
            return TRUE;
    } 

  }


 function aksi_upload_br(){
    $br_id = $this->input->get('br_id');

    $config['upload_path']          = 'images/PRODUCT';
    $config['allowed_types']        = '*'; //'gif|jpg|png|jpeg|bmp|webp';
    $config['max_size']             = 100000;  //100
  //  $config['max_width']            = 102400; //1024
  //  $config['max_height']           = 76800;  //768
        
    $this->load->library('upload', $config);
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      //var_dump($error);
    }else{

      $data = array('upload_data' => $this->upload->data());

       //Compress Image
             // $config['image_library'] = 'gd2';
             // $config['source_image'] = $data['upload_data']['full_path']; //get original image
             // $config['maintain_ratio'] = TRUE;
             // $config['width'] = 1024;
             // $config['height'] = 768;
             // $this->load->library('image_lib', $config);
             // if (!$this->image_lib->resize()) {
             //     $this->handle_error($this->image_lib->display_errors());
             // }
           //batas compress


      $file_path     = $data['upload_data']['file_path'];
      $file         = $data['upload_data']['full_path'];
      $file_ext     = $data['upload_data']['file_ext'];

      $final_file_name = $br_id.'_1'.$file_ext;

        rename($file, $file_path . $final_file_name);
      //var_dump($data);

         $empstrsql = "UPDATE barang SET br_gbr='$final_file_name' where br_id='$br_id'";
         $this->m_login->execSQL($empstrsql);
          
      
    }
 }

  function aksi_upload_br2(){
    $br_id = $this->input->get('br_id');

    $config['upload_path']          = 'images/PRODUCT';
    $config['allowed_types']        = '*'; //'gif|jpg|png|jpeg|bmp|webp';
    $config['max_size']             = 100000;  //100
  //  $config['max_width']            = 102400; //1024
  //  $config['max_height']           = 76800;  //768
        
    $this->load->library('upload', $config);
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      var_dump($error);
    }else{

      $data = array('upload_data' => $this->upload->data());

       //Compress Image
             // $config['image_library'] = 'gd2';
             // $config['source_image'] = $data['upload_data']['full_path']; //get original image
             // $config['maintain_ratio'] = TRUE;
             // $config['width'] = 1024;
             // $config['height'] = 768;
             // $this->load->library('image_lib', $config);
             // if (!$this->image_lib->resize()) {
             //     $this->handle_error($this->image_lib->display_errors());
             // }
           //batas compress


      $file_path     = $data['upload_data']['file_path'];
      $file         = $data['upload_data']['full_path'];
      $file_ext     = $data['upload_data']['file_ext'];

      $final_file_name = $br_id.'_2'.$file_ext;

        rename($file, $file_path . $final_file_name);
      //var_dump($data);

         $empstrsql = "UPDATE barang SET br_gbr2='$final_file_name' where br_id='$br_id'";
         $this->m_login->execSQL($empstrsql);
      
    }
 }

 function aksi_upload_br3(){
    $br_id = $this->input->get('br_id');

    $config['upload_path']          = 'images/PRODUCT';
    $config['allowed_types']        = '*'; //'gif|jpg|png|jpeg|bmp|webp';
    $config['max_size']             = 100000;  //100
  //  $config['max_width']            = 102400; //1024
  //  $config['max_height']           = 76800;  //768
        
    $this->load->library('upload', $config);
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      //var_dump($error);
    }else{

      $data = array('upload_data' => $this->upload->data());

       //Compress Image
             // $config['image_library'] = 'gd2';
             // $config['source_image'] = $data['upload_data']['full_path']; //get original image
             // $config['maintain_ratio'] = TRUE;
             // $config['width'] = 1024;
             // $config['height'] = 768;
             // $this->load->library('image_lib', $config);
             // if (!$this->image_lib->resize()) {
             //     $this->handle_error($this->image_lib->display_errors());
             // }
           //batas compress


      $file_path     = $data['upload_data']['file_path'];
      $file         = $data['upload_data']['full_path'];
      $file_ext     = $data['upload_data']['file_ext'];

      $final_file_name = $br_id.'_3'.$file_ext;

        rename($file, $file_path . $final_file_name);
      //var_dump($data);
      
        $empstrsql = "UPDATE barang SET br_gbr3='$final_file_name' where br_id='$br_id'";
        $this->m_login->execSQL($empstrsql);
      
     }
 }


	  
}
?>