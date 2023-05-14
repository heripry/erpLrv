<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class dashboardController extends Controller{
  
  public function __construct() {

	  $this->middleware(function ($request, $next){

            if (session()->has('userLogin') != 'true' ) {
              return redirect('admin/login');
            }
                   
           return $next($request);
      });
  }

  function index() {

      $userID = session()->get('userLogin')[0]->EmployeeID; 
      $userName = session()->get('userLogin')[0]->Name;
  
      
      $data['menu'] = session()->get('menu');
     

      $data = array('menu'  => $data['menu'],
                    'userName'  => $userName);

        //var_dump($data);
      return view('admin/dashboard', $data);
  
  }



}
