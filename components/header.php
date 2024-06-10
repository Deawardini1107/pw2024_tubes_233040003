<header>
    <div class="header-area header-style header-style-two header-transparent" id="header-sticky">
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="index.php">Time Travel</a>
                </div>
                <div class="header-menu">
                    <nav class="main-menu main-menu-two" id="mobile-menu">
                        <ul>
                            <li class="has-mega-menu">
                                <a href="index.php">Home</a>
                            </li>
                            <li><a href="place.php">Destination</a></li>
                            <li><a href="booking.php">Booking List</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <div class="header-action d-flex align-items-center">
                        <div class="header-btn-wrap">

                            <div class="d-flex h-gap-55">
                                <div class="">

                                    <?php if (isset($_SESSION['user_id'])) : ?>
                                        <div class="d-none d-sm-inline-flex h-gap-55">
                                            <div class="header-currency-item header-currency">
                                                <span class="header-currency-toggle" id="header-currency-toggle"><span>
                                                        <?= $_SESSION['username'] ?>
                                                    </span>
                                                    <ul>
                                                        <li><a href="admin/dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                                                        <li><a href="auth/logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
                                                    </ul>
                                            </div>
                                        </div>


                                        <!-- Right Side Content / End -->
                                    <?php else : ?>
                                        <a class="bd-btn btn-style text-btn" href="register.php">Sign Up</a>
                                        <a class="bd-btn btn-style text-btn" href="login.php">Sign in</a>

                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                        <div class="header-hamburger">
                            <div class="sidebar-toggle">
                                <a class="bar-icon" href="javascript:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <!-- for wp -->
                        <div class="header-hamburger ml-20 d-none">
                            <button type="button" class="hamburger-btn offcanvas-open-btn">
                                <span>01</span>
                                <span>01</span>
                                <span>01</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>