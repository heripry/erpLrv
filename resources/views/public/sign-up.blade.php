@extends('publish/layout/main')

@section('container')  

<script>
$(document).ready(function(){ 

  $("#Simpan").click(function(){
      cekNoKTP();
      cekEmail();
      cekPhone();
      cekDataSimpan();
   });   

  $("#txtNoKTP").change(function(){
      cekNoKTP();
  });

  $("#txtEmailNew").change(function(){
      cekEmail();
  });

  $("#txtPhoneNew").change(function(){
      cekPhone();
  });

 function cekNoKTP(){
        var NoKTP = $("#txtNoKTP").val();

      $.ajax({
          type: "POST",
          data: {"_token": "{{ csrf_token() }}", NoKTP: NoKTP},
          dataType: 'JSON',
          url: "{{ route('publish/sign-up/paramCekNoKTP') }}",
          success: function(res) {
            console.log(res);
          if (res != null) {
               $("#lblKTP").html(res[0].IDNumber);
          } 
        }  
      });
  }      
    
  function cekEmail(){
        var Email = $("#txtEmailNew").val();

    $.ajax({
        type: "POST",
        data: {"_token": "{{ csrf_token() }}", Email :Email},
        dataType: 'JSON',
        url: "{{ route('publish/sign-up/paramCekEmail') }}",
        success: function(res) {
         if (res != null) { 
          $("#lblEmail").html(res[0].Email);
         } 
        }  
    });
  }   

  function cekPhone(){
        var Phone = parseInt($('#txtPhoneNew').val().toUpperCase().trim(), 10);

    $.ajax({
        type: "POST",
        data: {"_token": "{{ csrf_token() }}", Phone :Phone} ,
        dataType: 'JSON',
        url: "{{ route('publish/sign-up/paramCekPhone') }}",
        success: function(res) {
         if (res != null) { 
          $("#lblPhone").html(res[0].Phone1);
         } 
        }  
    });
  }   

   function cekDataSimpan() {
        //if cektexbox apakah kosong 
              if ($('#txtCustomerNameNew').val() == '') {alert('Nama Harus Diisi'); $('#txtCustomerNameNew').focus();}
              
              else if ($('#txtPassword').val()== '') {alert('Password Harus Diisi'); $('#txtPassword').focus();}
               else if ($('#txtPassword').val() != $('#txtConfirmPassword').val()) {alert('Confirm Password Harus Sama'); $('#txtConfirmPassword').focus();}
                 else if ($('#txtEmailNew').val()== '') {alert('Email Harus Diisi'); $('#txtEmailNew').focus();}
              else if ($('#txtEmailNew').val().toUpperCase().trim() === $('#lblEmail').html().toUpperCase().trim()) {alert('Email Ini Sudah digunakan Coba Pakai Email Lain'); $('#txtEmailNew').focus();}
                 else if ($('#txtAddressNew').val() == '') {alert('Alamat Harus Diisi'); $('#txtAddressNew').focus();}
                 else if ($('#txtProvinceNew').val() == 0) {alert('Provinsi Harus Diisi'); $('#txtProvinceNew').focus();}
                 else if ($('#txtCityNew').val() == 0) {alert('City Harus Diisi'); $('#txtCityNew').focus();}
              else if ($('#txtDistrictNew').val() == 0) {alert('District Harus Diisi'); $('#txtDistrictNew').focus();}
              else if ($('#txtVillageNew').val() == 0) {alert('Village Harus Diisi'); $('#txtVillageNew').focus();}
                 else if ($('#txtPhoneNew').val() == '') {alert('Phone Harus Diisi'); $('#txtPhoneNew').focus();}
              else if ('+62'+ parseInt($('#txtPhoneNew').val().toUpperCase().trim(), 10) === $('#lblPhone').html().toUpperCase().trim()) {alert('No HP Ini Sudah digunakan Coba Pakai No HP Lain'); $('#txtPhoneNew').focus();}
               
              // else if ($('#txtNoKTP').val() == '' ){alert('KTP Harus Di Isi'); $('#txtNoKTP').focus();}
              // else if ( document.getElementById("fotoKTP").files.length == 0 ){alert('Foto KTP Harus Di Upload'); $('#fotoKTP').focus();}
             /*
              else if ($('#txtNoRek').val() == ''){alert('No Rekening Harus Di Isi'); $('#txtNoRek').focus();}
              else if ( document.getElementById("fotoRek").files.length == 0 ){alert('Foto Rekening Harus Di Isi'); $('#fotoRek').focus();}
              */

               else if ($('#txtNoKTP').val() == '' && document.getElementById("fotoKTP").files.length != 0 ){alert('KTP Harus Di Isi'); $('#txtNoKTP').focus();}
               else if ($('#txtNoKTP').val().toUpperCase().trim() === $('#lblKTP').html().toUpperCase().trim()) {alert('KTP Ini Sudah digunakan Coba Pakai KTP Lain'); $('#txtNoKTP').focus();}
              // else if ($('#txtNoKTP').val() != '' && document.getElementById("fotoKTP").files.length == 0 ){alert('Foto KTP Harus Di Upload'); $('#fotoKTP').focus();}
              /*
              else if ($('#txtNoRek').val() == '' && document.getElementById("fotoRek").files.length != 0 ){alert('No Rekening Harus Di Isi'); $('#txtNoRek').focus();}
              else if ($('#txtNoRek').val() != '' && document.getElementById("fotoRek").files.length == 0 ){alert('Foto Rekening Harus Di Isi'); $('#fotoRek').focus();}
                */
             //else if ($('#txtPosCodeNew').val() == '') {alert('PosCode Harus Diisi'); $('#txtPosCodeNew').focus();}  
                 else{simpanData();}
   }


   function simpanData(){

                $('#Simpan').prop('disabled', true);

                        $.ajax({
                                       type: 'POST',
                                       url: "{{ route('publish/sign-up/simpanData') }}",
                                        data: { "_token": "{{ csrf_token() }}", /*captcha: grecaptcha.getResponse(),*/ txtNoKTP: $('#txtNoKTP').val(), txtCustomerName: $('#txtCustomerNameNew').val(), /*cmbGender: $('#cmbGender').val(),*/ txtEmail: $('#txtEmailNew').val(), txtPhone: $('#txtPhoneNew').val(), txtAddress: $('#txtAddressNew').val(), txtPassword: $('#txtPassword').val(), /*txtProvince: $('#txtProvinceNew').val(), txtCity: $('#txtCityNew').val(), txtDistrict: $('#txtDistrictNew').val(), txtVillage: $('#txtVillageNew').val()*/}, 
                                       dataType: 'html',
                                       success: function(sData){

                                           alert('Silahkan cek email anda untuk konfirmasi selanjutnya untuk login.');
                                       
                                       },
                                        error: function(xhr, status, error) {
                                              alert('Proses gagal Silahkan Klik Simpan Lagi');
                                              $('#Simpan').prop('disabled', false);
                                            }
                      });  
                                                                

   
   } //tutupnya  function simpanData 

});
</script>   
<!-- ============ Body content start ============= -->

      <main>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area include-bg pt-150 pb-150 breadcrumb__overlay" data-background="assets/img/breadcrumb/breadcrumb-bg-1.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title">Register</h3>
                        <div class="breadcrumb__list">
                           <span><a href="index.html">Home</a></span>
                           <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                           <span>Register</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

         <!-- sign up area start -->
         <section class="signup__area p-relative z-index-1 pt-100 pb-145">
            <div class="sign__shape">
               <img class="man-1" src="assets/img/icon/sign/man-3.png" alt="">
               <img class="man-2 man-22" src="assets/img/icon/sign/man-2.png" alt="">
               <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
               <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
               <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
               <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
               <img class="flower" src="assets/img/icon/sign/flower.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                     <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Create a free <br>  Account</h2>
                        <p>I'm a subhead that goes with a story.</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                   <!--      <div class="sign__header mb-35">
                           <div class="sign__in text-center">
                              <a href="#" class="sign__social g-plus text-start mb-15"><i class="fab fa-google-plus-g"></i>Sign Up with Google</a>
                              <p> <span>........</span> Or, <a href="sign-up.html">sign up</a> with your email<span> ........</span> </p>
                           </div>
                        </div> -->
                        <div class="sign__form">
                           <form action="#">
                               <div class="sign__input-wrapper mb-25">
                                 <h5>NIK</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtNoKTP" placeholder="NIK">
                                    <i class="fal fa-credit-card"></i>
                                    <div id="lblKTP" style=""></div>
                                 </div>
                              </div>
                              
                              <div class="sign__input-wrapper mb-25">
                                 <h5>Nama</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtCustomerNameNew" placeholder="Nama">
                                    <i class="fal fa-user"></i>
                                 </div>
                              </div>
                              
                              <div class="sign__input-wrapper mb-25">
                                 <h5>Email</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtEmailNew" placeholder="e-mail address">
                                    <i class="fal fa-envelope"></i>
                                    <div id="lblEmail" style=""></div>
                                 </div>
                              </div>

                               <div class="sign__input-wrapper mb-25">
                                 <h5>No Handphone</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtPhoneNew" placeholder=" No HP">
                                    <i style="color:red;">+62</i>
                                    <div id="lblPhone" style=""></div>
                                 </div>
                              </div>

                               <div class="sign__input-wrapper mb-25">
                                 <h5>Alamat</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtAddressNew" placeholder="Alamat">
                                    <i class="fal fa-location"></i>
                                 </div>
                              </div>
                               
                             <!--   <div class="sign__input-wrapper mb-25">
                                 <h5>Provinsi</h5>
                                 <div class="sign__input"> 
                                   <select id="txtProvinceNew" placeholder="Provinsi" data-mini="true" class="form-control">
                                    <option value=0 selected>-Pilih-</option>
                                     <?php //$no=1; //foreach($data3 as $list) 
                                      //{ 
                                       //echo "<option value='".$list['Province']."'>".$list['Province']."</option>";
                                      //} 
                                     ?>
                                    </select>
                                    <i class="fal fa-location"></i>
                                 </div>
                               </div>
                               
                               <div class="sign__input-wrapper mb-25">
                                 <h5>Kota/Kab</h5>
                                 <div class="sign__input">
                                     <select id="txtCityNew" placeholder="Kota/Kab" data-mini="true" class="form-control">
                                      <option value=0 selected>-Pilih-</option>
                                     </select>
                                    <i class="fal fa-location"></i>
                                 </div>
                              </div> -->
                           
                              <div class="sign__input-wrapper mb-25">
                                 <h5>Password</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtPassword" placeholder="Password">
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <h5>Re-Password</h5>
                                 <div class="sign__input">
                                    <input type="text" id="txtConfirmPassword" placeholder="Re-Password">
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__action d-flex justify-content-between mb-30">
                                 <div class="sign__agree d-flex align-items-center">
                                    <input class="m-check-input" type="checkbox" id="m-agree">
                                    <label class="m-check-label" for="m-agree">I agree to the <a href="#">Terms & Conditions</a>
                                       </label>
                                 </div>
                              </div>
                              <button type="submit" id="Simpan" class="tp-btn w-100"> <span></span> Sign Up</button>
                              <div class="sign__new text-center mt-20">
                                 <p>Already in Eduker ? <a href="sign-in.php"> Sign In</a></p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- sign up area end -->


      </main>

<!-- ============ Body content end ============= -->    

@endsection  