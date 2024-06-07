<?php
require 'Models/Database.php';
session_start();




?>

<!DOCTYPE html>

<!-- Mirrored from www.vasterad.com/themes/listeo_22/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 07:03:14 GMT -->

<head>

    <!-- Basic Page Needs
================================================== -->
    <title>Listeo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main-color.css" id="colors">

</head>

<body>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header Container
================================================== -->
        <?php require_once 'components/header.php'; ?>
        <div class="clearfix"></div>
        <!-- Header Container / End -->



        <!-- Titlebar
================================================== -->
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h2>Tempat</h2><span>Terbaik</span>

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Listings</li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


        <!-- Content
================================================== -->
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-8 padding-right-30">

                    <!-- Sorting / Layout Switcher -->
                    <div class="row margin-bottom-25">

                        <div class="col-md-6 col-xs-6">
                            <!-- Layout Switcher -->

                        </div>

                        <div class="col-md-6 col-xs-6">
                            <!-- Sort by -->
                            <div class="sort-by">
                                <?php
                                // Ambil nilai parameter 'sort' dari URL
                                $sortParam = isset($_GET['sort']) ? $_GET['sort'] : '';

                                // Tentukan opsi yang dipilih berdasarkan nilai parameter 'sort'
                                $optionDescSelected = $sortParam === 'desc' ? 'selected' : '';
                                $optionAscSelected = $sortParam === 'asc' ? 'selected' : '';
                                ?>


                            </div>


                        </div>
                    </div>
                    <!-- Sorting / Layout Switcher / End -->


                    <div class="row">


                        <?php
                        // Ambil nilai parameter 'sort' dari URL
                        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
                        $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
                        $cityFilter = isset($_GET['city']) ? $_GET['city'] : '';
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                        // Query untuk mengambil tempat dengan filter kategori dan/atau kota
                        $placesQuery = \Models\Place::select('places.id', 'places.name', 'places.photos', 'places.description', 'places.city', 'categories.name AS category_name', 'users.username AS admin_username')
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

                        <?php foreach ($places as $place) : ?>
                            <!-- Listing Item -->
                            <div class="col-lg-6 col-md-12">
                                <a href="place-detail.php?placeid=<?= $place->id ?>" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="<?= $place->photos ?>" alt="">
                                        <div class="listing-item-content">
                                            <h3><?= $place->name ?><i class="verified-icon"></i></h3>
                                            <span><?= $place->city ?></span>
                                        </div>
                                        <span class="like-icon"></span>
                                    </div>
                                    <!-- Reviews -->
                                    <?php
                                    // Ambil review untuk tempat tertentu menggunakan Eloquent
                                    $reviews = \Models\Comment::select('comments.rating', 'comments.content')
                                        ->where('comments.place_id', $place->id)
                                        ->get();

                                    if ($reviews->isNotEmpty()) : ?>
                                        <div class="reviews">

                                            <?php
                                            $totalRating = 0;
                                            $numOfReviews = 0;
                                            foreach ($reviews as $review) :
                                                $totalRating += $review->rating;
                                                $numOfReviews++;
                                            ?>

                                            <?php endforeach; ?>

                                            <!-- Hitung nilai rata-rata -->
                                            <?php $averageRating = $numOfReviews > 0 ? $totalRating / $numOfReviews : 0; ?>
                                            <div class="star-rating" data-rating="<?= $averageRating ?>">
                                                <div class="rating-counter">(<?= $totalRating ?> reviews)</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </a>
                                <!-- Reviews / End -->

                            </div>
                            <!-- Listing Item / End -->
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20 margin-bottom-40">
                                <nav class="pagination">
                                    <ul>
                                        <?php if ($currentPage > 1) : ?>
                                            <li><a href="place.php?page=<?php echo ($currentPage - 1) . '&sort=' . $sortBy . '&category=' . $categoryFilter . '&city=' . $cityFilter . '&search=' . $searchTerm; ?>"><i class="sl sl-icon-arrow-left"></i></a></li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                            <li><a href="place.php?page=<?php echo $i . '&sort=' . $sortBy . '&category=' . $categoryFilter . '&city=' . $cityFilter . '&search=' . $searchTerm; ?>" <?php echo $i == $currentPage ? 'class="current-page"' : ''; ?>><?php echo $i; ?></a></li>
                                        <?php endfor; ?>

                                        <?php if ($currentPage < $totalPages) : ?>
                                            <li><a href="place.php?page=<?php echo ($currentPage + 1) . '&sort=' . $sortBy . '&category=' . $categoryFilter . '&city=' . $cityFilter . '&search=' . $searchTerm; ?>"><i class="sl sl-icon-arrow-right"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>
                    <!-- Pagination / End -->

                </div>


                <!-- Sidebar
		================================================== -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">

                        <!-- Widget -->
                        <div class="widget margin-bottom-40">
                            <h3 class="margin-top-0 margin-bottom-30">Filters</h3>
                            <form action="place.php" method="GET">
                                <!-- Kategori -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
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

                                <!-- Kota (District) -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
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


                                <!-- Lokasi -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <div class="input-with-icon location">
                                            <div id="autocomplete-container">
                                                <input type="text" id="search-input" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                            </div>
                                            <a href="#"><i class="fa fa-map-marker"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <button id="filter-button" class="button fullwidth margin-top-25">Cari</button>
                            </form>
                        </div>
                        <!-- Widget / End -->

                    </div>
                </div>

                <!-- Sidebar / End -->
            </div>
        </div>


        <!-- Footer
