<?php

namespace App\Http\Controllers\publish;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class loginController extends Controller{
    

  function validasi (Request $request){

  	$Email = $request->Email;
  	$Password = hash ('md5', $request->Password);

    $rs = DB::select("select * from mcustomer
                      where Email = '$Email' and Password='$Password'");

         if (count($rs) > 0) {
              session()->put('userLogin', $rs);
              return redirect('/');
          }else {
             echo('<script> alert("Username dan password yang anda masukkan tidak sesuai, mohon dicek kembali"); </script>');   
             return view('publish/sign-in');       
         }

  }


  function logout() {
	  session()->forget('userLogin');
	  return redirect('/');
  }	



}
