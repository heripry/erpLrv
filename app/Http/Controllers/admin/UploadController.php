<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller{
  
  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
                /* hak akses menu */
                /*
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 1197) { //adalah ID menu nya
                      $a = 1;
                    }
                  }
                 
                  if ($a == 0) {
                     return redirect('admin/dashboard');
                  }
               /* hak akses menu */
                       

         return $next($request);
      });

  }


    public function upload(){
		return view('admin/upload/upload');
	}
 
	public function proses_upload(Request $request){
		$this->validate($request, [
			'file' => 'required',
			'keterangan' => 'required',
		]);
 
    //--- Lokal Server ----/

		// menyimpan data file yang diupload ke variabel $file
		// $file = $request->file('file');
 
  //     	        // nama file
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';
 
  //     	        // ekstensi file
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';
 
  //     	        // real path
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';
 
  //     	        // ukuran file
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';
 
  //     	        // tipe mime
		// echo 'File Mime Type: '.$file->getMimeType();
 
  //     	        // isi dengan nama folder tempat kemana file diupload
		// $tujuan_upload = '../erp/asd';


  //       // upload file
		// $file->move($tujuan_upload,$file->getClientOriginalName());

	//---  ----/
		

    //--- Another Server ----/

		  //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
      
            //Upload File to external server
            Storage::disk('ftp')->put($filenametostore, fopen($request->file('file'), 'r+'));
      
            //Store $filenametostore in the database
      
      //---  ----/


 
        
	}


}
