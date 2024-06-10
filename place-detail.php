<?php
session_start();
require_once 'Models/Database.php';

use Models\Place;
use Models\Category;
use Models\User;

$placeId = isset($_GET['placeid']) ? intval($_GET['placeid']) : 0;
if ($placeId > 0) {
    // Ambil data tempat berdasarkan ID menggunakan Eloquent
    $place = Place::with('comments.photos')->select('places.id', 'places.name', 'places.description', 'places.city', 'places.photos', 'categories.name as category', 'users.username as admin', 'users.email as admin_email')
        ->join('categories', 'places.category_id', '=', 'categories.id')
        ->join('users', 'places.admin_id', '=', 'users.id')
        ->where('places.id', $placeId)
        ->first();
    if (!$place) {
        echo "Invalid place ID.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
        // Tangkap data dari formulir
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $rating = $_POST['rating'];
        $content = $_POST['content'];

        // File upload
        $targetDir = "uploads/";
        $uploadedFiles = array();
        $uploadOk = 1;

        // Loop melalui setiap file yang diunggah jika ada
        if (!empty($_FILES['image']['name'][0])) {
            $fileCount = count($_FILES['image']['name']);

            // Batasi jumlah file yang diunggah
            $maxFiles = 5;

            if ($fileCount > $maxFiles) {
                echo "Sorry, you can upload maximum $maxFiles files at once.";
                $uploadOk = 0;
            }

            // Loop melalui setiap file yang diunggah
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['image']['name'][$i];
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                $randomName = uniqid() . '.' . $extension;
                $targetFilePath = $targetDir . $randomName;

                // Periksa apakah file sudah ada
                if (file_exists($targetFilePath)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Batasi ukuran file
                if ($_FILES['image']['size'][$i] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Hanya izinkan format file tertentu
                $allowedExtensions = array("jpg", "jpeg", "png", "gif");
                if (!in_array($extension, $allowedExtensions)) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Periksa apakah $uploadOk diatur menjadi 0 oleh kesalahan
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $targetFilePath)) {
                        echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
                        // Simpan jalur gambar ke dalam array
                        $uploadedFiles[] = $targetFilePath;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        // Simpan ulasan ke database jika tidak ada file yang diunggah atau jika semua file berhasil diunggah
        if ($uploadOk == 1 || count($uploadedFiles) > 0) {
            $comment = new \Models\Comment();
            $comment->content = $content;
            $comment->place_id = $placeId; // Jika perlu
            $comment->user_id = $_SESSION['user_id']; // Jika perlu
            $comment->rating = $rating;
            $comment->save();

            // Simpan jalur gambar ke dalam tabel photos
            foreach ($uploadedFiles as $filePath) {
                $photo = new \Models\Photo();
                $photo->photo_url = $filePath;
                $photo->comment_id = $comment->id;
                $photo->save();
            }
        }
    }
} else {
    echo "Invalid place ID.";
    exit();
}
?>

<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home One || Tour & Travel HTML Template</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <h1 class="bd-breadcrumb-title">Destinations Details Right</h1>
                                    <div class="bd-breadcrumb-list">
                                        <span><a href="index.html"><i class="icon-home"></i>Time Travel</a></span>
                                        <span>Destinations Details Right</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- destinations-details area start -->
        <section class="bd-destinations-details-area section-space">
            <div class="container">

                <div class="row gy-24">
                    <div class="col-xxl-8 col-xl-8 col-lg-7">
                        <div class="destinations-details-wrapper">
                            <div class="destinations-details mb-25">
                                <div class="destinations-details-slider details-slide p-relative mb-30">
                                    <div class="swiper details-slide-activation">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="<?= $place->photos ?>" alt="image">
                                            </div>
                                            <?php foreach ($place->comments as $photo) : ?>
                                                <?php foreach ($photo->photos as $item) : ?>
                                                    <div class="swiper-slide">
                                                        <img src="<?= $item->photo_url ?>" alt="image">
                                                    </div>
                                                    <a href="" data-background-image="<?= $item->photo_url ?>" class="item mfp-gallery" title="Title 1"></a>
                                                <?php endforeach; ?>


                                            <?php endforeach; ?>


                                        </div>
                                    </div>
                                    <div class="details-slide-navigation btn-navigation">
                                        <button class="tourigo-navigation-prev"><i class="fa-regular fa-angle-left"></i></button>
                                        <button class="tourigo-navigation-next"><i class="fa-regular fa-angle-right"></i></button>
                                    </div>
                                </div>
                                <div class="destinations-details-content">
                                    <h3 class="destinations-details-title mb-15"><?= $place->name ?>
                                    </h3>
                                    <p class="mb-15"><?= $place->description ?></p>

                                </div>
                                <div class="section-divider mt-30 mb-25"></div>

                            </div>
                            <div class="tour-details-rating-wrapper">
                                <h3>Reviews <span>(12)</span></h3>

                                <!-- Rating Overview -->
                                <div class="my-3">
                                    <?php
                                    // Ambil komentar untuk tempat tertentu menggunakan Eloquent
                                    $comments = \Models\Comment::select('comments.rating')
                                        ->where('comments.place_id', $placeId)
                                        ->get();

                                    $totalRating = 0;
                                    $numOfReviews = $comments->count();

                                    // Jumlahkan semua peringkat
                                    foreach ($comments as $comment) {
                                        $totalRating += $comment->rating;
                                    }

                                    // Hitung nilai rata-rata
                                    $averageRating = $numOfReviews > 0 ? $totalRating / $numOfReviews : 0;

                                    // Konversi rata-rata menjadi bintang
                                    $stars = round($averageRating);
                                    ?>

                                    <div class="rating">
                                        <?php for ($i = 0; $i < $stars; $i++) : ?>
                                            <i class="fa fa-star"></i>
                                        <?php endfor; ?>
                                        <span>(<?= number_format($averageRating, 1) ?> out of 5)</span>
                                    </div>

                                </div>
                                <style>
                                    .review-images {
                                        display: flex;
                                        /* Menyusun gambar secara horizontal */
                                        flex-wrap: wrap;
                                        /* Izinkan gambar untuk pindah ke baris berikutnya jika ruang tidak cukup */
                                        gap: 10px;
                                        /* Memberi jarak antar gambar */
                                    }

                                    .review-images a {
                                        width: 50px;
                                        /* Lebar maksimal tautan untuk gambar */
                                        flex: 1 1 auto;
                                        /* Fleksibilitas tata letak gambar */
                                    }

                                    .review-images img {
                                        width: 100px;
                                        /* Gambar menyesuaikan lebar tautan */
                                        height: auto;
                                        /* Tinggi gambar otomatis menyesuaikan */
                                        border-radius: 4px;
                                        /* Memberikan sudut membulat pada gambar */
                                    }
                                </style>
                                <div class="rewiew-content">
                                    <?php if ($placeId > 0) : ?>
                                        <?php
                                        // Ambil komentar untuk tempat tertentu menggunakan Eloquent dengan foto-foto terkait
                                        $comments = \Models\Comment::with('photos')
                                            ->select('comments.id', 'comments.content', 'users.username', 'users.email', 'comments.created_at as comment_date', 'comments.rating')
                                            ->join('users', 'comments.user_id', '=', 'users.id')
                                            ->where('comments.place_id', $placeId)
                                            ->get();
                                        ?>

                                        <?php if ($comments->isNotEmpty()) : ?>
                                            <?php foreach ($comments as $comment) : ?>
                                                <?php
                                                $hash = md5(strtolower(trim($comment->email)));
                                                $name = urlencode($comment->username);
                                                ?>
                                                <div class="tour-review-wrapper">
                                                    <div class="media">
                                                        <div class="thumbnail">
                                                            <a href="#">
                                                                <img src="https://ui-avatars.com/api/?name=<?= $name ?>" alt="Author Images">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="author-info">
                                                                <h5 class="title">
                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                        <?= htmlspecialchars($comment->username) ?>
                                                                    </a>
                                                                    <a href="#">
                                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                                    </a>
                                                                </h5>
                                                                <ul class="bd-meta">
                                                                    <li class="has-seperator">On: <span>Aug 11, 2023</span></li>
                                                                    <li>
                                                                        <div class="rating">
                                                                            <?php foreach (range(1, $comment->rating) as $i) : ?>
                                                                                <a href="#"><i class="fa fa-star"></i></a>
                                                                            <?php endforeach; ?>


                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="content">
                                                                <p class="description"><?= $comment->content ?></p>
                                                                <?php if ($comment->photos->isNotEmpty()) : ?>
                                                                    <!-- Jika ada foto-foto yang terkait, tampilkan -->
                                                                    <div class='review-images mfp-gallery-container'>
                                                                        <?php foreach ($comment->photos as $photo) : ?>
                                                                            <a href='<?= $photo->photo_url ?>' class='mfp-gallery'><img src='<?= $photo->photo_url ?>' alt=''></a>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            No comments found for this place.
                                        <?php endif; ?>
                                    <?php else : ?>
                                        Invalid place ID.
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="post-comment-form">
                                <div class="post-comments-title">
                                    <h4 class="mb-15">Leave a Comment</h4>
                                    <span class="d-block mb-25">Your email address will not be published. Required
                                        fields are
                                        marked *</span>
                                </div>
                                <?php if (isset($_SESSION['user_id'])) : ?>
                                    <!-- Review Comment Form -->
                                    <form id="add-comment" class="add-comment" method="POST" enctype="multipart/form-data">
                                        <!-- Subrating #1 -->
                                        <div class="mb-3">
                                            <!-- Leave Rating -->
                                            <div>
                                                <span class="mb-2 d-block">Your Rating:</span>
                                                <div class="star-rating">
                                                    <input class="btn-check" type="radio" name="rating" id="rating-5" value="5" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="rating-5"><i class="fa fa-star"></i></label>

                                                    <input class="btn-check" type="radio" name="rating" id="rating-4" value="4" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="rating-4"><i class="fa fa-star"></i></label>

                                                    <input class="btn-check" type="radio" name="rating" id="rating-3" value="3" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="rating-3"><i class="fa fa-star"></i></label>

                                                    <input class="btn-check" type="radio" name="rating" id="rating-2" value="2" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="rating-2"><i class="fa fa-star"></i></label>

                                                    <input class="btn-check" type="radio" name="rating" id="rating-1" value="1" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="rating-1"><i class="fa fa-star"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload Button -->
                                        <div class="mb-3">
                                            <label for="upload" class="form-label">Add Photos</label>
                                            <input class="form-control" type="file" name="image[]" accept="image/*, application/pdf" id="upload" multiple>
                                        </div>

                                        <!-- Review Text Area -->
                                        <div class="mb-3">
                                            <label for="review-textarea" class="form-label">Review:</label>
                                            <textarea class="form-control" name="content" id="review-textarea" cols="40" rows="3" required></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
                                    </form>
                                <?php else : ?>
                                    <!-- Display when user is not logged in -->
                                    <a href="#sign-in-dialog" class="btn btn-primary sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-5">
                        <aside class="sidebar-wrapper sidebar-sticky">
                            <div class="sidebar-widget-wrapper mb-30">

                                <div class="sidebar-widget widget">
                                    <h6 class="sidebar-widget-title small mb-15"> Booking NOW !!!</h6>
                                    <div class="sidebar-booking">
                                        <form class="sidebar- booking-form" action="Booking_Store.php" method="post">
                                            
                                            <br>
                                            <div class="banner-search-field has-separator d-flex align-items-center gap-10">
                                                <div class="search-icon-bg">
                                                    <span><i class="icon-cleander"></i></span>
                                                </div>
                                                <div class="banner-search-item">
                                                    <input type="hidden" name="place_id" value="<?=$placeId?>">
                                                    <div class="banner-form-input">
                                                        <input name="start_date" class="form-control flatpickr-input" id="selectingMultipleDates" type="hidden" placeholder="Select Your date" readonly="readonly">
                                                        <input name="end_date" class="form-control input" placeholder="Select Your date" tabindex="0" type="text" readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="booking-btn">
                                                <button type="submit" class="bd-btn btn-style radius-4 w-100">Send Now<span><i class="fa-regular fa-arrow-right"></i></span></button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="sidebar-widget-divider"></div>

                            </div>
                            <div class="sidebar-widget-banner p-relative">
                                <div class="sidebar-widget-thumb p-relative">
                                    <img src="assets/images/bg/sidebar-img.png" alt="img">
                                </div>
                                <div class="sidebar-widget-content">
                                    <span class="bd-play-btn pulse-white mb-40"><i class="icon-call-ring"></i></span>
                                    <p class="b3 mb-0">Free Call</p>
                                    <h5 class="mb-25"><a href="tel:+0290848020">02 (908) 480-20</a></h5>
                                    <div class="sidebar-btn">
                                        <a class="bd-text-btn style-two" href="blog-list-right.html">Contact
                                            <span class="icon__box">
                                                <i class="fa-light fa-angle-right icon__first"></i>
                                                <i class="fa-light fa-angle-right icon__second"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- destinations-details area end -->

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