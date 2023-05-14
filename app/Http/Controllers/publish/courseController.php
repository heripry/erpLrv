<?php

namespace App\Http\Controllers\publish;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class courseController extends Controller{
    

  function index (){

    $rs = DB::table("barang")->paginate(10);;

    $data = array('data'  => $rs);

    return view('publish/course-sidebar', $data);

  }



}
