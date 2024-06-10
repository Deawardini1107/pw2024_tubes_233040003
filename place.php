<?php
require 'Models/Database.php';
session_start();

// Ambil nilai parameter 'sort' dari URL
$sortParam = isset($_GET['sort']) ? $_GET['sort'] : '';

// Tentukan opsi yang dipilih berdasarkan nilai parameter 'sort'
$optionDescSelected = $sortParam === 'desc' ? 'selected' : '';
$optionAscSelected = $sortParam === 'asc' ? 'selected' : '';


// Ambil nilai parameter 'sort' dari URL
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$cityFilter = isset($_GET['city']) ? $_GET['city'] : '';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil tempat dengan filter kategori dan/atau kota
$placesQuery = \Models\Place::select('places.id', 'places.harga', 'places.name', 'places.photos', 'places.description', 'places.city', 'categories.name AS category_name', 'users.username AS admin_username')
    ->join('categories', 'places.category_id', '=', 'categories.id')
    ->join('users', 'places.admin_id', '=', 'users.id');

// Tambahkan kondisi filter jika diperlukan
if ($categoryFilter && $categoryFilter !== 'all') {
    $placesQuery->where('places.category_id', $categoryFilter);
}
if ($cityFilter && $cityFilter !== 'all') {
    $placesQuery->where('places.city', $cityFilter);
}

