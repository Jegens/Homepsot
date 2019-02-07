<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot SignUp Page';
    require_once("../../elements/html_head.php");
?>

<!-- SIGNUP SECTION START -->
<div class="login-section text-center mx-auto">
    <div class="login-card-wrap">
        <div class="card login-card mb-5">
            <div class="card-header">
                <a href="/"><img src="/assets/images/homespot-logo.png"></a>
            </div><!-- .card-header -->

            <div class="card-body">
                <form class="login-form" action="/users/actions/login.php" method="post">
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <input class="or-btn login-submit" type="submit" name="loginSubmit" value="Log In">
                </form><!-- .signup-form -->
                <?= !empty($_SESSION['login_attempt_msg']) ? $_SESSION['login_attempt_msg'] : '' ?>
            </div><!-- .card-body -->

            <div class="card-footer">
                <span class="lg-text">Don't have an account? <strong><a class="c-text" href="/users/signup.php">Sign Up</a></strong></span>
            </div><!-- .card-footer -->
        </div><!-- .card login-card mb-5 -->
    </div><!-- .login-card-wrap -->
</div><!-- .login-section text-center mx-auto -->
<!-- SIGNUP SECTION START -->
