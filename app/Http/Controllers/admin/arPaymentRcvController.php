<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class arPaymentRcvController extends Controller{
 
   public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
                /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 7) { //adalah ID menu nya
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

      return view('admin/admin/mod_arPaymentRcv/arPaymentRcv_index', $data);
  }

  
  function browse_SO(Request $request){
       $firstDate = $request->firstDate;
       $lastDate = $request->lastDate;

       $status = $request->status;
        
       $rs = DB::select("select a.ID, a.Number, convert (varchar(20), a.Date, 103) as Date, b.Name as CustomerName, c.Name as AccountName, a.Payment, a.InvPayment, a.Void, a.Notes from 
                             tARPayment a 
                                left join mCustomer b on a.CustomerID = b.ID 
                                left join mAccount c on a.AccountID = c.ID 
                               where a.Date between '$firstDate' and '$lastDate' and a.Void = '$status'");
       
       $data['menu'] = session()->get('menu');

       $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

       return view('admin/admin/mod_arPaymentRcv/arPaymentRcv_view', $data); 
   }



 function form_tambahdata() {
      $data['menu'] = session()->get('menu');

       $query = DB::select("select * from mCustomer where Status=0");
       
       $query2 = DB::select("Select ID as ID, Code as Code, Name as Name 
                            from mAccount 
                            where Status = 0
                            Order by Code ASC");
       
       $query3 = DB::select("select * from mCoa where isLeaf != 0");
      

        $data = array('menu' => $data['menu'],
                      'data'  => $query,
                      'data2'  => $query2,
                      'data3'  => $query3);
  
        return view('admin/admin/mod_arPaymentRcv/arPaymentRcv_add', $data); 
  }  

 function form_rubahdata($ID) {
    if (session()->get('userLogin')[0]->AccessEDT == 0) {
        return redirect('admin/dashboard');
    }else {
       
       $ID = Crypt::decryptString($ID);

       $data['menu'] = session()->get('menu');

       $query = DB::select("select a.ID, a.No, a.PeriodID, a.Number, a.Date, a.CustomerID, b.Name as CustomerName, a.AccountID, c.Name as AccountName, a.Method, a.ChequeNumber, a.ChequeDueDate, a.CoaID, a.Total, a.InvPayment, a.Payment, a.Notes from tARPayment a 
                                left join mCustomer b on a.CustomerID = b.ID 
                                left join mCoa c on a.CoaID = c.ID 
                              where a.ID = '$ID'");
       
       $query2 = DB::select("Select ID as ID, Code as Code, Name as Name 
                            from mAccount 
                            where Status = 0
                            Order by Code ASC");
       
       $query3 = DB::select("select * from mCoa where isLeaf != 0");
      

        $data = array('menu' => $data['menu'],
                      'data'  => $query,
                      'data2'  => $query2,
                      'data3'  => $query3);
  
        //var_dump($data);
        return view('admin/admin/mod_arPaymentRcv/arPaymentRcv_edit', $data); 
    }    
  }  

function ambilDtl(Request $request){
     $DocID = $request->txtDocID;
        
        $baca = DB::select("select * from (
           select ID, DocType, DateVcr, Number, GrandTotal, (GrandTotal - sum(sOpenAmount)) as OpenAmount, Payment from (
             select a.ID, a.DocType, convert (varchar(20), a.Date, 103) as DateVcr, a.Number, a.GrandTotal, b.Payment,
               case when (b.Payment) is null then 0
               else
              b.Payment
             end as sOpenAmount 
             from tSales a left join tARPaymentDtl b ON a.ID=b.ReffDocID and a.Void=0 and b.Void=0
             where b.DocID = '$DocID'
            
            ) as x
           group by  x.ID, x.DocType, x.DateVcr, x.Number, x.GrandTotal, x.Payment
          ) as y
          group by y.ID, y.DocType, y.DateVcr, y.Number, y.GrandTotal, y.OpenAmount, y.Payment");
     
            //if($baca[0]->num_rows() > 0){ 
             foreach ($baca as $data){
                   $hasil[] = $data;
             }
            return $hasil;
           //} 

     echo json_encode($hasil);
} 

function paramPeriod(Request $request){
      $Date = $request->txtDate;
 
      $sqlPR = DB::select("SELECT ID FROM mPeriod WHERE StartDate <= '$Date' AND EndDate >= '$Date'");       
    
      $PeriodID = $sqlPR[0]->ID;

      echo json_encode($PeriodID); 
}


function paramCustomer(Request $request){
     $ID = $request->ID;
     
     $data = DB::select("select * from 
                            (select ID, DocType, DateVcr, Number, GrandTotal, 0 as DP, sum(isnull(Payment,0)) as TotalPayment, (GrandTotal - sum(isnull(Payment,0))) as OpenAmount  
                            from ( select a.ID, a.DocType, convert (varchar(20), a.Date, 103) as DateVcr, a.Number,  
                        Case  
                         when a.DocType = 'RD' then (a.Payment * 1) 
                         when a.DocType = 'RC' then (a.Payment * -1) 
                        end as GrandTotal, b.Payment,    
                                  0 as OpenAmount from tARMemo a  

                                left join tARPaymentDtl b ON a.ID=b.ReffDocID and a.Void=0 and b.Void=0  

                                where (a.DocType='RD' or a.DocType='RC') and a.Void = 0 and a.CustomerID =  '$ID' )  
                                  as x group by  x.ID, x.DocType, x.DateVcr, x.Number, x.GrandTotal, x.OpenAmount) as y where isnull(OpenAmount,0) != 0 

                        union all 

                        select * from 
                            (select ID, DocType, DateVcr, Number, GrandTotal, DP, sum(isnull(Payment,0)+DP) as TotalPayment, (GrandTotal - sum(isnull(Payment,0))-DP) as OpenAmount 
                            from ( select a.ID, a.DocType, convert (varchar(20), a.Date, 103) as DateVcr, a.Number, Case a.DocType when 'SI' then (a.GrandTotal * 1) when 'SR' then (a.GrandTotal * -1) end as GrandTotal, a.DP, 
                            b.Payment, 
                            0 as OpenAmount from tSales a left join tARPaymentDtl b ON a.ID=b.ReffDocID and a.Void=0 and b.Void=0 
                            where (a.DocType='SI' or a.DocType='SR') and a.Void = 0 and a.CustomerID = '$ID' ) 
                            as x group by  x.ID, x.DocType, x.DateVcr, x.Number, x.GrandTotal, x.DP, x.OpenAmount) as y where isnull(OpenAmount,0) != 0");
     echo json_encode($data); 
}



function tambahdataDetail(Request $request) {
    $NumberTemp = 0;
    $NoTemp = 0;
    
    $ID = $request->ID;
    
    $Customer =$request->cmbCustomer;
    $Account =$request->cmbAccount;
    $Method =$request->cmbMethod;

    //$Date = Carbon::createFromFormat('d/m/Y', $request->txtDate)->format('Y-m-d'); 
    $Date = $request->txtDate;
    $ChequeDueDate = $request->txtChequeDueDate;
    
    $ChequeNumber = $request->txtChequeNumber;
    $Customer = $request->cmbCustomer;
    $Branch = $request->cmbBranch;
    $Sales = $request->cmbSales;

    $Coa =$request->cmbCoa;
    $Total =$request->txtInvPayment;
    $InvPayment =$request->txtInvPayment;
    $Payment =$request->txtInvPayment;
    $BaseAmount = 1;
    
    $Notes =$request->txtNotes;
    $Void = 0;
    $DocType = 'RP';
    $BaseAR = -1;
    $BranchID = 1;
    $CreatedEmployeeID = session()->get('userLogin')[0]->EmployeeID; 
    $CreatedUserID = session()->get('userLogin')[0]->EmployeeID;
    $CreatedDate = date('Y-m-d H:i:s');


         /* untuk $PeriodID dg Parameter Date tanggal input bukan tanggal edit*/
      /************************************************************/   
          $sqlPR = DB::select("SELECT ID FROM mPeriod WHERE StartDate <= '$Date' AND EndDate >= '$Date'");       
    
          $PeriodID = $sqlPR[0]->ID;
      /**************************************************************/ 


         DB::insert("INSERT INTO tARPayment (DocType, BaseAR, BaseAmount, BranchID, Number, No, PeriodID, Date, CustomerID, AccountID, Method, ChequeNumber, ChequeDueDate, CoaID, Total, InvPayment, Payment, Notes, Void, CreatedEmployeeID, CreatedUserID, CreatedDate) VALUES ('$DocType', '$BaseAR', '$BaseAmount', '$BranchID', '$NumberTemp','$NoTemp', '$PeriodID', '$Date', '$Customer', '$Account', '$Method', '$ChequeNumber', '$ChequeDueDate', '$Coa', '$Total', '$InvPayment', '$Payment', '$Notes', '$Void', '$CreatedEmployeeID', '$CreatedUserID', '$CreatedDate')");

         $sqlMax = DB::select("SELECT MAX(ID) As maxRPID FROM tARPayment WHERE DocType='RP'");

         $maxRPID = $sqlMax[0]->maxRPID; 

        /* untuk $Number dan $Docno/No */
      /************************************************************/ 
          $sqlLC = DB::select("Select ISNULL(max(No),0) as LastCount from tARPayment
                                 where PeriodID = '$PeriodID' and  
                                       DocType = 'RP'");       
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
                 
                 $Number = 'RP-ACP-'.$Thn.$Temp.$DocNo;
      /************************************************************/ 

       
    /*update Number and DocNo*/
        DB::update("UPDATE tARPayment SET Number='$Number', No='$DocNo' WHERE ID='$maxRPID'");
    /*batas*/


     $data_MDck = $request->datanya_MDck;
     $data_json_MDck = json_encode($data_MDck);
    
     $jsonObj_MDck = json_decode($data_json_MDck);
   
     
    if (count($jsonObj_MDck) > 0) {
      
        foreach ($ID as $str) {

          $count = strpos($str,'$',1);
          $count2 = strpos($str,'&',1);
          $count3 = strpos($str,'*',1);
          $start = $count + 1;
          $start2 = $count2 + 1;
          $start3 = $count3 + 1;
          $panjang = strlen($str);
           
            $IDar = substr ($str,0,$start-1);
            $ReffDocType = substr ($str,$start,($count2-$count-1));
                  $ReffDocNumber = substr ($str,$start2,($count3-$count2-1));
            $Payment = substr ($str,$start3,($panjang-$count3-1));
           
                DB::insert("INSERT INTO tARPaymentDtl (Number,DocType,DocID,No,PeriodID,Date,ReffDocID,ReffDocType,ReffDocNumber,Payment,Void) VALUES
                      ('$Number', '$DocType', '$maxRPID', '$DocNo', '$PeriodID', '$Date', '$IDar',  '$ReffDocType', '$ReffDocNumber', '$Payment', '$Void')");

          }
    }


  }


  function rubahdataDetail(Request $request) {
    $DocID = $request->txtDocID;
    $DocNo = $request->txtDocNo; //DocNo nanti di update dibawah
    $Number = $request->txtNumber; //Number nanti di update dibawah
    
    $Date = $request->txtDate;
    $ChequeDueDate = $request->txtChequeDueDate;

    $ID = $request->ID;
    
    $ChequeNumber =$request->txtChequeNumber;
    $Customer =$request->cmbCustomer;
    $Account =$request->cmbAccount;
    $Method =$request->cmbMethod;

    $Coa =$request->cmbCoa;
    $Total =$request->txtInvPayment;
    $InvPayment =$request->txtInvPayment;
    $Payment =$request->txtInvPayment;

    $Notes =$request->txtNotes;
    $Void = $request->txtVoid;
    $EditedEmployeeID = session()->get('userLogin')[0]->EmployeeID; 
    $EditedUserID = session()->get('userLogin')[0]->EmployeeID;
    $EditedDate  = date('Y-m-d H:i:s');


        /* untuk $PeriodID dg Parameter Date tanggal input bukan tanggal edit*/
      /************************************************************/   
          $sqlPR = DB::select("SELECT ID FROM mPeriod WHERE StartDate <= '$Date' AND EndDate >= '$Date'");       
    
          $PeriodID = $sqlPR[0]->ID;
      /**************************************************************/ 


      DB::update("UPDATE tARPayment SET PeriodID='$PeriodID', Date='$Date', CustomerID='$Customer', AccountID='$Account', Method='$Method', ChequeNumber='$ChequeNumber', ChequeDueDate='$ChequeDueDate', CoaID='$Coa', Total='$Total', InvPayment='$InvPayment', Payment='$Payment', Notes='$Notes', Void='$Void', EditedEmployeeID='$EditedEmployeeID', EditedUserID='$EditedUserID', EditedDate='$EditedDate' WHERE ID ='$DocID'");

         
         $sqlMax = DB::select("SELECT MAX(ID) As maxRPID FROM tARPayment WHERE DocType='RP'");

         $maxRPID = $sqlMax[0]->maxRPID; 

  //     /* untuk $Number dan $Docno/No */
  //     /************************************************************/ 
  //         $sqlLC = DB::select("Select ISNULL(max(No),0) as LastCount from tARPayment
  //                                where PeriodID = '$PeriodID' and  
  //                                      DocType = 'RP'");       
  //                    // PeriodID harus dinamis ngikuti Date Now dg parameter $PeriodID    
          
  //           $lastCount = $sqlLC[0]->LastCount;

  //           if (empty($lastCount)){
  //               $DocNo = 1;
  //           } else{
  //                   $DocNo = ($lastCount + 1);             
  //           }
            
  //               $Thn  = date_format(date_create($Date),"ym");
  //               $Panjang =  strlen($DocNo) + strlen($Thn); 
                
  //               $Temp  = '';
  //               for ($i = 1; $i <= (8-$Panjang); $i++) {
  //                  $Temp = $Temp . '0';
  //                   }
                 
  //                $Number = 'RP-ACP-'.$Thn.$Temp.$DocNo;
  //     /************************************************************/ 

       
  //   /*update Number and DocNo*/
  //       DB::update("UPDATE tARPayment SET Number='$Number', No='$DocNo' WHERE ID='$maxRPID'");
  //   /*batas*/


     $data_MDck = $request->datanya_MDck;
     $data_json_MDck = json_encode($data_MDck);
    
     $jsonObj_MDck = json_decode($data_json_MDck);
   
    DB::delete("DELETE FROM tARPaymentDtl WHERE DocID = '$DocID'");

    if (count($jsonObj_MDck) > 0) {
      
        foreach ($ID as $str) {

         $count = strpos($str,'$',1);
          $count2 = strpos($str,'&',1);
          $count3 = strpos($str,'*',1);
          $start = $count + 1;
          $start2 = $count2 + 1;
          $start3 = $count3 + 1;
          $panjang = strlen($str);
           
            $IDar = substr ($str,0,$start-1);
            $ReffDocType = substr ($str,$start,($count2-$count-1));
                  $ReffDocNumber = substr ($str,$start2,($count3-$count2-1));
            $Payment = substr ($str,$start3,($panjang-$count3-1));
           
                 DB::insert("INSERT INTO tARPaymentDtl (Number,DocType,DocID,No,PeriodID,Date,ReffDocID,ReffDocType,ReffDocNumber,Payment,Void) VALUES
                      ('$Number', '$DocType', '$maxRPID', '$DocNo', '$PeriodID', '$Date', '$IDar',  '$ReffDocType', '$ReffDocNumber', '$Payment', '$Void')");

        }
    
    }  
  

  }
  

}
