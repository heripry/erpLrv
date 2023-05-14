<!doctype html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Eduker – Online Course & Education HTML5 Template</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Place favicon.ico in the root directory -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_public/img/favicon.png') }}">

      <!-- CSS here -->
      <link rel="stylesheet" href="{{ asset('assets_public/css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/meanmenu.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/owl-carousel.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/swiper-bundle.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/backtotop.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/magnific-popup.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/nice-select.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/font-awesome-pro.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/spacing.css') }}">
      <link rel="stylesheet" href="{{ asset('assets_public/css/style.css') }}">

      <!-- JS here -->
      <script src="{{ asset('assets_public/js/vendor/jquery.js') }}"></script>
      <script src="{{ asset('assets_public/js/vendor/waypoints.js') }}"></script>
      <script src="{{ asset('assets_public/js/bootstrap-bundle.js') }}"></script>
      <script src="{{ asset('assets_public/js/meanmenu.js') }}"></script>
      <script src="{{ asset('assets_public/js/swiper-bundle.js') }}"></script>
      <script src="{{ asset('assets_public/js/owl-carousel.js') }}"></script>
      <script src="{{ asset('assets_public/js/magnific-popup.js') }}"></script>
      <script src="{{ asset('assets_public/js/parallax.js') }}"></script>
      <script src="{{ asset('assets_public/js/backtotop.js') }}"></script>
      <script src="{{ asset('assets_public/js/nice-select.js') }}"></script>
      <script src="{{ asset('assets_public/js/counterup.js') }}"></script>
      <script src="{{ asset('assets_public/js/wow.js') }}"></script>
      <script src="{{ asset('assets_public/js/isotope-pkgd.js') }}"></script>
      <script src="{{ asset('assets_public/js/imagesloaded-pkgd.js') }}"></script>
      <script src="{{ asset('assets_public/js/ajax-form.js') }}"></script>
      <script src="{{ asset('assets_public/js/main.js') }}"></script>

   </head>
   <body>
      <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->


      <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <svg id="loader">
                  <path id="corners" d="m 0 12.5 l 0 -12.5 l 50 0 l 0 50 l -50 0 l 0 -37.5" />
               </svg>
               <img src="{{ asset('assets_public/img/favicon.png') }}" alt="">
            </div>
         </div>  
      </div>
      <!-- pre loader area end -->

      <!-- back to top start -->
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <!-- back to top end -->
      
      <!-- header area start -->
      <header>
         <div class="header__area">
            <div class="header__top header__border d-none d-md-block">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-8">
                        <div class="header__info">
                          <ul>
                            <?php if (session()->get('userLogin') <> null) { ?> 
                                <li><a href="#"><i class="fal fa-user"></i><?php echo '<strong>Hi ' .(session()->get('userLogin')[0]->Name).'</strong>'; ?></a>
                                </li>
                                <li><i class="fal fa-gear"></i><a href="{{ route('publish/logout') }}"> Logout</a></li>
                            <?php }else if (session()->get('userLogin') == null) { ?>
                                <li><a href="sign-in.php"><i class="fal fa-user"></i> Login</a>
                                </li>   
                            <?php } ?> 
                           </ul>  
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header__bottom" id="header-sticky">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-6">
                        <div class="logo">
                           <a href="index.html">
                              <img src="{{ asset('assets_public/img/logo/logo.png') }}" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block">
                        <div class="main-menu">
                           <nav id="mobile-menu">
                              <ul>
                                 <li class="has-dropdown">
                                    <a href="index.html">Home</a>
                                    <ul class="submenu">
                                       <li><a href="index.html">Home Style 1</a></li>
                                       <li><a href="index-2.html">Home Style 2</a></li>
                                       <li><a href="index-3.html">Home Style 3</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="about.html">About</a>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="course-v1.html">Courses</a>
                                    <ul class="submenu">
                                       <li><a href="course-v1.html">Course Style 1</a></li>
                                       <li><a href="course-v2.html">Course Style 2</a></li>
                                       <li><a href="course-list.html">Course List</a></li>
                                       <li><a href="course-sidebar.html">Course Sidebar</a></li>
                                       <li><a href="course-details.html">Course Details</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="about.html">Pages</a>
                                    <ul class="submenu">
                                       <li><a href="event.html">Our Events</a></li>
                                       <li><a href="event-details.html">Event Details</a></li>
                                       <li><a href="team.html">Team</a></li>
                                       <li><a href="team-details.html">Team Details</a></li>
                                       <li><a href="error.html">404 Error</a></li>
                                       <li><a href="my-profile.html">My Profile</a></li>
                                       <li><a href="my-course.html">My Courses</a></li>
                                       <li><a href="sign-in.html">Sign In</a></li>
                                       <li><a href="sign-up.html">Sign Up</a></li>
                                       <li><a href="cart.html">Cart</a></li>
                                       <li><a href="wishlist.html">Wishlist</a></li>
                                       <li><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="blog.html">Blog</a>
                                    <ul class="submenu">
                                       <li><a href="blog.html">Blog</a></li>
                                       <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="contact.html">Contact</a>
                                 </li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-xl-3 col-lg-2 col-md-6 col-6">
                        <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">
                           <div class="header__search w-100 d-none d-xl-block">
                              <form action="#">
                                 <div class="header__search-input">
                                    <input type="text" placeholder="Search...">
                                    <button class="header__search-btn"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M8.11117 15.2222C12.0385 15.2222 15.2223 12.0385 15.2223 8.11111C15.2223 4.18375 12.0385 1 8.11117 1C4.18381 1 1.00006 4.18375 1.00006 8.11111C1.00006 12.0385 4.18381 15.2222 8.11117 15.2222Z" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M17 17L13.1334 13.1333" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </button>
                                 </div>
                              </form>
                           </div>
                           <div class="header__hamburger ml-50 d-xl-none">
                              <button type="button" data-bs-toggle="modal" data-bs-target="#offcanvasmodal" class="hamurger-btn">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->
      
      <!-- offcanvas area start -->
      <div class="offcanvas__area">
         <div class="modal fade" id="offcanvasmodal" tabindex="-1" aria-labelledby="offcanvasmodal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                   <div class="offcanvas__wrapper">
                      <div class="offcanvas__content">
                         <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo logo">
                               <a href="index.html">
                               <img src="{{ asset('assets_public/img/logo/logo.png') }}" alt="logo">
                               </a>
                            </div>
                            <div class="offcanvas__close">
                               <button class="offcanvas__close-btn" data-bs-toggle="modal" data-bs-target="#offcanvasmodal">
                                  <i class="fal fa-times"></i>
                               </button>
                            </div>
                         </div>
                         <div class="offcanvas__search mb-25">
                            <form action="#">
                               <input type="text" placeholder="What are you searching for?">
                               <button type="submit" ><i class="far fa-search"></i></button>
                            </form>
                         </div>
                         <div class="mobile-menu fix"></div>
                         <div class="offcanvas__text d-none d-lg-block">
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and will give you a complete account of the system and expound the actual teachings of the great explore</p>
                         </div>
                         <div class="offcanvas__map d-none d-lg-block mb-15">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29176.030811137334!2d90.3883827!3d23.924917699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1605272373598!5m2!1sen!2sbd"></iframe>
                         </div>
                         <div class="offcanvas__contact mt-30 mb-20">
                            <h4>Contact Info</h4>
                            <ul>
                               <?php if (session()->get('userLogin') <> null) { ?>
                                  <li class="d-flex align-items-center">
                                     <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-user"></i>
                                     </div>
                                     <div class="offcanvas__contact-text">
                                        <a href="#"><?php echo 'Hi ' .(session()->get('userLogin')[0]->Name); ?></a>
                                     </div>
                                  </li>
                                  <li class="d-flex align-items-center">
                                     <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-gear"></i>
                                     </div>
                                     <div class="offcanvas__contact-text">
                                        <a href="{{ route('publish/logout') }}">Logout</a>
                                     </div>
                                  </li>
                               <?php }else if (session()->get('userLogin') == null) { ?>
                                   <li class="d-flex align-items-center">
                                     <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-user"></i>
                                     </div>
                                     <div class="offcanvas__contact-text">
                                        <a href="sign-in.php">Log In</a>
                                     </div>
                                  </li>  
                               <?php } ?> 

                               
                            </ul>
                         </div>
                         <div class="offcanvas__social">
                            <ul>
                               <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                               <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                               <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
      </div>
      <!-- offcanvas area end -->      
      <div class="body-overlay"></div>
      <!-- offcanvas area end -->


