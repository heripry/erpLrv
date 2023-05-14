<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class rAccountLedgerController extends Controller{

  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
               //  /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 9) { //adalah ID menu nya
                      $a = 1;
                    }
                  }
                 
                  if ($a == 0) {
                     return redirect('admin/dashboard');
                  }
               // /* hak akses menu */
                       

         return $next($request);
      });

  }
    

  function index () {
      $rs = DB::select("Select ID as ID, Code as Code, Name as Name 
                            from mAccount 
                            where Status = 0
                            Order by Code ASC");

      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

      return view('admin/mod_rAccountLedger/rAccountLedger_index', $data);
  }

  
  function browse_SO(Request $request){
       $firstDate = $request->firstDate;

       $lastDate = $request->lastDate;
       $cmbAccount = $request->cmbAccount;
        
       $rs = DB::unprepared(DB::raw("declare @AccountCode varchar(30)
                    declare @balance money
                    declare @CurrCode varchar(30)

                    declare @Date1 datetime
                    declare @Date2 datetime

                    set @Date1 = '$firstDate'
                    set @Date2 = '$lastDate'

                    set @AccountCode = '$cmbAccount'



                    /*-- BEGINNING BALANCE */
                    SET @balance =  
                      ISNULL((
                        select sum(Total) from (
                        

                          /*-- AR PAYMENT - PEMBAYARAN PIUTANG (MENAMBAH) */
                          select sum(a.Total * a.BaseAmount) as Total
                          from  
                            tARPayment a
                            left join mAccount b on a.AccountID = b.ID
                          where 
                            a.Void = 0 AND a.Method <> 'CQ' AND
                            a.Date < @Date1 AND b.Code = @AccountCode
                          

                        ) as x 
                        ), 0)


                    select  OrderID, Date, Number, Method, CurrRate, 
                        cast(Debit as money) as Debit, 
                        cast(Credit as money) as Credit,
                        cast(Balance as money) as Balance, PartnerName, ReffDocNumber
                    into #Temp
                    from (

                      /*-- BEGINNING BALANCE */
                      select  0 as OrderID, @Date1 as Date, 'BEGINNING' as Number, '' as Method, 0 as CurrRate, 
                          0 as Debit, 0 as Credit, @Balance as Balance
                          , '' as PartnerName, '' as ReffDocNumber 
                          
                      UNION ALL
                          
                      /*-- AR PAYMENT - PEMBAYARAN PIUTANG (MENAMBAH) */
                      select 
                        1 as OrderID, a.Date, a.Number, a.Method, a.CurrRate, a.Payment as Debit, 0 as Credit, 0 as Balance
                        , c.Name as PartnerName, '' as ReffDocNumber
                      from  
                        tARPayment a
                        left join mAccount b on a.AccountID = b.ID
                        left join mCustomer c on a.CustomerID = c.ID
                      where 
                        a.Void = 0 AND a.Method <> 'CQ' AND
                        a.Date >= @Date1 AND a.Date < @Date2+1 AND
                        b.Code = @AccountCode
                        
                        
                    ) as z order by z.Date, z.OrderID
                                 update #Temp 
                                 set @Balance = @Balance + Debit - Credit, 
                                 Balance = @Balance"));

      
       $rs = DB::select(DB::raw("SELECT * FROM #Temp ORDER BY Date, Number ASC"));
    

       $data['menu'] = session()->get('menu');

       $data = array('menu'  => $data['menu'],
                     'data'  => $rs);

       return view('admin/mod_rAccountLedger/rAccountLedger_view', $data); 

       
       $rs = DB::statement(DB::raw("DROP TABLE #Temp"));
   }

  

}
