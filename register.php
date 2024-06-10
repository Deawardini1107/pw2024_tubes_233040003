<?php
require 'Models/Database.php';
session_start();




?>

<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Time Traveler</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="assets/css/plugins/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/plugins/chosen.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider.min.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-pro.css">
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/spacing.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>



<body>

    <!-- preloader start -->
    <div id="preloader">
        <div class="bd-three-bounce">
            <div class="bd-child bd-bounce1"></div>
            <div class="bd-child bd-bounce2"></div>
            <div class="bd-child bd-bounce3"></div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- Header area start -->
    <?php require_once 'components/header.php'; ?>

    <!-- Header area end -->

    <!-- Offcanvas area start -->
    <div class="fix">
        <div class="offcanvas-area">
            <div class="offcanvas-wrapper">
                <div class="offcanvas-content">
                    <div class="offcanvas-top d-flex justify-content-between align-items-center mb-25">
                        <div class="offcanvas-logo">
                            <a href="index.html">
                                <img src="assets/images/logo/logo-black.svg" alt="logo not found">
                            </a>
                        </div>
                        <div class="offcanvas-close">
                            <button class="offcanvas-close-icon animation--flip">
                                <span class="offcanvas-m-lines">
                                    <span class="offcanvas-m-line line--1"></span><span class="offcanvas-m-line line--2"></span><span class="offcanvas-m-line line--3"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="offcanvas-search mb-0">
                        <form action="#">
                            <input type="text" name="offcanvasSearch" placeholder="Search here">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu fix mb-25"></div>
                    <div class="offcanvas-about d-none d-lg-block mb-25">
                        <h4 class="offcanvas-title-meta">About Tourigo</h4>
                        <p>Explore stunning destinations and create immersive travel experiences that inspire wanderlust
                            and
                            captivate your audience from the start.</p>
                    </div>
                    <div class="offcanvas-contact mb-25">
                        <h4 class="offcanvas-title-meta">Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center gap-10">
                                <div class="offcanvas-contact-icon">
                                    <a target="_blank" href="#">
                                        <i class="fal fa-map-marker-alt"></i></a>
                                </div>
                                <div class="offcanvas-contact-text">
                                    <a target="_blank" href="#">1426 Center StreetBend, 97702, California, USA</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-10">
                                <div class="offcanvas-contact-icon">
                                    <a href="tel:+415864872899"><i class="far fa-phone"></i></a>
                                </div>
                                <div class="offcanvas-contact-text">
                                    <a href="tel:+415864872899">+415-864-8728-99</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-10">
                                <div class="offcanvas-contact-icon">
                                    <a href="https://html.bdevs.net/cdn-cgi/l/email-protection#9cefe9ececf3eee8dce8f3e9eef5fbf3b2fff3f1"><i class="fal fa-envelope"></i></a>
                                </div>
                                <div class="offcanvas-contact-text">
                                    <a href="https://html.bdevs.net/cdn-cgi/l/email-protection#d2a1a7a2a2bda0a692a6bda7a0bbb5bdfcb1bdbf"><span class="__cf_email__" data-cfemail="166563666679646256627963647f71793875797b">[email&#160;protected]</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="offcanvas-btn mb-25">
                        <h4 class="offcanvas-title-meta">Account</h4>
                        <div class="header-btn-wrap gap-10">
                            <a class="bd-btn btn-style text-btn" href="sign-in.html">Log In</a>
                            <a class="bd-btn btn-style text-btn" href="contact.html">Get Started</a>
                        </div>
                    </div>
                    <div class="offcanvas-social">
                        <h4 class="offcanvas-title-meta">Subscribe & Follow</h4>
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
    <div class="offcanvas-overlay"></div>
    <div class="offcanvas-overlay-white"></div>
    <!-- Offcanvas area start -->

    <!-- modal booking form start -->
    <div class="booking-model">
        <div class="modal fade" id="popUpBookingForm" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Booking Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-top mb-20">
                            <div class="d-flex gap-24 justify-content-between align-items-center mb-30">
                                <h6 class="guest-title small">Adult</h6>
                                <div class="guest-number">
                                    <span class="guest-number-minus">
                                        <i class="fa-sharp fa-regular fa-minus"></i>
                                    </span>
                                    <input class="guest-number-input" type="text" value="3">
                                    <span class="guest-number-plus">
                                        <i class="fa-sharp fa-regular fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex gap-24 justify-content-between align-items-center mb-30">
                                <h6 class="guest-title small">Infant</h6>
                                <div class="guest-number">
                                    <span class="guest-number-minus">
                                        <i class="fa-sharp fa-regular fa-minus"></i>
                                    </span>
                                    <input class="guest-number-input" type="text" value="1">
                                    <span class="guest-number-plus">
                                        <i class="fa-sharp fa-regular fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex gap-10 justify-content-between align-items-center">
                                <h6 class="guest-title small">Date</h6>
                                <div class="booking-modal-form-input">
                                    <input class="form-control" id="selectingMultipleDate" type="text" placeholder="Select Your date Range" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body-bottom">
                            <h6 class="mb-10">Add Infant's Ages</h6>
                            <div class="booking-infant-age">
                                <select name="years" id="years">
                                    <option>9 Years</option>
                                    <option>10 Years</option>
                                    <option selected>11 Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="booking.html" class="bd-primary-btn btn-style is-bg radius-60">
                            <span class="bd-primary-btn-text">Continue</span>
                            <span class="bd-primary-btn-circle"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal booking form end -->

    <!-- Body main wrapper start -->
    <main>
        <div class="pt-50"></div>
        <!-- sign-in area start -->
        <section class="bd-sign-area section-space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-5">
                        <div class="sign-form-wrapper text-center">
                            <h4 class="title mb-30">Welcome back</h4>
                            <form method="post" class="register" action="auth/register.php">
                                <div class="input-box mb-15">
                                    <input type="text" class="input-text" name="username" id="name" required placeholder="Nama Lengkap" />
                                </div>
                                <div class="input-box mb-15">
                                    <input type="email" class="input-text" name="email" id="email2" required placeholder="Email" />
                                </div>
                                <div class="input-box mb-20">
                                <input type="password" class="input-text" name="password1" id="password1" required placeholder="Type Password Here"/>
                                </div>
                                <div class="input-box mb-20">
                                    <input type="password" class="input-text" name="password2" id="password1" required placeholder="Type Password Here"/>
                                </div>
                                <div class="sign-meta d-flex justify-content-between mb-20">
                                    <div class="sign-remember">
                                        <label class="footer-form-check-label signing-page cursor">
                                            <input type="checkbox">
                                            <svg viewBox="0 0 64 64" height="2em" width="2em">
                                                <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                                            </svg> Remember me
                                        </label>
                                    </div>
                                    <div class="sign-forgot">
                                        <a href="forgot.html" class="sign-link">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="sign-btn">
                                    <button type="submit" class="bd-primary-btn btn-style is-bg radius-60">
                                        <span class="bd-primary-btn-text">Log in</span>
                                        <span class="bd-primary-btn-circle"></span>
                                    </button>
                                </div>
                            </form>
                            <div class="sign-meta-divider-wrapper">
                                <div class="sign-meta-divider-line left-line"></div>
                                <span class="sign-meta-divider-title">or</span>
                                <div class="sign-meta-divider-line right-line"></div>
                            </div>
                           
                            <div class="sign-up-label text-center">
                                 have an account?<a href="login.php" class="sign-link"> Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign-in area end -->

    </main>
    <!-- Body main wrapper end -->

    <!-- Footer area start -->

    <?php require_once 'components/footer.php'; ?>
    <!-- Footer area end -->

    <!-- back to top -->
    <!-- Backtotop start -->
    <div class="backtotop-wrap cursor-pointer">
        <svg class="backtotop-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Backtotop end -->

    <!-- JS here -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/meanmenu.min.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/dropzone.min.js"></script>
    <script src="assets/js/vendor/magnific-popup.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/purecounter.js"></script>
    <script src="assets/js/plugins/nouislider.min.js"></script>
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <script src="assets/js/plugins/cleave.min.js"></script>
    <script src="assets/js/plugins/flatpickr.js"></script>
    <script src="assets/js/plugins/tinymce.min.js"></script>
    <script src="assets/js/vendor/ajax-form.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>


</html>