<!-- ============ body content start ============= -->
            
               @yield('container')
            
<!-- ============ body content end ============= -->

 <!-- footer area start -->
         <footer>
            <div class="footer__area">
               <div class="footer__top grey-bg-4 pt-95 pb-45">
                  <div class="container">
                     <div class="row">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                           <div class="footer__widget footer-col-1 mb-50">
                              <div class="footer__logo">
                                 <div class="logo">
                                    <a href="index.html">
                                       <img src="{{ asset('assets_public/img/logo/logo.png') }}" alt="">
                                    </a>
                                 </div>
                              </div>
                              <div class="footer__widget-content">
                                 <div class="footer__widget-info">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisc ing elit. Nunc maximus, nulla utlaoki comm odo sagittis.</p>
                                    <div class="footer__social">
                                       <h4>Follow Us</h4>

                                       <ul>
                                          <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                          <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5">
                           <div class="footer__widget mb-50">
                              <h3 class="footer__widget-title">Explore</h3>
                              <div class="footer__widget-content">
                                 <ul>
                                    <li>
                                       <a href="#">About us</a>
                                    </li>
                                    <li>
                                       <a href="#">Success story</a>
                                    </li>
                                    <li>
                                       <a href="#">Courses</a>
                                    </li>
                                    <li>
                                       <a href="#">About us</a>
                                    </li>
                                    <li>
                                       <a href="#">Instructor</a>
                                    </li>
                                    <li>
                                       <a href="#">Events</a>
                                    </li>
                                    <li>
                                       <a href="#">Contact us</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5">
                           <div class="footer__widget mb-50">
                              <h3 class="footer__widget-title">Links</h3>
                              <div class="footer__widget-content">
                                 <ul>
                                    <li>
                                       <a href="#">News & Blogs</a>
                                    </li>
                                    <li>
                                       <a href="#">Library</a>
                                    </li>
                                    <li>
                                       <a href="#">Gallery</a>
                                    </li>
                                    <li>
                                       <a href="#">Terms of service</a>
                                    </li>
                                    <li>
                                       <a href="#">Membership</a>
                                    </li>
                                    <li>
                                       <a href="#">Career</a>
                                    </li>
                                    <li>
                                       <a href="#">Partners</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                           <div class="footer__widget footer-col-4 mb-50">
                              <h3 class="footer__widget-title">Sign up for our newsletter</h3>

                              <div class="footer__subscribe">
                                 <p>Receive weekly newsletter with educational materials, popular books and much more!</p>
                                 <form action="#">
                                    <div class="footer__subscribe-input">
                                       <input type="text" placeholder="Email">
                                       <button type="submit" class="tp-btn-subscribe">Subscribe</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="footer__bottom grey-bg-4">
                  <div class="container">
                     <div class="footer__bottom-inner">
                        <div class="row">
                           <div class="col-xxl-12">
                              <div class="footer__copyright text-center">
                                 <p>© 2022 Eduker. All Rights Reserved</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer area end -->


   </body>
</html>


