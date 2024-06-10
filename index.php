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
    <main class="main-area fix">

        <!-- Banner area start -->
        <section class="banner-area banner-height p-relative z-index-11 image-bg" data-background="assets/images/bg/banner-bg.png">
            <div class="banner-shape">
                <div class="banner-shape-one">
                    <img src="assets/images/shapes/circle-bg.png" alt="image">
                </div>
                <div class="banner-shape-two">
                    <img src="assets/images/shapes/sky.png" alt="image">
                </div>
                <div class="banner-shape-three">
                    <img src="assets/images/shapes/circle.png" alt="image">
                </div>
                <div class="banner-shape-four">
                    <img src="assets/images/shapes/circle-bg2.png" alt="image">
                </div>
                <div class="banner-shape-five">
                    <img src="assets/images/shapes/half-circle.png" alt="image">
                </div>
                <div class="banner-shape-six">
                    <img src="assets/images/shapes/plane.png" alt="image">
                </div>
                <div class="banner-shape-seven">
                    <img src="assets/images/shapes/plane-line.png" alt="image">
                </div>
                <div class="banner-shape-eight">
                    <img src="assets/images/shapes/dot-square.png" alt="image">
                </div>
            </div>
            <div class="swiper banner__active overflow-visible p-relative">
                <div class="swiper-wrapper">
                    <div class="swiper-slide banner_more_item">
                        <div class="container">
                            <div class="row gy-24 align-items-center justify-content-between">
                                <div class="col-xxl-7 col-xl-6 col-lg-6">
                                    <div class="mt-50">
                                        <div class="banner-content p-relative wow bdFadeInLeft" data-wow-delay=".2s">
                                            <span class="section-subtitle mb-25 wow bdFadeInLeft" data-wow-delay=".3s">Discover Bandung</span>
                                            <h1 class="banner-title wow bdFadeInLeft" data-wow-delay=".4s">Explore the Hidden Gems <span class="yellow-shape">of Bandung <img src="assets/images/shapes/yellow-shape.png" alt="yellow-shape"></span></h1>
                                        </div>
                                        <div class="banner-search-wrapper mt-45 wow bdFadeIn" data-wow-delay=".5s">
                                            <div class="banner-search-box">
                                                <div class="banner-search-form">
                                                    <div class="banner-search-field has-separator d-flex align-items-center gap-10">
                                                        <div class="search-icon-bg">
                                                            <span><i class="fa-regular fa-location-dot"></i></span>
                                                        </div>
                                                        <div class="banner-search-item banner-select">
                                                            <p class="b2 mb-0 fw-5">Where to</p>
                                                            <div class="banner-search-select">
                                                                <select name="location" id="location">
                                                                    <option>Search location</option>
                                                                    <option>Kawah Putih</option>
                                                                    <option>Tangkuban Perahu</option>
                                                                    <option>Dusun Bambu</option>
                                                                    <option>Farmhouse Susu Lembang</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="banner-search-field has-separator d-flex align-items-center gap-10">
                                                        <div class="search-icon-bg">
                                                            <span><i class="icon-cleander"></i></span>
                                                        </div>
                                                        <div class="banner-search-item">
                                                            <p class="b2 mb-0 fw-5">Duration</p>
                                                            <div class="banner-form-input">
                                                                <input class="form-control" id="selectingMultipleDates" type="text" placeholder="Select Your date" readonly="readonly">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="banner-search-field d-flex align-items-center gap-10">
                                                        <div class="search-icon-bg">
                                                            <span><i class="fa-regular fa-location-dot"></i></span>
                                                        </div>
                                                        <div class="banner-search-item banner-select">
                                                            <p class="b2 mb-0 fw-5">Tour Types</p>
                                                            <div class="banner-search-select">
                                                                <select>
                                                                    <option>Adventure</option>
                                                                    <option>Nature</option>
                                                                    <option>Family</option>
                                                                    <option>Culture</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="banner-search-button">
                                                    <button type="submit" class="banner-btn banner-square-btn bd-btn btn-style radius-10"><span>
                                                            <i class="fa-regular fa-magnifying-glass"></i></span> Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-5 col-xl-6 col-lg-6">
                                    <div class="banner-thumb-wrapper position-relative wow bdFadeInRight" data-wow-delay=".3s">
                                        <div class="banner-thumb-one wow bdFadeInRight" data-wow-delay=".4s">
                                            <img src="assets/images/banner/wisata bandung-20230526015236.webp" alt="image">
                                        </div>
                                        <div class="banner-thumb-two wow bdFadeInRight" data-wow-delay=".5s">
                                            <img src="assets/images/banner/59ea56106b9816b491f322a2157d119f.webp" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-nav-btn banner-one-navigation d-none">
                    <div class="banner-pagination">
                        <div class="swiper-pagination bd-pagination justify-content-center"></div>
                    </div>
                    <div class="banner-navigation-btn">
                        <button class="tourigo-navigation-prev"><i class="fa-regular fa-angle-left"></i></button>
                        <button class="tourigo-navigation-next"><i class="fa-regular fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner area start -->




        <!-- about area Start -->
        <section class="bd-about-area section-space about-bg p-relative image-bg">
            <div class="container">
                <div class="about-shape">
                    <div class="about-shape-one">
                        <img src="assets/images/shapes/stone.png" alt="shape">
                    </div>
                    <div class="about-shape-two">
                        <img src="assets/images/shapes/circle.png" alt="shape">
                    </div>
                    <div class="about-shape-three">
                        <img src="assets/images/shapes/plane-3.png" alt="shape">
                    </div>
                    <div class="about-shape-four">
                        <img src="assets/images/shapes/camera-2.png" alt="shape">
                    </div>
                </div>
                <div class="row gy-24 align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-thumb-wrap about-style">
                            <div class="about-thumb-one wow img-custom-anim-left">
                                <img src="assets/images/banner/606ccdec4dc98 (1).png" alt="image">
                            </div>
                            <div class="about-thumb-two wow img-custom-anim-right image-hover-effect">
                                <img src="assets/images/banner/wisata-sejuk-bandung-601263368.webp" alt="image">
                            </div>
                           
                            <div class="about-badge">
                                <img src="assets/images/shapes/white-badge.png" alt="shape">
                                <div class="about-badge-text">
                                    <span class="number">30%</span>
                                    <span>Discount</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-content">
                            <div class="section-title-wrapper mb-35">
                                <span class="section-subtitle mb-15">About Bandung</span>
                                <h2 class="section-title mb-20">Discover the Charm of Bandung</h2>
                                <p>Bandung, the capital city of West Java, is known for its vibrant culture, beautiful landscapes, and cool climate. Often referred to as the "Paris of Java," Bandung is a popular destination for both local and international tourists.</p>
                            </div>
                            <div class="about-feature-list">
                                <ul>
                                    <li>
                                        <span class="list-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <p>Explore the rich history and colonial architecture of Bandung.</p>
                                    </li>
                                    <li>
                                        <span class="list-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <p>Enjoy the stunning natural attractions such as Tangkuban Perahu and Kawah Putih.</p>
                                    </li>
                                    <li>
                                        <span class="list-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <p>Experience the diverse culinary scene and vibrant shopping destinations.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="about-btn-wrap">
                                <div class="about-btn">
                                    <a href="contact.html" class="bd-primary-btn btn-style has-arrow is-bg radius-60">
                                        <span class="bd-primary-btn-arrow arrow-right"><i class="fa-regular fa-arrow-right"></i></span>
                                        <span class="bd-primary-btn-text">Know More</span>
                                        <span class="bd-primary-btn-circle"></span>
                                        <span class="bd-primary-btn-arrow arrow-left"><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </div>
                                <div class="about-call">
                                    <span><i class="icon-support"></i></span>
                                    <a class="fw-5" href="tel:0855554123">0855554123</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end -->


        <!-- tour area start -->
        <section class="bd-tour-area section-space">
            <div class="container">
                <div class="row gy-24 align-items-center justify-content-between section-title-space">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-title-wrapper">
                            <span class="section-subtitle mb-10">Our Trips</span>
                            <h2 class="section-title">Feature Packages</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="bd-tour-btn text-md-end">
                            <a href="place.php" class="bd-primary-btn btn-style has-arrow radius-60">
                                <span class="bd-primary-btn-arrow arrow-right"><i class="fa-regular fa-arrow-right"></i></span>
                                <span class="bd-primary-btn-text">More Packages</span>
                                <span class="bd-primary-btn-circle"></span>
                                <span class="bd-primary-btn-arrow arrow-left"><i class="fa-regular fa-arrow-right"></i></span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 wow bdFadeInUp">
                        <div class="tour-slide-wrapper p-relative">
                            <div class="swiper tour__active">
                                <div class="swiper-wrapper">

                                    <?php
                                    // Menggunakan Eloquent untuk mengambil data tempat, kategori, dan pengguna yang terkait
                                    $places = \Models\Place::select('places.id', 'places.name', 'places.description', 'places.city', 'places.photos', 'categories.name AS category_name', 'users.username AS admin_username')
                                        ->join('categories', 'places.category_id', '=', 'categories.id')
                                        ->join('users', 'places.admin_id', '=', 'users.id')
                                        ->get();
                                    ?>
                                    <?php foreach ($places as $place) : ?>
                                        <?php
                                        // Ambil komentar untuk tempat tertentu menggunakan Eloquent
                                        $comments = \Models\Comment::select('comments.rating')
                                            ->where('comments.place_id', $place->id)
                                            ->get();

                                        $totalRating = 0;
                                        $numOfReviews = $comments->count();

                                        // Jumlahkan semua peringkat
                                        foreach ($comments as $comment) {
                                            $totalRating += $comment->rating;
                                        }

                                        // Hitung nilai rata-rata
                                        $averageRating = $numOfReviews > 0 ? $totalRating / $numOfReviews : 0;

                                      
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="tour-wrapper style-one">
                                                <div class="p-relative">
                                                    <div class="tour-thumb image-overly">
                                                        <a href="place-detail.php?placeid=<?= $place->id ?>"><img src="<?= $place->photos ?>" alt="image"></a>
                                                    </div>
                                                    <div class="tour-meta d-flex align-items-center justify-content-between">
                                                        <button class="tour-favorite tour-like">
                                                            <i class="icon-heart"></i>
                                                        </button>
                                                        <div class="tour-location">
                                                            <span><a href="place-detail.php?placeid=<?= $place->id ?>"><i class="fa-regular fa-location-dot"></i><?= $place->city ?></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tour-content">
                                                    <div class="tour-rating d-flex flex-wrap align-items-center gap-10 mb-10">
                                                        <div class="tour-rating-icon fs-14 d-flex rating-color">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="tour-rating-text">
                                                            <span><?= round($averageRating)?> (<?=number_format($averageRating, 1)?> Ratings)</span>
                                                        </div>
                                                    </div>
                                                    <h5 class="tour-title fw-5 underline mb-5"><a href="place-detail.php?placeid=<?= $place->id ?>"><?= $place->city ?></a></h5>
                                                    <span class="tour-price b3"><?= number_format($place->harga,0) ?></span>
                                                    <div class="tour-divider"></div>

                                                    <div class="tour-meta d-flex align-items-center justify-content-between">
                                                        <div class="time d-flex align-items-center gap--5">
                                                            <i class="icon-heart"></i>
                                                            <span>5 days</span>
                                                        </div>
                                                        <div class="tour-btn">
                                                            <button class="bd-text-btn style-two" type="button" data-bs-toggle="modal" data-bs-target="#popUpBookingForm">Book Now
                                                                <span class="icon__box">
                                                                    <i class="fa-regular fa-arrow-right-long icon__first"></i>
                                                                    <i class="fa-regular fa-arrow-right-long icon__second"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>


                                </div>
                                <div class="slider-pagination-wrapper">
                                    <div class="slider-pagination bd-pagination mt-50 justify-content-center"></div>
                                </div>
                            </div>
                            <div class="tour-navigation btn-navigation d-none d-xxl-block">
                                <button class="tourigo-navigation-prev"><i class="fa-regular fa-angle-left"></i></button>
                                <button class="tourigo-navigation-next"><i class="fa-regular fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- tour area end -->

        <!-- offer area start -->
        <section class="bd-offer-area section-space-bottom">
            <div class="container">
                <div class="row gy-24">
                    <div class="col-xl-6 col-lg-6 col-md-12 wow bdFadeInLeft">
                        <div class="offer-wrapper p-relative offer-thumb-bg image-bg" data-background="assets/images/banner/grafika-cikole-lembang_169.jpeg">
                            <div class="offer-content-wrap">
                                <div class="offer-content">
                                    <div class="section-title-wrapper mb-30">
                                        <span class="section-subtitle color-warning mb-15">Explore Bandung</span>
                                        <h2 class="section-title small white-text mb-20">Special Offer: <br> Buy 1 Tour Package, Get 1 Free!</h2>
                                        <p>Discover the beauty and charm of Bandung with our exclusive tour packages.</p>
                                    </div>
                                    <div class="offer-btn">
                                        <a href="booking.php" class="bd-primary-btn btn-style has-arrow is-bg btn-tertiary is-white radius-60">
                                            <span class="bd-primary-btn-arrow arrow-right"><i class="fa-regular fa-arrow-right"></i></span>
                                            <span class="bd-primary-btn-text">Book Now</span>
                                            <span class="bd-primary-btn-circle"></span>
                                            <span class="bd-primary-btn-arrow arrow-left"><i class="fa-regular fa-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 wow bdFadeInRight">
                        <div class="offer-wrapper p-relative offer-thumb-bg style-two image-bg" data-background="assets/images/banner/6-Tempat-Wisata-Hits-di-Kabupaten-Bandung-1280x720.webp">
                            <div class="offer-content-wrap left-content">
                                <div class="offer-content">
                                    <div class="section-title-wrapper mb-30">
                                        <span class="section-subtitle color-warning mb-15">Explore Bandung</span>
                                        <h2 class="section-title small white-text mb-20">Ultimate Adventure Awaits in Bandung!</h2>
                                        <p>Join us for an unforgettable adventure in the heart of West Java. Experience the culture, nature, and excitement of Bandung.</p>
                                    </div>
                                    <div class="offer-btn">
                                        <a href="booking.php" class="bd-primary-btn btn-style has-arrow is-bg btn-tertiary is-white radius-60">
                                            <span class="bd-primary-btn-arrow arrow-right"><i class="fa-regular fa-arrow-right"></i></span>
                                            <span class="bd-primary-btn-text">Book Now</span>
                                            <span class="bd-primary-btn-circle"></span>
                                            <span class="bd-primary-btn-arrow arrow-left"><i class="fa-regular fa-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- offer area end -->

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