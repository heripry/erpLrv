<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class perkiraanController extends Controller{
  
  public function __construct() {
    
      $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
                /* hak akses menu */
                 $data = session()->get("aksesmenu");
                 $a = 0;

                  foreach ($data as $list){  
                    if ($list->ID == 1199) { //adalah ID menu nya
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
       $rs = DB::select("select case Kelompok when 0 then Keterangan
                         when 1 then '  ' + Keterangan
                         when 2 then '    ' + Keterangan
                         when 3 then '      ' + Keterangan
                         when 4 then '        ' + Keterangan
                         when 5 then '          ' + Keterangan
                         when 6 then '            ' + Keterangan
                         when 7 then '              ' + Keterangan
                         when 8 then '                ' + Keterangan
                         when 9 then '                  ' + Keterangan
                         when 10 then '                    ' + Keterangan
                         when 11 then '                      ' + Keterangan
                         when 12 then '                        ' + Keterangan
                         when 13 then '                          ' + Keterangan
                         when 14 then '                            ' + Keterangan
                         when 15 then '                              ' + Keterangan
                         when 16 then '                               ' + Keterangan
                         when 17 then '                                 ' + Keterangan
                         when 18 then '                                   ' + Keterangan
                         when 19 then '                                     ' + Keterangan
                         when 20 then '                                       ' + Keterangan
                         when 21 then '                                         ' + Keterangan
                         when 22 then '                                           ' + Keterangan
                         when 23 then '                                             ' + Keterangan
                        end as Keterangan, Perkiraan,  Parent, NonAktif  
                        from (
                                
                                select Kelompok, Perkiraan, Parent, Keterangan, NonAktif from dbPerkiraan
                                WHERE NonAktif = 0

                        ) as y

                        order by Perkiraan asc");
     
      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs);

      //  var_dump($rs);
      return view('admin/mod_perkiraan/perkiraan_view', $data);
  }


  function form_tambahdata() {
      $rs = DB::select("SELECT * FROM dbPerkiraan WHERE NonAktif = 0 order by Perkiraan asc");
      $rs2 = DB::select("SELECT * FROM dbCabang  WHERE NonAktif = 0");
      $rs3 = DB::select("SELECT Distinct Kelompok FROM dbPerkiraan WHERE NonAktif = 0 Order by Kelompok ASC");

      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs,
                    'data2'  => $rs2,
                    'data3'  => $rs3);

      return view('admin/mod_perkiraan/perkiraan_add', $data);
  } 

  function form_rubahdata($ID) {
    if (session()->get('userLogin')[0]->AccessEDT == 0) {
        return redirect('admin/dashboard');
    }else {

      //$ID = Crypt::decryptString($ID);

      $rs = DB::select("SELECT * FROM dbPerkiraan WHERE Perkiraan='$ID'");
      $rs2 = DB::select("SELECT * FROM dbPerkiraan WHERE NonAktif = 0 order by Perkiraan asc");
      $rs3 = DB::select("SELECT * FROM dbCabang  WHERE NonAktif = 0");
      $rs4 = DB::select("SELECT Distinct Kelompok FROM dbPerkiraan WHERE NonAktif = 0 Order by Kelompok ASC");

      $data['menu'] = session()->get('menu');

      $data = array('menu'  => $data['menu'],
                    'data'  => $rs,
                    'data2'  => $rs2,
                    'data3'  => $rs3,
                    'data4'  => $rs4);

      return view('admin/mod_perkiraan/perkiraan_edit', $data);
    
    }
  } 


function tambahdataDetail(Request $request){
    $Perkiraan = $request->Perkiraan; 
    $GroupPerkiraan = $request->GroupPerkiraan; 
    $inActive = $request->inActive;
    $Keterangan =  $request->Keterangan;
    $CabID = $request->CabID;
    $Kelompok = $request->Kelompok;
    $GenOrDet = $request->GenOrDet;
    $MataUang = $request->MataUang;
    $DebOrKre = $request->DebOrKre;
    $NoNeraca = $request->NoNeraca;
    $KodeBukti = $request->KodeBukti;
  
    
    DB::beginTransaction();

    try {
        DB::insert("INSERT INTO dbPerkiraan (Perkiraan, Parent, Keterangan, Kelompok, Valas, Neraca, Tipe, DK, KodeCabang, NonAktif) VALUES ('$Perkiraan', '$GroupPerkiraan', '$Keterangan', '$Kelompok', '$MataUang', '$NoNeraca', '$GenOrDet', '$DebOrKre', '$CabID', '$inActive')");   
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
    $ID = $request->ID;
    $Perkiraan = $request->Perkiraan; 
    $GroupPerkiraan = $request->GroupPerkiraan; 
    $inActive = $request->inActive;
    $Keterangan =  $request->Keterangan;
    $CabID = $request->CabID;
    $Kelompok = $request->Kelompok;
    $GenOrDet = $request->GenOrDet;
    $MataUang = $request->MataUang;
    $DebOrKre = $request->DebOrKre;
    $NoNeraca = $request->NoNeraca;
    $KodeBukti = $request->KodeBukti;


    DB::beginTransaction();

    try {
        DB::update("UPDATE dbPerkiraan set Perkiraan='$Perkiraan', Parent='$GroupPerkiraan', Keterangan='$Keterangan', Kelompok='$Kelompok', Valas='$MataUang', Neraca='$NoNeraca', Tipe='$GenOrDet', DK='$DebOrKre', KodeCabang='$CabID', NonAktif='$inActive' WHERE Perkiraan='$ID'");   
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
