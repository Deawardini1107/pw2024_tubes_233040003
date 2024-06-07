<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <div class="sign-in-form style-1">
        <ul class="tabs-nav">
            <li class="active"><a href="#tab1">Log In</a></li>
            <li><a href="#tab2">Register</a></li>
        </ul>
        <div class="tabs-container alt">
            <!-- Login Tab Content -->
            <div class="tab-content" id="tab1" style="display: none;">
                <form method="post" class="login" action="auth/login.php">
                    <p class="form-row form-row-wide">
                        <label for="email">Email Address:
                            <i class="im im-icon-Mail"></i>
                            <input type="email" class="input-text" name="email" id="email" value="" required />
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">Password:
                            <i class="im im-icon-Lock-2"></i>
                            <input type="password" class="input-text" name="password" id="password" required />
                        </label>
                        <span class="lost_password">
                            <a href="#">Lost Your Password?</a>
                        </span>
                    </p>
                    <div class="form-row">
                        <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                        <div class="checkboxes margin-top-10">
                            <input id="remember-me" type="checkbox" name="check">
                            <label for="remember-me">Remember Me</label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Register Tab Content -->
            <div class="tab-content" id="tab2" style="display: none;">
                <form method="post" class="register" action="auth/register.php">
                    <p class="form-row form-row-wide">
                        <label for="email2">Nama Lengkap:
                            <i class="im im-icon-Mail"></i>
                            <input type="text" class="input-text" name="username" id="username" required />
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="email2">Email Address:
                            <i class="im im-icon-Mail"></i>
                            <input type="email" class="input-text" name="email" id="email2" required />
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Password:
                            <i class="im im-icon-Lock-2"></i>
                            <input type="password" class="input-text" name="password1" id="password1" required />
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password2">Repeat Password:
                            <i class="im im-icon-Lock-2"></i>
                            <input type="password" class="input-text" name="password2" id="password2" required />
                        </label>
                    </p>
                    <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                </form>
            </div>
        </div>
    </div>
</div>