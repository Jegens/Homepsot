<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Home Page';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");
?>

<!-- SEARCH START -->
<div class="search-wrap text-center col-sm-12 text-center">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center">Realtors</h2>
        </div><!-- .col-sm-12 -->
    </div><!-- .row -->
    <div class="search-bar">
        <form id="user-ajax-search" class="search-form" action="/users/" method="post">
            <div class="form-row mx-2">
                <div class="form-group">
                    <input id="realtorNameSelect" type="text" name="realtorName" value="" placeholder="Name">
                </div><!-- .form-group -->
                <div class="form-group">
                    <input id="realtorCompanySelect" type="text" name="realtorCompany" value="" placeholder="Company">
                </div><!-- .form-group -->
                <div class="form-group">
                    <input id="realtorLocationSelect" type="text" name="realtorLocation" value="" placeholder="City">
                </div><!-- .form-group -->
            </div><!-- .form-row mx-2 -->
        </form><!-- .search-form -->
    </div><!-- .search-bar -->
</div><!-- .splash-content -->
<!-- SEARCH END -->

<!-- RECENT POSTS START -->
<div class="active-realtors container">
    <div id="realtor-search-results" class="row pt-3">

        <?php
        $u = new User;
        $users = $u->get_all();

        foreach($users as $user){

        ?><!-- Beginning for each loop -->
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">
                <div class="card realtor-card mb-5" data-userID="<?=$user['id']?>">
                    <div class="card-header">
                        <div class="realty-profile-pic-container">
                            <img class="realtor-profile-pic" src="/assets/<?=!empty(trim($user['profile_photo'])) ? 'files/' . $user['profile_photo'] : 'images/profile-photo-default.jpg'?>" alt="Profile Photo">
                        </div><!-- .realty-profile-pic-container -->
                    </div><!-- .card-header -->

                    <div class="card-body">
                        <p class="card-realtor-name"><?=$user['first_name'] . ' ' . $user['last_name']?></p>
                        <p class="card-realtor-office"><?=$user['company']?></p>
                        <p class="card-building-address1"><?=$user['street']?></p>
                        <p class="card-building-address2"><?=$user['city'] . ', ' . $user['province']?></p>
                        <span class="realtor-links"><a href="#"><i class="fas fa-envelope"></i></a><a href="#"><i class="fas fa-globe"></i></a><a href="#" title="<?=$user['phone']?>"><i class="fas fa-phone"></i></a></span>
                    </div><!-- .card-body -->

                    <div class="card-footer">
                        <div class="row mx-0">
                            <a href="/users/view.php?id=<?=$user['id']?>" class="col-12 view-realtor-link">
                                <p class="text-center mb-0">View Realtor</p>
                            </a><!-- .col-12 view-realtor-link -->
                        </div><!-- .row mx-0 -->
                    </div><!-- .card-footer -->
                </div><!-- .card realtor-card mb-5 -->
            </div><!-- .col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left -->
        <?php
        }
        ?>
    </div><!-- .row pt-3 -->
</div><!-- .active-realtors container -->
<!-- RECENT POSTS END-->

<?php require_once("../../elements/footer.php");
