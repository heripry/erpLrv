@extends('public/layout/main')

@section('container')  

<!-- ============ Body content start ============= -->

      <main>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area include-bg pt-150 pb-150 breadcrumb__overlay" data-background="assets/img/breadcrumb/breadcrumb-bg-1.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title">Login</h3>
                        <div class="breadcrumb__list">
                           <span><a href="index.html">Home</a></span>
                           <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                           <span>Login</span>
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
               <img class="man-1" src="assets/img/icon/sign/man-1.png" alt="">
               <img class="man-2" src="assets/img/icon/sign/man-2.png" alt="">
               <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
               <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
               <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
               <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                     <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Sign in to <br>  recharge direct.</h2>
                        <p>it you don't have an account you can <a href="#">Register here!</a></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                        <div class="sign__header mb-35">
                           <div class="sign__in text-center">
                              <a href="#" class="sign__social text-start mb-15"><i class="fab fa-facebook-f"></i>Sign in with Facebook</a>
                              <p> <span>........</span> Or, <a href="sign-in.html">sign in</a> with your email<span> ........</span> </p>
                           </div>
                        </div>
                        <div class="sign__form">
                           <form action="#">
                              <div class="sign__input-wrapper mb-25">
                                 <h5>Work email</h5>
                                 <div class="sign__input">
                                    <input type="text" placeholder="e-mail address">
                                    <i class="fal fa-envelope"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <h5>Password</h5>
                                 <div class="sign__input">
                                    <input type="text" placeholder="Password">
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__action d-sm-flex justify-content-between mb-30">
                                 <div class="sign__agree d-flex align-items-center">
                                    <input class="m-check-input" type="checkbox" id="m-agree">
                                    <label class="m-check-label" for="m-agree">Keep me signed in
                                       </label>
                                 </div>
                                 <div class="sign__forgot">
                                    <a href="#">Forgot your password?</a>
                                 </div>
                              </div>
                              <button class="tp-btn  w-100"> <span></span> Sign In</button>
                              <div class="sign__new text-center mt-20">
                                 <p>New to Eduker? <a href="sign-up.php">Sign Up</a></p>
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