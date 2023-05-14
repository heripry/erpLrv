<?php

namespace App\Http\Controllers\publish;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class signupController extends Controller{
  
  public function __construct() {
    
      // $this->middleware(function ($request, $next){

      //       if (session()->has('userLogin') != 'true' ) {
      //         return redirect('admin/login');
      //       }
                   
      //           /* hak akses menu */
      //            $data = session()->get("aksesmenu");
      //            $a = 0;

      //             foreach ($data as $list){  
      //               if ($list->ID == 1197) { //adalah ID menu nya
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


  function paramCekNoKTP(Request $request){
        $NoKTP = $request->NoKTP;
        $rs = DB::select("SELECT * FROM mcustomer WHERE IDNumber='$NoKTP'");

       if (count($rs) > 0){
          echo json_encode($rs[0]->IDNumber);
       }else{
          echo json_encode('false');
       }
   }

   function paramCekEmail(Request $request){
        $Email = $request->Email;
        $rs = DB::select("SELECT * FROM mcustomer WHERE Email='$Email'");

      if (count($rs) > 0){
          echo json_encode($rs[0]->Email);
       }else{
          echo json_encode('false');
       }
   }


   function paramCekPhone(Request $request){
        $Phone = '+62'.$request->Phone;
        $rs = DB::select("SELECT * FROM mcustomer WHERE Phone1='$Phone'");

      if (count($rs) > 0){
          echo json_encode($rs[0]->Phone1);
       }else{
          echo json_encode('false');
       }
   }

function simpanData(Request $request){
    $NoKTP = $request->txtNoKTP; 
    $CustomerName = str_replace("'", "''",$request->txtCustomerName); 
    $Email = str_replace("'", "''",$request->txtEmail);
    $Phone = '+62'.ltrim(str_replace("'", "''",$request->txtPhone), '0');
    $Address = str_replace("'", "''",$request->txtAddress); 
    $Password = hash ('md5', $request->txtPassword);
  
    $rs = DB::insert("INSERT INTO mcustomer (IDNumber, Name, Email, Phone1, Address, Password) VALUES ('$NoKTP', '$CustomerName', '$Email', '$Phone', '$Address', '$Password')");


        // require base_path("vendor/autoload.php");
        // $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        // try {

        //    $message = "<html>
            
        //               <head>
        //                <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        //                <meta name='viewport' content='width=device-width, initial-scale=1.0;'>
        //              <meta name='format-detection' content='telephone=no'/>
        //              <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
        //              https://github.com/konsav/email-templates/  -->
        //             </head>

        //             <body>
        //             <table width='600' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse;border-spacing:0;font-size:0;min-width: 600px;'>
                    
            
                    
        //             <tr>
        //              <td colspan='12'>
        //                 <p style='color:black; font-family: Arial; font-size:20px'>
                            
                          

        //                   Yth sdr/i :
        //                    Mohon untuk segera konfirmasi link berikut sebelum anda login 
                          
        //                    untuk login anda 
        //                     username: 
                            
        //                     password: 
        //                 </p>
                                   
        //              </td>
        //             </tr>

        //                       </table>
        //                       </body>
        //                       </html>"; 



        //     // Email server settings
        //     $mail->SMTPDebug = 0;
        //     $mail->isSMTP();
        //     $mail->Host = 'mail.smtp2go.com';             //  smtp host
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'smtp1@siapsoft.com';   //  sender username
        //     $mail->Password = 'smtp2go0-opklm,';       // sender password
        //     $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
        //     $mail->Port = 587;                          // port - 587/465

        //     $mail->SetFrom('smtp1@siapsoft.com', 'smtp1@siapsoft.com');
        //     $mail->addAddress($Email);
        //     //$mail->addCC($request->emailCc);
        //     //$mail->addBCC($request->emailBcc);

        //     //$mail->addReplyTo('sender-reply-email', 'sender-reply-name');

        //     // if(isset($_FILES['emailAttachments'])) {
        //     //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
        //     //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
        //     //     }
        //     // }


        //     $mail->isHTML(true);                // Set email content format to HTML

        //     $mail->Subject = 'Login';
        //     $mail->Body    = 'test';

        //     // $mail->AltBody = plain text version of email body;

        //     if( !$mail->send() ) {
        //         return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
              
        //     }
            
        //     else {
        //         return back()->with("success", "Email has been sent.");
                
        //     }

        // } catch (Exception $e) {
        //      return back()->with('error','Message could not be sent.');

        // }
       
    }

}
