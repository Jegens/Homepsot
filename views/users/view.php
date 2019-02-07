<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Home Page';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");

    $u = new User;
    $user = $u->get_by_id($_GET['id']);
    ?>

<div class="title-wrap text-center col-sm-12">
    <div class="row">
        <div class="col-12">
            <div class="realty-profile-pic-container">
                <img class="realtor-profile-pic" src="/assets/<?=!empty(trim($user['profile_photo'])) ? 'files/' . $user['profile_photo'] : 'images/profile-photo-default.jpg'?>" alt="Profile Photo">
            </div><!-- .realty-profile-pic-container -->
        </div><!-- .col-12 -->
        <div class="col-12 mt-3">
            <p class="card-realtor-name"><?=$user['first_name'] . ' ' . $user['last_name']?></p>
            <p class="card-realtor-office pb-2"><?=$user['company']?></p>
            <p class="card-building-address1"><?=$user['street']?></p>
            <p class="card-building-address2"><?=$user['city'] . ', ' . $user['province']?></p>
            <div class="row realtor-links container mx-auto">
                <div class="col-12 col-sm-10 mx-auto">
                    <div class="row pt-2">
                        <a href="#" class="col-12 col-sm-4 realtor-contact-links">
                            <i class="fas fa-envelope"></i><br>
                            <span><?=$user['email']?></span>
                        </a><!-- .col-12 col-sm-4 realtor-contact-links -->
                        <a href="#" class="col-12 col-sm-4 realtor-contact-links pad-small">
                            <i class="fas fa-globe"></i><br>
                            <span><?=$user['website']?></span>
                        </a><!-- .col-12 col-sm-4 realtor-contact-links pad-small -->
                        <a href="#" class="col-12 col-sm-4 realtor-contact-links pad-small">
                            <i class="fas fa-phone"></i><br>
                            <span><?=$user['phone']?></span>
                        </a><!-- .col-12 col-sm-4 realtor-contact-links pad-small -->
                    </div><!-- .row pt-2 -->
                    <div class="row realtor-bio">
                        <p><?=$user['bio']?></p>
                    </div><!-- .row realtor-bio -->
                </div><!-- .col-12 col-sm-10 mx-auto -->
            </div><!-- .row realtor-links container mx-auto -->
        </div><!-- .col-12 -->
    </div><!-- .row -->
</div><!-- .title-wrap text-center col-sm-12 -->

<!-- ACTIVE POSTS START -->
<div id="realtor-listings-section" class="recent-posts container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center">Active Listings</h2>
        </div><!-- .col-sm-12 -->
    </div><!-- .row -->
    <div class="row pt-3">
        <?php
        $l = new Listing;
        $listings = $l->get_all_by_user_id($_GET['id']);

        foreach($listings as $listing){

        ?><!-- Beginning for each loop -->
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">
                <div class="card listing-card mb-5" data-projectID="<?=$listing['id']?>">
                    <div class="card-header">
                        <img src="/assets/<?=!empty(trim($listing['listing_photo'])) ? 'files/' . $listing['listing_photo'] : 'images/listing-photo-default.jpg' ?>" alt="Listing Photo">
                    </div><!-- .card-header -->

                    <div class="card-body">
                        <p class="card-building-title"><?=$listing['building_type']?> For Sale</p>
                        <p class="card-building-info"><?=$listing['beds']?>BD | <?=$listing['baths']?>BA | <?=$listing['square_footage']?>SqFt</p>
                        <p class="card-building-address1"><?=$listing['street']?></p>
                        <p class="card-building-address2"><?=$listing['city'] . ', ' . $listing['province']?></p>
                    </div><!-- .card-body -->

                    <div class="card-footer">
                        <div class="row mx-0">
                            <?php
                            $love_class = 'far';
                            $love_text = 'Love it';
                            if(!empty($listing['love_id'])){ //They love it
                                $love_class = 'fas';
                                $love_text = 'Loved';
                            }
                            if( !empty($_SESSION['user_logged_in']) ){
                            ?>
                                <div class="col-3 love-listing-link">
                                    <i class="<?=$love_class?> fa-heart text-danger love-icon"></i>
                                </div><!-- .love-listing-link -->
                            <?php }else{ ?>
                                <div class="col-3"></div>
                            <?php } ?>
                                <a href="/listings/view.php?id=<?=$listing['id']?>" class="col-6 view-listing-link">
                                    <p class="text-center mb-0">View Lising</p>
                                </a><!-- .view-listing-link -->
                            <div class="col-3"></div>
                        </div><!-- .row -->
                    </div><!-- .card-footer -->
                    <div class="card-building-price">
                        <p>$<?=$listing['price']?></p>
                    </div><!-- .card-building-price -->
                </div><!-- .card listing-card mb-5 -->
            </div><!-- .col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left -->
        <?php
        }
        ?>
    </div><!-- .row pt-3 -->
    <div class="col-sm-12">
        <a class="bl-btn seeAllHomes mx-auto" href="/listings/index.php">See All Homes</a>
    </div><!-- .col-sm-12 -->
</div><!-- .recent-posts container -->
<!-- ACTIVE POSTS END-->

<?php require_once("../../elements/footer.php");
