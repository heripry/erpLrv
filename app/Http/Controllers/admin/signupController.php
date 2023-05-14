<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class signupController extends Controller{
  
  public function __construct() {
    
      // $this->middleware(function ($request, $next){

      //       if (session()->has('userLogin') != 'true' ) {
      //         return redirect('admin/login');
      //       }
                   
      //           /* hak akses menu */
      //            $data = session()->get("aksesmenu");
      //            $a = 0;

      //             foreach ($data as $list){  
      //               if ($list->ID == 1197) { //adalah ID menu nya
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

function index(){
  echo 'halo';
}


  function form_tambahdata() {
      $rs = DB::select("select case Level when 0 then Name
                         when 1 then '&nbsp;&nbsp;&nbsp;' + Name
                         when 2 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 3 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 4 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                end as Name, ID,  code, GroupID, GroupName, isLeaf, Level, Ordering, inActive, Status  
                 from (
                                
                                 Select ID,  code, isnull(GroupID,0) as GroupID, isnull(GroupName,'') as GroupName, name, isLeaf, Level, Ordering, inActive, Status from 
                                (
                      Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 1 as status 
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID 
                           WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                                union all
                     Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 0 as status
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID   
                           WHERE NOT EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                    ) as x
                   
                   ) as y
                    order by Ordering asc");
    
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

      return view('admin/mod_pelanggan/pelanggan_add', $data);
  } 

  function form_rubahdata($ID) {
    if (session()->get('userLogin')[0]->AccessEDT == 0) {
        return redirect('admin/dashboard');
    }else {

      $ID = Crypt::decryptString($ID);

      $rs = DB::select("SELECT * FROM wMenu WHERE ID='$ID'");
      $rs2 = DB::select("select case Level when 0 then Name
                         when 1 then '&nbsp;&nbsp;&nbsp;' + Name
                         when 2 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 3 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 4 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                end as Name, ID,  code, GroupID, GroupName, isLeaf, Level, Ordering, inActive, Status  
                 from (
                                
                                 Select ID,  code, isnull(GroupID,0) as GroupID, isnull(GroupName,'') as GroupName, name, isLeaf, Level, Ordering, inActive, Status from 
                                (
                      Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 1 as status 
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID 
                           WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                                union all
                     Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 0 as status
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID   
                           WHERE NOT EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                    ) as x
                   
                   ) as y
                    order by Ordering asc");
    
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs,
                    'data2'  => $rs2);

      return view('admin/mod_pelanggan/pelanggan_edit', $data);
    
    }
  } 

  function paramCekNoKTP(Request $request){
        $NoKTP = $request->NoKTP;
        $rs = DB::select("SELECT * FROM mcustomer WHERE IDNumber='$NoKTP'");

       //if (count($query) > 0){
          echo json_encode($rs);
       //}else{
       //   echo json_encode('false');
       //}
   }

   function paramCekEmail(Request $request){
        $Email = $request->Email;
        $rs = DB::select("SELECT * FROM mcustomer WHERE Email='$Email'");

       //if (count($query) > 0){
          echo json_encode($rs);
       //}else{
       //   echo json_encode('false');
       //}
   }


   function paramCekPhone(Request $request){
        $Phone = '+62'.$request->Phone;
        $rs = DB::select("SELECT * FROM mcustomer WHERE Phone='$Phone'");

       //if (count($query) > 0){
          echo json_encode($rs);
       //}else{
       //   echo json_encode('false');
       //}
   }

function simpanData(Request $request){
    $NoKTP = $request->txtNoKTP; 
    $CustomerName = str_replace("'", "''",$request->txtCustomerName); 
    $Email = str_replace("'", "''",$request->txtEmail);
    $Phone = '+62'.ltrim(str_replace("'", "''",$request->txtPhone), '0');
    $Address = str_replace("'", "''",$request->txtAddress); 
    $Password = md5($request->Password);
  
    $rs = DB::insert("INSERT INTO mcustomer (IDNumber, Name, Email, Phone1, Address, Password) VALUES ('$NoKTP', '$CustomerName', '$Email', '$Phone', '$Address', '$Password')");
  }


 function rubahData(Request $request){
    $ID = $request->txtID;
    $ParentID = $request->cbParentID; 
    $Code = $request->txtCode; 
    $Name = $request->txtName;
    $inActive =  $request->inActive;
    $Icon = $request->txtIcon; 
    $isLeaf = $request->txtisLeaf;
    $Level = $request->txtLevel;
    $Ordering = $request->txtOrdering;
  
    $rs = DB::update("UPDATE wmenu SET ParentID='$ParentID', Code='$Code', Name='$Name', inActive='$inActive', Icon='$Icon', isLeaf='$isLeaf', Level='$Level', Ordering='$Ordering' WHERE ID='$ID'");
  } 



}
