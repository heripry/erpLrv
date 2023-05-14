<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class salesInvoiceController extends Controller{

  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
                /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 5) { //adalah ID menu nya
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
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu']);

      return view('admin/mod_salesInvoice/salesInvoice_index', $data);
  }

  
  function browse_SO(Request $request){
       $firstDate = $request->firstDate;

       $lastDate = $request->lastDate;
        
       $rs = DB::select("SELECT a.ID,a.DocType,a.Number,convert (varchar(20), a.Date, 103) as Date, b.Name as WarehouseName, a.Info, a.Void, a.Notes, a.GrandTotal
                 FROM tSales a 
                 left join mWarehouse b on a.WarehouseID = b.ID  
                 where a.DocType='SI' and (a.date BETWEEN '$firstDate' AND '$lastDate') and Void=0");
       
       $data['menu'] = session()->get('menu');

       $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

       return view('admin/mod_salesInvoice/salesInvoice_view', $data); 
   }



 function form_tambahdata() {
      $data['menu'] = session()->get('menu');

      $rsA = DB::select("SELECT * FROM wWarehouseUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");
      $rsB = DB::select("SELECT * FROM wItemGroupUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");
      $rsC = DB::select("SELECT * FROM wItemTypeUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");      
        
       foreach($rsA as $list){
             $rsWarehouse[] = $list->WarehouseID;     
       } 
      
       foreach($rsB as $list){
             $rsItemGroup[] = $list->ItemGroupID;     
       } 

       foreach($rsC as $list){
             $rsItemType[] = "'".$list->ItemType."'";     
       }        
       
     
       $query5 = DB::select("select * from mEmployee");
     
       $query4 = DB::select("select * from mBranch Where Status=0");
       
       $query3 = DB::select("select * from mCustomer where Status=0");
       
       $query2 = DB::select("SELECT * FROM mWarehouse WHERE ID in (".implode(',',$rsWarehouse).") AND Status = 0");
       
       $query = DB::select("Select a.ID as ID, a.Code as Code, a.Name as ItemName, a.ItemGroupID , a.Netto as Netto, a.Spesifikasi as Spesifikasi, a.ShippingWeight as ShippingWeight, a.LinkGoogleDrive as LinkGoogleDrive, a.ProductItemIMG as ProductItemIMG, a.ProductKnowledgePDF as             ProductKnowledgePDF, a.ProductKnowledgePDFRnD as ProductKnowledgePDFRnD, b.Name as ItemCategoryName, c.Name as ItemGroupName, a.ShippingWeight, a.Netto, a.CanSalePortal, a.Unit, a.CanSale, a.CanBuy, a.Taxable, a.Type, a.Status, a.Price,
                 Round(a.Price+(a.Price*0.1),0) as Price, CONVERT(VARCHAR(10), a.CreatedDate, 103) as CreatedDate, DateDiff (Day, a.CreatedDate, getdate()) as DateOfManufacture  
            from mItem a
               left join mItemCategory b on a.ItemCategoryID = b.ID
               left join mItemGroup c on a.ItemGroupID = c.ID
               WHERE a.Status = 0 and c.ID in (".implode(',',$rsItemGroup).") and a.Type in (".implode(',',$rsItemType).") ");
      

        $data = array('menu' => $data['menu'],
                      'data'  => $query,
                      'data2'  => $query2,
                      'data3'  => $query3,
                      'data4'  => $query4,
                      'data5'  => $query5);
  
        return view('admin/mod_salesInvoice/salesInvoice_add', $data); 
  }  

 function form_rubahdata($ID) {
    if (session()->get('userLogin')[0]->AccessEDT == 0) {
        return redirect('admin/dashboard');
    }else {
      
      $ID = Crypt::decryptString($ID);

      $data['menu'] = session()->get('menu');

      $rsA = DB::select("SELECT * FROM wWarehouseUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");
      $rsB = DB::select("SELECT * FROM wItemGroupUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");
      $rsC = DB::select("SELECT * FROM wItemTypeUse WHERE UserID = '".session()->get('userLogin')[0]->EmployeeID."'");      
        
       foreach($rsA as $list){
             $rsWarehouse[] = $list->WarehouseID;     
       } 
      
       foreach($rsB as $list){
             $rsItemGroup[] = $list->ItemGroupID;     
       } 

       foreach($rsC as $list){
             $rsItemType[] = "'".$list->ItemType."'";     
       }        
       
     
       $query6 = DB::select("select * from mEmployee");
     
       $query5 = DB::select("select * from mBranch Where Status=0");
       
       $query4 = DB::select("select * from mCustomer where Status=0");
       
       $query3 = DB::select("SELECT * FROM tSales WHERE ID='$ID'");

       $query2 = DB::select("SELECT * FROM mWarehouse WHERE ID in (".implode(',',$rsWarehouse).") AND Status = 0");
       
       $query = DB::select("Select a.ID as ID, a.Code as Code, a.Name as ItemName, a.ItemGroupID , a.Netto as Netto, a.Spesifikasi as Spesifikasi, a.ShippingWeight as ShippingWeight, a.LinkGoogleDrive as LinkGoogleDrive, a.ProductItemIMG as ProductItemIMG, a.ProductKnowledgePDF as             ProductKnowledgePDF, a.ProductKnowledgePDFRnD as ProductKnowledgePDFRnD, b.Name as ItemCategoryName, c.Name as ItemGroupName, a.ShippingWeight, a.Netto, a.CanSalePortal, a.Unit, a.CanSale, a.CanBuy, a.Taxable, a.Type, a.Status, a.Price,
                 Round(a.Price+(a.Price*0.1),0) as Price, CONVERT(VARCHAR(10), a.CreatedDate, 103) as CreatedDate, DateDiff (Day, a.CreatedDate, getdate()) as DateOfManufacture  
            from mItem a
               left join mItemCategory b on a.ItemCategoryID = b.ID
               left join mItemGroup c on a.ItemGroupID = c.ID
               WHERE a.Status = 0 and c.ID in (".implode(',',$rsItemGroup).") and a.Type in (".implode(',',$rsItemType).") ");
      

        $data = array('menu' => $data['menu'],
                      'data'  => $query,
                      'data2'  => $query2,
                      'data3'  => $query3,
                      'data4'  => $query4,
                      'data5'  => $query5,
                      'data6'  => $query6);
  
        //var_dump($data);
        return view('admin/mod_salesInvoice/salesInvoice_edit', $data); 

    }    
  }  

function ambilDtl(Request $request){
     $DocID = $request->txtDocID;
        
        $baca = DB::select("SELECT a.ID, a.ItemID, b.Code as ItemCode, b.Name as ItemName, a.Unit, a.Qty, a.Price, a.SubTotal  FROM tSalesDtl a INNER JOIN mItem b ON a.ItemID = b.ID WHERE a.DocID='$DocID'");
     
            //if($baca[0]->num_rows() > 0){ 
             foreach ($baca as $data){
                   $hasil[] = $data;
             }
            return $hasil;
           //} 

     echo json_encode($hasil);
} 

function paramItem(Request $request){
     $ItemID = $request->ItemID;
     $cmbWarehouse = $request->cmbWarehouse;

        $empstrsql = DB::select("declare @ItemCode varchar(30)
                  declare @balance money
                  declare @CurrCode varchar(30)

                  declare @Date1 datetime
                  declare @Date2 datetime

                  set @Date1 = getdate()
                  set @Date2 = getdate()


                  SELECT  ItemCode, ItemName, WarehouseCode, Unit, Netto, 
                      Beginning, Debit, Credit, (Beginning+Debit-Credit) as Balance
                  FROM (
                       
                    select ItemCode, ItemName, WarehouseCode, Unit, Netto, SUM(Beginning) as Beginning, SUM(Debit) as Debit, SUM(Credit) as Credit from (
                    
                      /*-------------------------------------------------------------------------------------------*/
                          /*---SALDO AWAL------------------------------------------------------------------------------*/
                          /*-------------------------------------------------------------------------------------------*/
                          
                     
                      /*-- Sales Deliver/Invoice/Return (+/-) */  
                      select b.Code as ItemCode, b.Name as ItemName, c.Code as WarehouseCode, b.Unit, b.Netto,
                           sum(a.QtyBase * a.BaseStock) as Beginning, 0 as Debit, 0 as Credit
                      from  
                        tSalesDtl a
                        left join mItem b on a.ItemID = b.ID
                        left join mWarehouse c on a.WarehouseID = c.ID
                      where 
                        a.Void = 0 AND a.Date < @Date1 AND 
                        ( (a.DocType = 'SD') OR 
                          (a.DocType = 'SI' AND a.ReffDocID = 0) OR
                          (a.DocType = 'SR' AND a.ReffDocID = 0) ) AND
                        c.ID ='$cmbWarehouse' and b.ID = '$ItemID'
                      group by b.Code, b.Name, c.Code, b.Unit, b.Netto

                    
                   UNION ALL            
                        
                        
                      /*---------------------------------------------------------------------------------------*/ 
                      /*---MUTASI TRANSAKSI--------------------------------------------------------------------*/ 
                      /*---------------------------------------------------------------------------------------*/
                        
                    
                      /*-- Sales Deliver/Invoice/Return (+/-) */  
                      select b.Code as ItemCode, b.Name as ItemName, c.Code as WarehouseCode, b.Unit, b.Netto,
                           0 as Beginning, 
                           sum(case when a.BaseStock = 1  then a.QtyBase else 0 end) as Debit, 
                           sum(case when a.BaseStock = -1 then a.QtyBase else 0 end) as Credit
                      from  
                        tSalesDtl a
                        left join mItem b on a.ItemID = b.ID
                        left join mWarehouse c on a.WarehouseID = c.ID
                      where 
                        a.Void = 0 AND a.Date >= @Date1 AND a.Date < @Date2+1 AND
                        ( (a.DocType = 'SD') OR 
                          (a.DocType = 'SI' AND a.ReffDocID = 0) OR
                          (a.DocType = 'SR' AND a.ReffDocID = 0) ) AND
                        c.ID = '$cmbWarehouse' and b.ID = '$ItemID'
                      group by b.Code, b.Name, c.Code, b.Unit, b.Netto

                                
                    ) as x 
                    Group by x.ItemCode, x.ItemName, x.WarehouseCode, x.Unit, x.Netto
                  ) as y");

    
       $rs = DB::select("SELECT * FROM mItem WHERE ID='$ItemID'");

       $data = array('data'  => $rs,
                     'data2' => $empstrsql);

       echo json_encode($data);
 
}



function tambahdataDetail(Request $request) {
    $NumberTemp = 0;
    $NoTemp = 0;
    
    //$Date = Carbon::createFromFormat('d/m/Y', $request->txtDate)->format('Y-m-d'); 
    $Date = $request->txtDate;

    $Customer = $request->cmbCustomer;
    $Branch = $request->cmbBranch;
    $Sales = $request->cmbSales;

    $Warehouse = $request->cmbWarehouse;
    $Template = $request->cmbTemplate;
    $PaymentType = $request->cmbPaymentType;

    $Term = $request->txtTerm; 
    $Notes =$request->txtNotes;
    $Rounded =$request->txtRounded;
    $Discount =$request->txtDiscount;
    $Invoice =$request->lblInvoice;
    $Tax =$request->lblTax;
    $GrandTotal =$request->lblGrandTotal;
    $Void = 0;
    $DocType = 'SI';
    $BaseStock = -1;
    $CreatedEmployeeID = session()->get('userLogin')[0]->EmployeeID; 
    $CreatedUserID = session()->get('userLogin')[0]->EmployeeID;
    $CreatedDate = date('Y-m-d H:i:s');


         /* untuk $PeriodID dg Parameter Date tanggal input bukan tanggal edit*/
      /************************************************************/   
          $sqlPR = DB::select("SELECT ID FROM mPeriod WHERE StartDate <= '$Date' AND EndDate >= '$Date'");       
    
          $PeriodID = $sqlPR[0]->ID;
      /**************************************************************/ 


         DB::insert("INSERT INTO tSales (DocType, Number, No, PeriodID, Date,  CustomerID, BranchID, BuyerID, WarehouseID, Template, PaymentType, Term, Notes,  Rounded, DiscountAmount, TaxAmount, InvoiceTotal, GrandTotal, Void, CreatedEmployeeID, CreatedUserID, CreatedDate) VALUES ('$DocType', '$NumberTemp','$NoTemp', '$PeriodID', '$Date',  '$Customer', '$Branch', '$Sales', '$Warehouse', '$Template', '$PaymentType', '$Term', '$Notes', '$Rounded', '$Discount', '$Tax', '$Invoice', '$GrandTotal', '$Void', '$CreatedEmployeeID', '$CreatedUserID', '$CreatedDate')");

         $sqlMax = DB::select("SELECT MAX(ID) As maxSIID FROM tSales WHERE DocType='SI'");

         $maxSIID = $sqlMax[0]->maxSIID; 

        /* untuk $Number dan $Docno/No */
      /************************************************************/ 
          $sqlLC = DB::select("Select ISNULL(max(No),0) as LastCount from tSales
                                 where PeriodID = '$PeriodID' and  
                                       DocType = 'SI'");       
                     // PeriodID harus dinamis ngikuti Date Now dg parameter $PeriodID    
          
            $lastCount = $sqlLC[0]->LastCount;

            if (empty($lastCount)){
                $DocNo = 1;
            } else{
                    $DocNo = ($lastCount + 1);             
            }
            
                $Thn  = date_format(date_create($Date),"ym");
                $Panjang =  strlen($DocNo) + strlen($Thn); 
                
                $Temp  = '';
                for ($i = 1; $i <= (8-$Panjang); $i++) {
                   $Temp = $Temp . '0';
                    }
                 
                 $Number = 'SI-ACP-'.$Thn.$Temp.$DocNo;
      /************************************************************/  

       
    /*update Number and DocNo*/
        DB::update("UPDATE tSales SET Number='$Number', No='$DocNo' WHERE ID='$maxSIID'");
    /*batas*/


     $data_MDck = $request->datanya_MDck;
     $data_json_MDck = json_encode($data_MDck);
    
     $jsonObj_MDck = json_decode($data_json_MDck);
   
     
    if (count($jsonObj_MDck) > 0) {
      foreach ($jsonObj_MDck as $val) {
            $ItemID= $val->MDckDtlItemID; 
            $ItemName= $val->MDckDtlItemName;
            $Qty = $val->MDckDtlQty; 
            $Unit= $val->MDckDtlUnit;
            $Price= $val->MDckDtlPrice;
            $SubTotal= $val->MDckDtlSubTotal;

            DB::insert("INSERT INTO tSalesDtl (DocID, Number, ItemID, Qty, QtyBase, Unit, Price, SubTotal, DocType, No, PeriodID, Date, WarehouseID, BaseStock, Void) VALUES
                      ('$maxSIID','$Number','$ItemID','$Qty','$Qty','$Unit','$Price','$SubTotal','$DocType', '$DocNo','$PeriodID', '$Date', '$Warehouse', '$BaseStock', '$Void')");
          
      }
    }

  }


  function rubahdataDetail(Request $request) {
    $DocID = $request->txtDocID;
    $DocNo = $request->txtDocNo; //DocNo nanti di update dibawah
    $Number = $request->txtNumber; //Number nanti di update dibawah
    
    //$Date = Carbon::createFromFormat('d/m/Y', $request->txtDate)->format('Y-m-d'); 
    $Date = $request->txtDate;

    $Customer = $request->cmbCustomer;
    $Branch = $request->cmbBranch;
    $Sales = $request->cmbSales;

    $Warehouse = $request->cmbWarehouse;
    $Template = $request->cmbTemplate;
    $PaymentType = $request->cmbPaymentType;

    $Term = $request->txtTerm; 
    $Notes =$request->txtNotes;
    $Rounded =$request->txtRounded;
    $Discount =$request->txtDiscount;
    $Invoice =$request->lblInvoice;
    $Tax =$request->lblTax;
    $GrandTotal =$request->lblGrandTotal;
    $Void = $request->txtVoid;
    $DocType = 'SI';
    $BaseStock = -1;
    $EditedEmployeeID = session()->get('userLogin')[0]->EmployeeID; 
    $EditedUserID = session()->get('userLogin')[0]->EmployeeID;
    $EditedDate  = date('Y-m-d H:i:s');


      /* untuk $PeriodID dg Parameter Date tanggal input bukan tanggal edit*/
      /************************************************************/   
          $sqlPR = DB::select("SELECT ID FROM mPeriod WHERE StartDate <= '$Date' AND EndDate >= '$Date'");       
    
          $PeriodID = $sqlPR[0]->ID;
      /**************************************************************/ 


      DB::update("UPDATE tSales set PeriodID ='$PeriodID', Date ='$Date',  CustomerID='$Customer', BranchID='$Branch', BuyerID='$Sales', WarehouseID='$Warehouse', Template='$Template', PaymentType='$PaymentType', Term='$Term', Notes='$Notes', Rounded='$Rounded', DiscountAmount='$Discount', TaxAmount='$Tax', InvoiceTotal='$Invoice', GrandTotal='$GrandTotal', Void='$Void', EditedEmployeeID='$EditedEmployeeID', EditedUserID='$EditedUserID', EditedDate='$EditedDate' where ID='$DocID'");

         
         $sqlMax = DB::select("SELECT MAX(ID) As maxSIID FROM tSales WHERE DocType='SI'");

         $maxSIID = $sqlMax[0]->maxSIID; 

    //     /* untuk $Number dan $Docno/No */
    //   /************************************************************/ 
    //       $sqlLC = DB::select("Select ISNULL(max(No),0) as LastCount from tSales
    //                              where PeriodID = '$PeriodID' and  
    //                                    DocType = 'SI'");       
    //                  // PeriodID harus dinamis ngikuti Date Now dg parameter $PeriodID    
          
    //         $lastCount = $sqlLC[0]->LastCount;

    //         if (empty($lastCount)){
    //             $DocNo = 1;
    //         } else{
    //                 $DocNo = ($lastCount + 1);             
    //         }
            
    //             $Thn  = date_format(date_create($Date),"ym");
    //             $Panjang =  strlen($DocNo) + strlen($Thn); 
                
    //             $Temp  = '';
    //             for ($i = 1; $i <= (8-$Panjang); $i++) {
    //                $Temp = $Temp . '0';
    //                 }
                 
    //              $Number = 'SI-ACP-'.$Thn.$Temp.$DocNo;
    //   /************************************************************/   

       
    // /*update Number and DocNo*/
    //     DB::update("UPDATE tSales SET Number='$Number', No='$DocNo' WHERE ID='$maxSIID'");
    // /*batas*/


     $data_MDck = $request->datanya_MDck;
     $data_json_MDck = json_encode($data_MDck);
    
     $jsonObj_MDck = json_decode($data_json_MDck);
   
    DB::delete("DELETE FROM tSalesDtl WHERE DocID='$DocID'");

    if (count($jsonObj_MDck) > 0) {
      foreach ($jsonObj_MDck as $val) {
            $ItemID= $val->MDckDtlItemID; 
            $ItemName= $val->MDckDtlItemName;
            $Qty = $val->MDckDtlQty; 
            $Unit= $val->MDckDtlUnit;
            $Price= $val->MDckDtlPrice;
            $SubTotal= $val->MDckDtlSubTotal;

            DB::insert("INSERT INTO tSalesDtl (DocID, Number, ItemID, Qty, QtyBase, Unit, Price, SubTotal, DocType, No, PeriodID, Date, WarehouseID, BaseStock, Void) VALUES
                      ('$maxSIID','$Number','$ItemID','$Qty','$Qty','$Unit','$Price','$SubTotal','$DocType', '$DocNo','$PeriodID', '$Date', '$Warehouse', '$BaseStock', '$Void')");
          
      }
    }  
  
  }
  

}
