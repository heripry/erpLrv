<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class rAccountMutationController extends Controller{

  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
               //  /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 10) { //adalah ID menu nya
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
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu']);

      return view('admin/mod_rAccountMutation/rAccountMutation_index', $data);
  }

  
  function browse_SO(Request $request){
       $firstDate = $request->firstDate;

       $lastDate = $request->lastDate;
        
       $rs = DB::select("declare @AccountCode varchar(30)
                declare @balance money
                declare @CurrCode varchar(30)

                declare @Date1 datetime
                declare @Date2 datetime

                set @Date1 = '$firstDate'
                set @Date2 = '$lastDate'




                SELECT  y.Code as AccountCode, p.Name as AccountName, q.Code as CurrCode,
                    Beginning, Debit, Credit, (Beginning+Debit-Credit) as Balance
                FROM (
                     
                  select Code, SUM(Beginning) as Beginning, SUM(Debit) as Debit, SUM(Credit) as Credit from (
                  
                    /*-------------------------------------------------------------------------------------------*/
                        /*---SALDO AWAL------------------------------------------------------------------------------*/
                        /*-------------------------------------------------------------------------------------------*/
                        
 
                    /*-- AR PAYMENT - PEMBAYARAN PIUTANG (MENAMBAH) */  
                    select b.Code, sum(a.Total * a.BaseAmount) as Beginning, 0 as Debit, 0 as Credit, 0 as Balance 
                    from  
                      tARPayment a
                      left join mAccount b on a.AccountID = b.ID
                    where 
                      a.Void = 0 AND a.Method <> 'CQ' AND
                      a.Date < @Date1 /*AND b.Code in ('BCA01','BCA02','BCA03USD','KAS-KECIL','KAS-OPR')*/
                    group by b.Code
                    
                    UNION ALL

                        
                    /*-- AR PAYMENT - PEMBAYARAN PIUTANG (MENAMBAH) */
                    select 
                      b.Code, 0 as Beginning, sum(a.Payment) as Debit, 0 as Credit, 0 as Balance
                    from  
                      tARPayment a
                      left join mAccount b on a.AccountID = b.ID
                      left join mCustomer c on a.CustomerID = c.ID
                    where 
                      a.Void = 0 AND a.Method <> 'CQ' AND
                      a.Date >= @Date1 AND a.Date < @Date2+1 /*AND b.Code in ('BCA01','BCA02','BCA03USD','KAS-KECIL','KAS-OPR')*/
                    group by b.Code
                      
                               
                  ) as x 
                  Group by x.Code
                  ) as y
                  LEFT JOIN mAccount p on y.Code = p.Code 
                  LEFT JOIN mCurrency q on p.CurrID = q.ID");
    

       $data['menu'] = session()->get('menu');

       $data = array('menu'  => $data['menu'],
                     'data'  => $rs);

       return view('admin/mod_rAccountMutation/rAccountMutation_view', $data); 

   }

  

}
