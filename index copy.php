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



        <!-- Slider
================================================== -->

        <!-- Revolution Slider -->
        <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

            <!-- 5.0.7 auto mode -->
            <div id="rev_slider_4_1" class="rev_slider home fullwidthabanner" style="display:none;" data-version="5.0.7">
                <ul>

                    <!-- Slide  -->
                    <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                        <!-- Background -->
                        <img src="assets/images/slider-bg-01.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">

                        <!-- Caption-->
                        <div class="tp-caption custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-2" data-x="['left','left','left','left']" data-hoffset="['0','40','40','40']" data-y="['middle','middle','middle','middle']" data-voffset="['0']" data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo" data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-responsive_offset="on">

                            <!-- Caption Content -->
                            <div class="R_title margin-bottom-15" id="slide-2-layer-1" data-x="['left','center','center','center']" data-hoffset="['0','0','40','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']" data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']" data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;" data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Discover City Gems</div>

                            <div class="caption-text">Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures.</div>
                            <a href="#" class="button medium">Get Started</a>
                        </div>

                    </li>

                    <!-- Slide  -->
                    <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                        <!-- Background -->
                        <img src="assets/images/slider-bg-02.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">

                        <!-- Caption-->
                        <div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" id="slide-2-layer-2" data-x="['center','center','center','center']" data-hoffset="['0']" data-y="['middle','middle','middle','middle']" data-voffset="['0']" data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo" data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-responsive_offset="on">

                            <!-- Caption Content -->
                            <div class="R_title margin-bottom-15" id="slide-2-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']" data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']" data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;" data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Streamline Your Business</div>

                            <div class="caption-text">Proactively envisioned multimedia based on expertise cross-media growth strategies. Pontificate installed base portals after maintainable products.</div>
                            <a href="#" class="button medium">Read More</a>
                        </div>

                    </li>

                </ul>
                <div class="tp-static-layers"></div>

            </div>
        </div>
        <!-- Revolution Slider / End -->


        <!-- Content
================================================== -->

        <!-- Container -->
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="headline centered margin-bottom-35 margin-top-70">Popular Cities <span>Browse listings in popular places</span></h3>
                </div>

                <div class="col-md-4">

                    <!-- Image Box -->
                    <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="assets/images/popular-location-01.jpg">
                        <div class="img-box-content visible">
                            <h4>New York </h4>
                            <span>14 Listings</span>
                        </div>
                    </a>

                </div>

                <div class="col-md-8">

                    <!-- Image Box -->
                    <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="assets/images/popular-location-02.jpg">
                        <div class="img-box-content visible">
                            <h4>Los Angeles</h4>
                            <span>24 Listings</span>
                        </div>
                    </a>

                </div>

                <div class="col-md-8">

                    <!-- Image Box -->
                    <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="assets/images/popular-location-03.jpg">
                        <div class="img-box-content visible">
                            <h4>San Francisco </h4>
                            <span>12 Listings</span>
                        </div>
                    </a>

                </div>

                <div class="col-md-4">

                    <!-- Image Box -->
                    <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="assets/images/popular-location-04.jpg">
                        <div class="img-box-content visible">
                            <h4>Miami</h4>
                            <span>9 Listings</span>
                        </div>
                    </a>

                </div>

            </div>
        </div>
        <!-- Container / End -->



        <!-- Fullwidth Section -->
        <section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">

            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h3 class="headline centered margin-bottom-45">
                            Most Visited Places
                            <span>Discover top-rated local businesses</span>
                        </h3>
                    </div>

                    <div class="col-md-12">
                        <div class="simple-slick-carousel dots-nav">
                            <?php
                            // Menggunakan Eloquent untuk mengambil data tempat, kategori, dan pengguna yang terkait
                            $places = \Models\Place::select('places.id', 'places.name', 'places.description', 'places.city','places.photos','categories.name AS category_name', 'users.username AS admin_username')
                                ->join('categories', 'places.category_id', '=', 'categories.id')
                                ->join('users', 'places.admin_id', '=', 'users.id')
                                ->get();
                            ?>

                            <?php foreach ($places as $place) : ?>
                                <!-- Listing Item -->
                                <div class="carousel-item">
                                    <a href="place-detail.php?placeid=<?= $place->id ?>" class="listing-item-container compact">
                                        <div class="listing-item">
                                            <img src="<?=$place->photos?>" alt="">
                                            <div class="listing-item-content">
                                                <h3><?= $place->name ?> <i class="verified-icon"></i></h3>
                                                <span><?= $place->city ?></span>
                                            </div>
                                            <span class="like-icon"></span>
                                        </div>
                                    </a>
                                </div>
                                <!-- Listing Item / End -->
                            <?php endforeach ?>
                        </div>


                    </div>

                </div>
            </div>

        </section>
        <!-- Fullwidth Section / End -->






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