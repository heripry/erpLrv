<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class menuEmployeeController extends Controller{
    
  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
                /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 3) { //adalah ID menu nya
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


 function index () {
       $rs = DB::select("SELECT a.ID as ID, a.Code as Code, a.Name as Name, a.StatusPerkawinan as StatusPerkawinan,  convert (varchar(20), a.WorkedSince, 103) as WorkedSince, a.KKNumber as KKNumber, a.BPJSKesNumber as BPJSKesNumber, a.ParentID as ParentID, a.DivisionID as DivisionID, c.Name as DivisionName, a.JobTitleID as JobTitleID, b.Name as JobTitleName, a.SalesAreaID as SalesAreaID, convert (varchar(20), a.BirthDate, 103) as BirthDate, a.BirthPlace as BirthPlace, a.Address as Address, a.City as City, a.SubDistrict as SubDistrict, a.Village as Village, a.Province as Province, a.Phone as Phone, a.HP1 as HP1, a.HP2 as HP2, a.Email as Email, a.IDNumber as IDNumber, a.IDAddress as IDAddress, a.IDCity as IDCity, a.IDSubDistrict as IDSubDistrict, a.IDVillage as IDVillage, a.IDProvince as IDProvince, a.IDPhone as IDPhone, a.EMName as EMName, a.EMAddress as EMAddress, a.EMCity as EMCity, a.EMSubDistrict as EMSubDistrict, a.EMVillage as EMVillage, a.EMProvince as EMProvince, a.EMPhone as EMPhone, a.EMHP as EMHP, a.EMRelation as EMRelation, a.TaxNumber as TaxNumber, a.PayrollAcc as PayrollAcc, a.BPJSKesIMG as BPJSKesIMG, a.BPJSKetIMG as BPJSKetIMG, a.BPJSJHTIMG as BPJSJHTIMG, a.Gender as Gender, a.EMGender as EMGender, convert (varchar(20), a.ResignDate, 103) as ResignDate, a.Status as Status, a.TJTempatTinggalSales as TJTempatTinggalSales, a.BranchID as BranchID, b.Name as JobTitleName, c.Name as DivisonName FROM mEmployee a LEFT JOIN mJobTitle b ON a.JobTitleID = b.ID LEFT JOIN mDivision c ON a.DivisionID = c.ID");
    

      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

      return view('admin/mod_menuEmployee/menuEmployee_index', $data);
 }


 function filtermenuEmployee(Request $request){
     
        $userID =$request->userID;

        DB::insert("insert into wMenuUse (MenuID,UserID,AccessVOID,AccessADD,AccessEDT,AccessEXP,Status) 
                              select menuID_in_wMenu, UserID, 0,0,0,0,0 from (
                               select z.menuID as menuID_in_wMenu, b.menuID as menuID_in_wMenuUse, z.UserID from  ( 
                                select case Level when 0 then Name
                                                       when 1 then '  ' + Name
                                                       when 2 then '    ' + Name
                                                       when 3 then '     ' + Name
                                                       when 4 then '       ' + Name
                                              end as name, menuID,  code, GroupID, GroupName, isLeaf, Level, UserID, Ordering, Status, AccessVOID, AccessADD, AccessEDT, AccessEXP, inActive
                                               from (
                                                              
                                                               Select menuID,  code, isnull(GroupID,0) as GroupID, isnull(GroupName,'') as GroupName, name, isLeaf, Level, UserID, Ordering, Status, AccessVOID, AccessADD, AccessEDT, AccessEXP, inActive  from 
                                                              (
                                                    Select a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as name, a.isLeaf, a.Level, '$userID' as UserID, a.Ordering, 1 as Status, isnull(d.AccessVOID,0) as AccessVOID, isnull(d.AccessADD,0) as AccessADD, isnull(d.AccessEDT,0) as AccessEDT, isnull(d.AccessEXP,0) as AccessEXP, a.inActive as inActive 
                                                                 from wMenu a 
                                                          left join wMenu c on a.ParentID = c.ID 
                                                          left join wmenuuse d on a.ID = d.MenuID and d.UserID = '$userID'
                                                         WHERE EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID and wMenuUse.UserID = '$userID')
                                                              union all
                                                   Select a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as name, a.isLeaf, a.Level, '$userID' as UserID, a.Ordering, 0 as Status, 0 as AccessVOID, 0 as AccessADD, 0 as AccessEDT, 0 as AccessEXP, a.inActive as inActive  
                                                                 from wMenu a 
                                                          left join wMenu c on a.ParentID = c.ID 
                                                          left join wmenuuse d on a.ID = d.MenuID and d.UserID = '$userID'
                                                         WHERE NOT EXISTS (SELECT * FROM wmenuuse WHERE a.ID = wmenuuse.MenuID and wMenuUse.UserID = '$userID')
                                                  ) as x
                                                 
                                                 ) as y
                                        
                                ) as z
                                 left join wMenuUse b on z.menuID = b.menuID and z.UserID = b.UserID

                               ) as zz

                              where menuID_in_wMenuUse is null");

        $query = DB::select("select case Level when 0 then Name
		                         when 1 then '&nbsp;&nbsp;&nbsp;' + Name
		                         when 2 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
		                         when 3 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
		                         when 4 then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + Name
                                              end as name, menuID,  code, GroupID, GroupName, isLeaf, Level, UserID, Ordering, Status, AccessVOID, AccessADD, AccessEDT, AccessEXP, inActive
                                               from (
                                                     Select menuID, code, isnull(GroupID,0) as GroupID, isnull(GroupName,'') as GroupName, name, isLeaf, Level, UserID, Ordering, Status, AccessVOID, AccessADD, AccessEDT, AccessEXP, inActive  from 
                                                    (
                                                    Select a.ID as menuID, a.Code as code, c.ID as GroupID, c.Name as GroupName, a.Name as name, a.isLeaf, a.Level, '$userID' as UserID, a.Ordering, d.Status, isnull(d.AccessVOID,0) as AccessVOID, isnull(d.AccessADD,0) as AccessADD, isnull(d.AccessEDT,0) as AccessEDT, isnull(d.AccessEXP,0) as AccessEXP, a.inActive as inActive 
                                                        from wMenu a 
                                                          left join wMenu c on a.ParentID = c.ID 
                                                          left join wmenuuse d on a.ID = d.MenuID and d.UserID = '$userID'
                                                  ) as x
                                                 
                                                 ) as y");


        $query2 = DB::select("Select ID, Code,  Name,  inActive, Status from 
                                (
                        select a.ID, a.Code, a.Name, b.inActive, 1 as Status from mWarehouse a 
                        left join wWarehouseUse b on a.ID = b.WarehouseID 
                    WHERE b.UserID='$userID' and EXISTS (SELECT * FROM wWarehouseUse 
                    WHERE a.ID = wWarehouseUse.WarehouseID and wWarehouseUse.UserID = '$userID')
                  union all
                    select distinct a.ID, a.Code, a.Name, b.inActive, 0 as Status from mWarehouse a 
                    left join wWarehouseUse b on a.ID = b.WarehouseID 
                    WHERE NOT EXISTS (SELECT * FROM wWarehouseUse 
                    WHERE a.ID = wWarehouseUse.WarehouseID and wWarehouseUse.UserID = '$userID')
                    ) as x
                   order by x.ID asc");

        $query3 = DB::select("Select ID, Code,  Name, inActive, Status from 
                                (
                        select a.ID, a.Code, a.Name, b.inActive, 1 as Status from mItemGroup a
                    left join wItemGroupUse b on a.ID = b.itemGroupID 
                    WHERE b.UserID='$userID' and EXISTS (select * from wItemGroupUse 
                    where a.ID = wItemGroupUse.itemGroupID and wItemGroupUse.UserID='$userID')
                  union all
                    select distinct a.ID, a.Code, a.Name, b.inActive, 0 as Status from mItemGroup a
                    left join wItemGroupUse b on a.ID = b.itemGroupID 
                    WHERE NOT EXISTS(select * from wItemGroupUse 
                    where a.ID = wItemGroupUse.itemGroupID and wItemGroupUse.UserID='$userID')
                    ) as x
                   order by x.ID asc");

        
        $query4 = DB::select("Select Type, Status from 
                                (
                    select distinct Type, 1 as Status from mItem a
                    inner join wItemTypeUse b on a.Type = b.ItemType where b.UserID='$userID'
                    union all
                    select distinct Type, 0 as Status from mItem a where Type Not IN (select distinct Type from mItem a
                    inner join wItemTypeUse b on a.Type = b.ItemType where b.UserID='$userID'
                    )
                   ) as x
                    order by x.Type asc");
        
        $query5 = DB::select("select * from wMenuAccessType where UserID = '$userID'");

        $data = array('empID'  => $userID,
                      'data'  => $query,
                      'data2' => $query2,
                      'data3' => $query3,
                      'data4' => $query4,
                      'data5' => $query5);   

       //echo json_encode($query);
        return view('admin/mod_menuEmployee/menuEmployee_view', $data);
}

  function insertMenu(Request $request){
       
       $MenuID = $request->MenuID;
       $UserID = $request->UserID;
       $AccessVOID = $request->AccessVOID;
       $AccessADD = $request->AccessADD;
       $AccessEDT = $request->AccessEDT;
       $AccessEXP = $request->AccessEXP;
       $Status = $request->Status;

    DB::update("UPDATE wMenuUse set AccessVOID='$AccessVOID', AccessADD='$AccessADD', AccessEDT='$AccessEDT', AccessEXP='$AccessEXP', Status='$Status' WHERE MenuID='$MenuID' and UserID='$UserID'");
     

  }


  function insertMenuWarehouse(Request $request){
   
     $IDarr = $request->ID;
     $UserID = $request->empID;
    
     DB::delete("DELETE FROM wWarehouseUse where UserID='$UserID'");

     foreach ($IDarr as $WarehouseID){ 
       DB::insert("INSERT INTO wWarehouseUse (WarehouseID, UserID) values ('$WarehouseID', '$UserID')");
     }

  }

  
  function insertMenuItemGroup(Request $request){
   
     $IDarr = $request->ID;
     $UserID = $request->empID;
   
     DB::delete("DELETE FROM wItemGroupUse where UserID='$UserID'");

     foreach ($IDarr as $ItemGroupID){ 
       DB::insert("INSERT INTO wItemGroupUse (ItemGroupID, UserID) values ('$ItemGroupID', '$UserID')");
     }

  }

  function insertMenuItemType(Request $request){
   
     $IDarr = $request->ID;
     $UserID = $request->empID;
  
     DB::delete("DELETE FROM wItemTypeUse where UserID='$UserID'");

     foreach ($IDarr as $ItemType){ 
       DB::insert("INSERT INTO wItemTypeUse (ItemType, UserID) values ('$ItemType', '$UserID')");
     }

  }

  function insertMenuAccessType(Request $request){
   
   $UserID = $request->empID;
   $VOID = $request->cbVOID;
   $VOT = $request->cbVOT;
   $EDIT = $request->cbEDT;
   
   DB::delete("DELETE FROM wMenuAccessType where UserID='$UserID'");

   DB::insert("INSERT INTO wMenuAccessType (AccessVOID, AccessVOT, AccessEDT, UserID) values ($VOID,$VOT,$EDIT,$UserID)");


  }



}