// Tambahkan kondisi pencarian jika ada
if ($searchTerm) {
    $placesQuery->where(function ($query) use ($searchTerm) {
        $query->where('places.name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('places.description', 'LIKE', '%' . $searchTerm . '%');
    });
}

if ($sortBy == 'desc') {
    $placesQuery->orderBy('places.created_at', 'desc'); // Terbaru
} else {
    $placesQuery->orderBy('places.created_at', 'asc'); // Terlama
}

// Tentukan jumlah item per halaman
$itemsPerPage = 10; // Ganti dengan jumlah item per halaman yang diinginkan

// Hitung total item
$totalItems = $placesQuery->count();

// Hitung total halaman
$totalPages = ceil($totalItems / $itemsPerPage);

// Tentukan halaman saat ini
$currentPage = isset($_GET['page']) ? min(max($_GET['page'], 1), $totalPages) : 1;

// Lakukan query dengan paginasi
$places = $placesQuery->forPage($currentPage, $itemsPerPage)->get();


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
        <!-- breadcrumb area start -->
        <section class="bd-breadcrumb-area p-relative fix">
            <!-- breadcrumb background image -->
            <div class="bd-breadcrumb-bg" data-background="assets/images/bg/breadcrumb-bg.png"></div>
            <div class="bd-breadcrumb-wrapper p-relative">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="bd-breadcrumb d-flex align-items-center justify-content-center">
                                <div class="bd-breadcrumb-content text-center">
                                    <h1 class="bd-breadcrumb-title">Tour Listing Search</h1>
                                    <div class="bd-breadcrumb-list">
                                        <span><a href="index.html"><i class="icon-home"></i>Tourigo</a></span>
                                        <span>Tour Listing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- tour-listing area start -->
        <section class="bd-tour-listing-area section-space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10 col-xl-10 col-lg-11">
                        <form action="place.php" method="GET">
                            <div class="banner-search-wrapper style-two w-100 section-space-bottom">
                                <div class="banner-search-box box-shadow">
                                    <div class="banner-search-form">
                                        <div class="banner-search-field has-separator d-flex align-items-center gap-10">
                                            <div class="search-icon-bg">
                                                <span><i class="fa-regular fa-location-dot"></i></span>
                                            </div>
                                            <div class="banner-search-item banner-select">
                                                <p class="b2 mb-0 fw-5">Where to</p>
                                                <div class="banner-search-select">
                                                    <select id="category-filter" data-placeholder="All Categories" class="chosen-select" name="category">
                                                        <option value="" <?php echo (isset($_GET['category']) && $_GET['category'] == 'all') ? 'selected' : ''; ?>>All Categories</option>
                                                        <?php
                                                        // Loop untuk menampilkan opsi kategori
                                                        $categories = \Models\Category::all();
                                                        foreach ($categories as $category) {
                                                            echo "<option value='" . $category->id . "' " . ((isset($_GET['category']) && $_GET['category'] == $category->id) ? 'selected' : '') . ">" . $category->name . "</option>";
                                                        }
                                                        ?>
                                                    </select>
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
                                                    <select id="city-filter" data-placeholder="All Cities" class="chosen-select" name="city">
                                                        <option value="all" <?php echo (isset($_GET['city']) && $_GET['city'] == 'all') ? 'selected' : ''; ?>>All Cities</option>
                                                        <?php
                                                        $categories = \Models\Category::all();
                                                        // Loop untuk menampilkan opsi kota
                                                        $cities = \Models\Place::distinct()->pluck('city');
                                                        foreach ($cities as $city) {
                                                            echo "<option value='" . $city . "' " . ((isset($_GET['city']) && $_GET['city'] == $city) ? 'selected' : '') . ">" . $city . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-search-field d-flex align-items-center gap-10">


                                            <span><i class="fa-regular fa-location-dot"></i></span>

                                            <input type="text" id="search-input" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">


                                        </div>
                                    </div>
                                    <div class="banner-search-button">
                                        <button type="submit" class="banner-btn banner-square-btn bd-btn btn-style radius-10"><span>
                                                <i class="fa-regular fa-magnifying-glass"></i></span> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row gy-24">
                    <?php foreach ($places as $place) : ?>
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
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
                                            <span><a href="place-detail.php?placeid=<?= $place->id ?>"><i class="fa-regular fa-location-dot"></i>
                                                    <?= $place->city ?></a></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $averageRating = 0;
                                $numOfReviews=0;
                                $totalRating = 0;
                                // Ambil review untuk tempat tertentu menggunakan Eloquent
                                $reviews = \Models\Comment::select('comments.rating', 'comments.content')
                                    ->where('comments.place_id', $place->id)
                                    ->get();

                                if ($reviews->isNotEmpty()) :
                                    $totalRating = 0;
                                    $numOfReviews = 0;
                                    foreach ($reviews as $review) :
                                        $totalRating += $review->rating;
                                        $numOfReviews++;
                                    endforeach;

                                    // Hitung nilai rata-rata
                                    $averageRating = $numOfReviews > 0 ? $totalRating / $numOfReviews : 0;
                                ?>
                                   
                                <?php endif; ?>

                                <div class="tour-content">
                                    <div class="tour-rating d-flex align-items-center gap-10 mb-10">
                                        <div class="tour-rating-icon fs-14 d-flex rating-color">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="tour-rating-text">
                                            <span><?= round($averageRating,1) ?> (<?= $totalRating ?> Ratings)</span>
                                        </div>
                                    </div>
                                    <h5 class="tour-title fw-5 underline mb-5"><a href="place-detail.php?placeid=<?= $place->id ?>"><?= $place->name ?></a></h5>
                                    <span class="tour-price b3"><?= number_format($place->harga, 0) ?></span>
                                    <div class="tour-divider"></div>

                                    <div class="tour-meta d-flex align-items-center justify-content-between">
                                        
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
                    <?php endforeach; ?>
                </div>
                <div class="pagination-wrapper d-flex justify-content-center">
                    <div class="basic-pagination">
                        <nav>
                            <ul>
                                <li>
                                    <a class="current">1</a>
                                </li>
                                <li>
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">3</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-light fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- tour-listing area end -->

        <!-- cta area start -->
        <section class="bd-cta-area section-space-small cta-image-bg image-bg p-relative fix" data-background="assets/images/cta/cta-img-3.png">
            <div class="container">
                <div class="cta-three-shape">
                    <div class="cta-three-shape-one p-absolute">
                        <img src="assets/images/shapes/cta-star.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-two p-absolute">
                        <img src="assets/images/shapes/cta-eye.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-three p-absolute">
                        <img src="assets/images/shapes/cta-x.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-four p-absolute">
                        <img src="assets/images/shapes/cta-star.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-five p-absolute">
                        <img src="assets/images/shapes/cta-eye.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-six p-absolute">
                        <img src="assets/images/shapes/cta-x.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-seven p-absolute">
                        <img src="assets/images/shapes/cta-line.png" alt="shape">
                    </div>
                    <div class="cta-three-shape-eight p-absolute">
                        <img src="assets/images/shapes/plane-6.png" alt="shape">
                    </div>
                </div>
                <div class="row gy-24 align-items-center justify-content-center">
                    <div class="col-xl-6 col-md-8">
                        <div class="cta-content-wrapper cta-style-three text-center position-relative z-index-5">
                            <span class="section-subtitle color-warning mb-15">Find New Places To Visit</span>
                            <h2 class="section-title white-text mb-20">Explore New Places</h2>
                            <p>Share the core values and principles that drive your company. <br> Emphasize a commitment
                                to custome.
                            </p>
                            <div class="cta-btn">
                                <a href="place.php" class="bd-primary-btn btn-style has-arrow is-bg btn-tertiary is-white radius-60">
                                    <span class="bd-primary-btn-arrow arrow-right"><i class="fa-regular fa-arrow-right"></i></span>
                                    <span class="bd-primary-btn-text">Explore Now</span>
                                    <span class="bd-primary-btn-circle"></span>
                                    <span class="bd-primary-btn-arrow arrow-left"><i class="fa-regular fa-arrow-right"></i></span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta area end -->

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