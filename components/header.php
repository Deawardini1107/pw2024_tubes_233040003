<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
                    <!-- <a href="index-2.html"><img src="assets/images/logo.png" alt=""></a> -->
                </div>

                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a  href="index.php">Home</a>
                            
                        <li><a  href="place.php">Place</a>
                            

                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <!-- Right Side Content / End -->
                        <div class="right-side">
                            <!-- Header Widget -->
                            <div class="header-widget">

                                <!-- User Menu -->
                                <div class="user-menu">
                                    <div class="user-name"><span><img src="https://ui-avatars.com/api/?name=<?=$_SESSION['username']?>" alt=""></span>Hi, <?=$_SESSION['username']?>!</div>
                                    <ul>
                                        <li><a href="admin/dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                                        <li><a href="auth/logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
                                    </ul>
                                </div>

                              
                            </div>
                            <!-- Header Widget / End -->
                        </div>
                        <!-- Right Side Content / End -->
                    <?php else : ?>
                        <!-- Display when user is not logged in -->
                        <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <?php include 'auth.php'; ?>
            <!-- Sign In Popup / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>