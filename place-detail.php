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



        <!-- Slider
================================================== -->
        <div class="listing-slider mfp-gallery-container margin-bottom-0">
            <a href="<?= $place->photos ?>" data-background-image="<?= $place->photos ?>" class="item mfp-gallery" title="Title 1"></a>
            <?php foreach ($place->comments as $photo) : ?>
                <?php foreach ($photo->photos as $item) : ?>
                    <a href="<?= $item->photo_url ?>" data-background-image="<?= $item->photo_url ?>" class="item mfp-gallery" title="Title 1"></a>
                <?php endforeach; ?>


            <?php endforeach; ?>

        </div>


        <!-- Content
================================================== -->
        <div class="container">
            <div class="row sticky-wrapper">
                <div class="col-lg-8 col-md-8 padding-right-30">

                    <!-- Titlebar -->
                    <div id="titlebar" class="listing-titlebar">
                        <div class="listing-titlebar-title">
                            <h2><?= $place->name ?> </h2>
                            <span>
                                <a href="#listing-location" class="listing-address">
                                    <i class="fa fa-map-marker"></i>
                                    <?= $place->city ?>
                                </a>
                            </span>
                            <div class="star-rating" data-rating="5">
                                <?php
                                // Ambil review untuk tempat tertentu menggunakan Eloquent
                                $reviews = \Models\Comment::select('comments.rating', 'comments.content')
                                    ->where('comments.place_id', $place->id)
                                    ->get();

                                if ($reviews->isNotEmpty()) : ?>
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


                                <?php endif; ?>
                                <div class="rating-counter"><a href="#listing-reviews">(<?= $totalRating ?? 0 ?> reviews)</a></div>
                            </div>
                        </div>
                    </div>


                    <!-- Overview -->
                    <div id="listing-overview" class="listing-section">

                        <!-- Description -->

                        <?= $place->description ?>

                        <div class="clearfix"></div>


                    </div>



                    <!-- Reviews -->
                    <div id="listing-reviews" class="listing-section">
                        <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>

                        <!-- Rating Overview -->
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

                        // Tampilkan nilai rata-rata
                        echo "<div class='rating-overview'>";
                        echo "<div class='rating-overview-box'>";
                        echo "<span class='rating-overview-box-total'>" . number_format($averageRating, 1) . "</span>";
                        echo "<span class='rating-overview-box-percent'>out of 5.0</span>";
                        echo "<div class='star-rating' data-rating='" . round($averageRating) . "'></div>";
                        echo "</div>";
                        echo "</div>";
                        ?>

                        <!-- Rating Overview / End -->


                        <div class="clearfix"></div>

                        <!-- Reviews -->
                        <section class="comments listing-reviews">
                            <ul>

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
                                            <li>
                                                <div class='avatar'><img src='https://ui-avatars.com/api/?name=<?= $name ?>' alt='' /></div>
                                                <div class='comment-content'>
                                                    <div class='arrow-comment'></div>
                                                    <div class='comment-by'><?= htmlspecialchars($comment->username) ?> <i class='tip' data-tip-content='Person who left this review actually was a customer'></i> <span class='date'><?= $comment->comment_date ?></span>
                                                        <div class='star-rating' data-rating='<?= $comment->rating ?>'></div>
                                                    </div>
                                                    <p><?= htmlspecialchars($comment->content) ?></p>
                                                    <?php if ($comment->photos->isNotEmpty()) : ?>
                                                        <!-- Jika ada foto-foto yang terkait, tampilkan -->
                                                        <div class='review-images mfp-gallery-container'>
                                                            <?php foreach ($comment->photos as $photo) : ?>
                                                                <a href='<?= $photo->photo_url ?>' class='mfp-gallery'><img src='<?= $photo->photo_url ?>' alt=''></a>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        No comments found for this place.
                                    <?php endif; ?>
                                <?php else : ?>
                                    Invalid place ID.
                                <?php endif; ?>





                            </ul>
                        </section>


                    </div>


                    <!-- Add Review Box -->
                    <div id="add-review" class="add-review-box">

                        <!-- Add Review -->
                        <h3 class="listing-desc-headline margin-bottom-10">Add Review</h3>
                        <p class="comment-notes">Your email address will not be published.</p>


                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <!-- Review Comment -->
                            <form id="add-comment" class="add-comment" method="POST" enctype="multipart/form-data">
                                <!-- Subrating #1 -->
                                <div class="add-sub-rating">

                                    <div class="sub-rating-stars">
                                        <!-- Leave Rating -->
                                        <div class="clearfix"></div>
                                        <class class="leave-rating">
                                            <input type="radio" name="rating" id="rating-1" value="5" />
                                            <label for="rating-1" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-2" value="4" />
                                            <label for="rating-2" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-3" value="3" />
                                            <label for="rating-3" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-4" value="2" />
                                            <label for="rating-4" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-5" value="1" />
                                            <label for="rating-5" class="fa fa-star"></label>
                                        </class>
                                    </div>
                                </div>


                                <div class="uploadButton margin-top-15">
                                    <input class="uploadButton-input" type="file" name="image[]" accept="image/*, application/pdf" id="upload" multiple />
                                    <label class="uploadButton-button ripple-effect" for="upload">Add Photos</label>
                                    <span class="uploadButton-file-name"></span>
                                </div>

                                <fieldset>
                                    <div>
                                        <label>Review:</label>
                                        <textarea name="content" cols="40" rows="3" required></textarea>
                                    </div>



                                    <!-- Tombol submit -->
                                    <button type="submit" name="submit_review" class="button">Submit Review</button>
                                    <div class="clearfix"></div>
                                </fieldset>
                            </form>
                        <?php else : ?>
                            <!-- Display when user is not logged in -->
                            <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                        <?php endif; ?>

                    </div>
                    <!-- Add Review Box / End -->


                </div>


                <!-- Sidebar
		================================================== -->
                <div class="col-lg-4 col-md-4 margin-top-75 sticky">





                    <!-- Contact -->
                    <div class="boxed-widget margin-top-35">
                        <div class="hosted-by-title">
                            <h4><span>Hosted by</span> <a href="pages-user-profile.html"><?= $place->admin ?></a></h4>
                            <a href="pages-user-profile.html" class="hosted-by-avatar"><img src="https://ui-avatars.com/api/?name=<?= $place->admin ?>" alt=""></a>
                        </div>
                        <ul class="listing-details-sidebar">
                            <li><i class="fa fa-envelope-o"></i> <a href="#"><?= $place->admin_email ?></a></li>
                        </ul>

                    </div>
                    <!-- Contact / End-->




                </div>
                <!-- Sidebar / End -->

            </div>
        </div>







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