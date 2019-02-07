<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div id="navWrap" class="container mx-auto">
        <a class="navbar-brand img-responsive" href="/"><img src="/assets/images/homespot-logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto float-right text-right">

                <?php
                // Check if user is logged in - Show profile links
                if( $_SESSION['user_logged_in'] ){

                    $u = new User;
                    $user = $u->get_by_id($_SESSION['user_logged_in']);
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listings</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/listings/index.php">View All</a>
                            <a class="dropdown-item" href="/listings/favourites.php">View Favourites</a>
                            <a class="dropdown-item" href="/listings/create.php">Create New</a>
                            <a class="dropdown-item" href="/listings/manage.php">Manage Existing</a>
                        </div><!-- .dropdown-menu -->
                    </li>
                <?php }else{ // User not logged in ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/listings/index.php">Listings</a>
                    </li>
                <?php } ?>

                <?php
                // Check if user is logged in - Show profile links
                    if( $_SESSION['user_logged_in'] ){

                        $u = new User;
                        $user = $u->get_by_id($_SESSION['user_logged_in']);
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Realtors</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/users/index.php">View All</a>
                            <a class="dropdown-item" href="/users/edit.php">Edit Profile</a>
                        </div><!-- .dropdown-menu -->
                    </li>
                <?php }else{ // User not logged in ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/index.php">Realtors</a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="#">Mortgage Calculator</a>
                </li>

                <?php
                // Check if user is logged in - Show profile links
                if( $_SESSION['user_logged_in'] ){

                    $u = new User;
                    $user = $u->get_by_id($_SESSION['user_logged_in']);
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/actions/logout.php" title="Log Out"><i class="fas fa-user-times"></i></a>
                    </li>
                <?php }else{ // User not logged in ?>

                    <li>
                        <a class="nav-link dropdown-toggle navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/users/signup.php">Sign Up</a>
                            <a class="dropdown-item" href="/users/login.php">Log In</a>
                        </div><!-- .dropdown-menu -->
                    </li>
                    <?php } ?>







            </ul><!-- .navbar-nav -->
        </div><!-- #navbarSupportedContent -->
    </div><!-- #navWrap -->
</nav>
