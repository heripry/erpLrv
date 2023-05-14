<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class menuController extends Controller{
  
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


  function index () {

    $rs = DB::select("select case Level when 0 then Name
                         when 1 then concat('&nbsp;&nbsp;&nbsp;', Name)
                         when 2 then concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', Name) 
                         when 3 then concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', Name) 
                         when 4 then concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', Name)
                end as Name, menuID,  code, GroupID, GroupName, Icon, isLeaf, Level, Ordering, Project, inActive, Status  
                               from (
                                
                                 Select Name, menuID,  code, ifnull(GroupID,0) as GroupID, ifnull(GroupName,'') as GroupName, Icon, isLeaf, Level, Ordering, Project, inActive, Status from 
                                (
                      Select a.Name, a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Icon, a.isLeaf, a.Level, a.Ordering, a.Project, a.inActive as inActive, 1 as status 
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID 
                           WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                                union all
                     Select a.Name, a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Icon, a.isLeaf, a.Level, a.Ordering, a.Project, a.inActive as inActive, 0 as status
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID   
                           WHERE NOT EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                    ) as x
                   
                   ) as y
                    order by Ordering asc");

      // $rs = DB::select("select case Level when 0 then Name
      //                    when 1 then '&nbsp;&nbsp;&nbsp;' + Name
      //                    when 2 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
      //                    when 3 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
      //                    when 4 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
      //                end as name, menuID,  code, GroupID, GroupName, isLeaf, Level, Ordering, inActive, Status  
      //               from (
                                
      //                            Select menuID,  code, ifnull(GroupID,0) as GroupID, ifnull(GroupName,'') as GroupName, name, isLeaf, Level, Ordering, inActive, Status from 
      //                           (
      //                 Select a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 1 as status 
      //                              from wMenu a 
      //                       left join wMenu c on a.ParentID = c.ID 
      //                      WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
      //                           union all
      //                Select a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as name, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 0 as status
      //                              from wMenu a 
      //                       left join wMenu c on a.ParentID = c.ID   
      //                      WHERE NOT EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
      //               ) as x
                   
      //              ) as y
      //               order by Ordering asc");
    
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

       // var_dump($data);
      return view('admin/mod_menu/menu_view', $data);
  }


  function form_tambahdata() {
      $rs = DB::select("select case Level when 0 then Name
                         when 1 then '&nbsp;&nbsp;&nbsp;' + Name
                         when 2 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 3 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                         when 4 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                end as Name, ID,  code, GroupID, GroupName, isLeaf, Level, Ordering, inActive, Status  
                 from (
                                
                                 Select ID,  code, ifnull(GroupID,0) as GroupID, ifnull(GroupName,'') as GroupName, name, isLeaf, Level, Ordering, inActive, Status from 
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

      return view('admin/mod_menu/menu_add', $data);
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
                end as Name, ID,  code, GroupID, GroupName, Icon, isLeaf, Level, Ordering, inActive, Status  
                 from (
                                
                                 Select ID,  code, ifnull(GroupID,0) as GroupID, ifnull(GroupName,'') as GroupName, name, Icon, isLeaf, Level, Ordering, inActive, Status from 
                                (
                      Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.Icon, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 1 as status 
                                   from wMenu a 
                            left join wMenu c on a.ParentID = c.ID 
                           WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID)
                                union all
                     Select a.ID as ID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as Name, a.Icon, a.isLeaf, a.Level, a.Ordering, a.inActive as inActive, 0 as status
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

      return view('admin/mod_menu/menu_edit', $data);
    
    }
  } 


function tambahdataDetail(Request $request){


    $ParentID = $request->cbParentID; 
    $Code = str_replace("'", "''",$request->txtCode); 
    $Name = str_replace("'", "''",$request->txtName);
    $inActive =  $request->inActive;
    $Icon = str_replace("'", "''",$request->txtIcon); 
    $isLeaf = $request->txtisLeaf;
    $Level = $request->txtLevel;
    $Ordering = $request->txtOrdering;
  

    DB::beginTransaction();

    try {
        DB::insert("INSERT INTO wmenu (ParentID, Code, Name, inActive, Icon, isLeaf, Level, Ordering) VALUES ('$ParentID', '$Code', '$Name', '$inActive', '$Icon', '$isLeaf', '$Level', '$Ordering')");   
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


 function rubahdataDetail(Request $request){
    $ID = $request->txtID;
    $ParentID = $request->cbParentID; 
    $Code = $request->txtCode; 
    $Name = $request->txtName;
    $inActive =  $request->inActive;
    $Icon = $request->txtIcon; 
    $isLeaf = $request->txtisLeaf;
    $Level = $request->txtLevel;
    $Ordering = $request->txtOrdering;
  
  
    DB::beginTransaction();

    try {
        DB::update("UPDATE wmenu SET ParentID='$ParentID', Code='$Code', Name='$Name', inActive='$inActive', Icon='$Icon', isLeaf='$isLeaf', Level='$Level', Ordering='$Ordering' WHERE ID='$ID'");   
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



}
