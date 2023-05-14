<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class loginController extends Controller{
    
  function index (Request $request){

    return view('admin/login'); 
 
  }

  function validasi (Request $request){
  	session()->forget('userLogin');
    session()->forget('menu');
    session()->forget('aksesmenu');

  	$username = $request->username;
  	$password = hash ('md5', $request->password);

    $rs = DB::select("select *,a.ID as EmployeeID from mEmployee a 
                      left join wmenuaccesstype b on a.ID = b.UserID
                      where a.Status = 0 and a.Username = '$username' and a.Password='$password'");
  

         if (count($rs) > 0) {
              session()->put('userLogin', $rs);
              return $this->setmenu();
        
          }else {
             echo('<script> alert("Username dan password yang anda masukkan tidak sesuai, mohon dicek kembali"); </script>');   
             return view('login');       

         }

  }


  function setmenu() {
       
        $rs = session()->get('userLogin');
        $UserID = $rs[0]->EmployeeID;

        $recordset = DB::select("select a.*, b.AccessVOID, b.AccessADD, b.AccessEDT, b.AccessEXP, b.Status, ifnull(c.Name,0) as ParentName from wmenu a
   	                  left join wmenuuse b on a.ID = b.MenuID
   	                  left join wMenu c on a.ParentID = c.ID
   	                  where b.UserID= '$UserID' and a.inActive = 0 and b.Status = 1
   	                  order by a.Ordering ASC");
 
        $query['data'] = $this->getMenu($recordset);
        
       	$menu = $query['data'];
        
        (session()->put('menu', ($menu)));
		    (session()->put('aksesmenu', $recordset));
        
       // echo (session()->get('userLogin')[0]->userid);
        //return view('dashboard',['menu' => $menu]);
       //var_dump($menu);
        
        return redirect('admin/dashboard');
  
    }
	

  function getMenu($recordset, $parentId = 0) {

  	$filteredRecordset = array_filter($recordset, function($rec) use ($parentId) {
      return $rec->ParentID == $parentId;
    });

    if (!count($filteredRecordset)) return null;

    $menu = [];

    foreach ($filteredRecordset as $rec) {
      $menuItem = [
        'id' => $rec->ID,
        'code' => $rec->Code,
        'name' => $rec->Name,
        'isLeaf' => $rec->isLeaf,
        'icon' => $rec->Icon,
        'ordering' => $rec->Ordering,
        'accessvoid' => $rec->AccessVOID,
        'accessadd' => $rec->AccessADD,
        'accessedt' => $rec->AccessEDT,
        'accessexp' => $rec->AccessEXP,
      ];

      $submenu = $this->getMenu($recordset, $rec->ID);
      if ($submenu) $menuItem['menu'] = $submenu;

      $menu[] = $menuItem;
    }

    return $menu;

  } 


  function logout() {

	  session()->forget('userLogin');
	  session()->forget('menu');
	  session()->forget('aksesmenu');
	 
	  return view('admin/login');

  }	



}
