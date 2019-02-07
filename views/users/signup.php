<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot SignUp Page';
    require_once("../../elements/html_head.php");
?>

<!-- SIGNUP SECTION START -->
<div class="signup-section text-center mx-auto">
    <div class="signup-card-wrap">
        <div class="card signup-card mb-5">
            <div class="card-header">
                <a href="/"><img src="/assets/images/homespot-logo.png"></a>
            </div><!-- .card-header -->
            
            <div class="card-body">
                <form class="signup-form" action="/users/actions/add.php" method="post">
                    <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['remember_first_name'] : '' ?>" required>
                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['remember_last_name'] : '' ?>" required>
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <input class="or-btn signup-submit" type="submit" value="Sign Up">
                </form><!-- .signup-form -->
                <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>
            </div><!-- .card-body -->

            <div class="card-footer">
                <span class="lg-text">Already have an account? <strong><a class="c-text" href="/users/login.php">Log In</a></strong></span>
            </div><!-- .card-footer -->
        </div><!-- .card signup-card mb-5 -->
    </div><!-- .signup-card-wrap -->
</div><!-- .signup-section text-center mx-auto -->
<!-- SIGNUP SECTION START -->

<!-- All Scripts -->

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/script.js?v=1.0.0<?=time()?>"></script>


</body>
</html>