================================================== -->



        <!-- Footer
================================================== -->
        <?php require_once 'components/footer.php'; ?>
        <!-- Footer / End -->


        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>


    </div>
    <!-- Wrapper / End -->



    <!-- Scripts
================================================== -->
    <script type="text/javascript" src="assets/scripts/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/scripts/jquery-migrate-3.3.2.min.js"></script>
    <script type="text/javascript" src="assets/scripts/mmenu.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chosen.min.js"></script>
    <script type="text/javascript" src="assets/scripts/slick.min.js"></script>
    <script type="text/javascript" src="assets/scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="assets/scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="assets/scripts/counterup.min.js"></script>
    <script type="text/javascript" src="assets/scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="assets/scripts/custom.js"></script>




    <!-- REVOLUTION SLIDER SCRIPT -->
    <script type="text/javascript" src="assets/scripts/themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/scripts/themepunch.revolution.min.js"></script>

    <script type="text/javascript">
        var tpj = jQuery;
        var revapi4;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_4_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_4_1");
            } else {
                revapi4 = tpj("#rev_slider_4_1").show().revolution({
                    sliderType: "standard",
                    jsFileLocation: "assets/scripts/",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "on",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style: "zeus",
                            enable: true,
                            hide_onmobile: true,
                            hide_under: 600,
                            hide_onleave: true,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            tmp: '<div class="tp-title-wrap"></div>',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 40,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 40,
                                v_offset: 0
                            }
                        },
                        bullets: {
                            enable: false,
                            hide_onmobile: true,
                            hide_under: 600,
                            style: "hermes",
                            hide_onleave: true,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            direction: "horizontal",
                            h_align: "center",
                            v_align: "bottom",
                            h_offset: 0,
                            v_offset: 32,
                            space: 5,
                            tmp: ''
                        }
                    },
                    viewPort: {
                        enable: true,
                        outof: "pause",
                        visible_area: "80%"
                    },
                    responsiveLevels: [1200, 992, 768, 480],
                    visibilityLevels: [1200, 992, 768, 480],
                    gridwidth: [1180, 1024, 778, 480],
                    gridheight: [640, 500, 400, 300],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "slidercenter",
                        speed: 2000,
                        levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 25, 47, 48, 49, 50, 51, 55],
                        type: "mouse",
                    },
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>



    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
	(Load Extensions only on Local File Systems ! 
	The following part can be removed on Server for On Demand Loading) -->
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="assets/scripts/extensions/revolution.extension.video.min.js"></script>




    <!-- Style Switcher
================================================== -->
    <?php require_once 'components/color.php'; ?>
    <!-- Style Switcher / End -->


</body>


</html>