<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Home Page';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");

    $l = new Listing;
    $listing = $l->get_by_id($_GET['id']);
?>

<div class="view-title-wrap text-center col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center"><?=$listing['title']?></h2>
            <p><?=$listing['street'] . ', ' . $listing['city'] . ', ' . $listing['province']?></p>
        </div><!-- .col-sm-12 -->
    </div><!-- .row -->
</div><!-- .view-title-wrap text-center col-sm-12 -->

<div class="listing-wrap container">
    <div class="row">

<!-- PHOTO SECTION START -->
        <div class="col-lg-5">
            <div class="images-wrap">
                <div class="col-md-12">
                    <div class="key-points">
                        <span>$<?=number_format($listing['price'])?></span> <br><i class="fas fa-bed"> <?=$listing['beds']?> BD</i><i class="fas fa-bath"> <?=$listing['baths']?> BA</i><i class="fas fa-vector-square"> <?=$listing['square_footage']?> SqFt</i>
                    </div><!-- .key-points -->
                </div><!-- .col-md-12 -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <img class="property-pic-primary img-fluid" <img src="/assets/<?=!empty(trim($listing['listing_photo'])) ? 'files/' . $listing['listing_photo'] : 'images/listing-photo-default.jpg' ?>" alt="Listing Photo">
                    </div><!-- .col-sm-12 -->
                    <!-- <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div>
                    <div class="col-4 col-sm-3 bla">
                        <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                    </div> -->
                </div><!-- .row -->
            </div><!-- .images-wrap -->
        </div><!-- col-lg-5 -->
<!-- PHOTO SECTION END -->

<!-- INFO SECTION START -->
        <div class="col-lg-7">
            <div class="view-listing-wrap">
                <div class="row">
                    <div class="col-12">
                        <label>Overview</label>
                        <p><?=$listing['overview']?></p>
                    </div><!-- .col-12 -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Building Details</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Building Type</span>
                        <p><?=$listing['building_type']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Year Built</span>
                        <p><?=$listing['year_built']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Square Footage</span>
                        <p><?=$listing['square_footage']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Garage</span>
                        <p><?=$listing['garage']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Beds</span>
                        <p><?=$listing['beds']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Baths</span>
                        <p><?=$listing['baths']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Utilties</span>
                        <p><?=$listing['utilities']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Sewer</span>
                        <p><?=$listing['sewer']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                    <div class="col-sm-4 form-group detailTitleField">
                        <span>Water</span>
                        <p><?=$listing['water']?></p>
                    </div><!-- .col-sm-4 form-group detailTitleField -->
                </div><!-- .row -->
                <hr class="mt-2">
                <div class="row">
                    <div class="col-sm-12 listing-realtor-section">
                        <label>Realtor</label>
                        <div class="row">
                            <a href="/users/view.php?id=<?=$listing['user_id']?>" class="col-12 col-xl-3 form-group detailRealtorField">
                                <span class="bc-font"><?=$listing['first_name'] . ' ' . $listing['last_name']?></span>
                                <p><?=$listing['company']?></p>
                            </a><!-- .col-12 col-xl-3 form-group detailRealtorField -->
                            <a href="#" class="col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center">
                                <i class="fas fa-envelope"></i>
                                <p><?=$listing['email']?></p>
                            </a><!-- .col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center -->
                            <a href="#" class="col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center">
                                <i class="fas fa-globe"></i>
                                <p><?=$listing['website']?></p>
                            </a><!-- .col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center -->
                            <div class="col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center">
                                <i class="fas fa-phone"></i>
                                <p><?=$listing['phone']?></p>
                            </div><!-- .col-12 col-lg-4 col-xl-3 form-group detailRealtorField text-center -->
                        </div><!-- .row -->
                    </div><!-- .col-sm-12 listing-realtor-section -->
                </div><!-- .row -->
            </div><!-- .view-listing-wrap -->
        </div><!-- .col-lg-7 -->
<!-- INFO SECTION END -->

    </div><!-- .row -->
</div><!-- .listing-wrap container -->

<?php require_once("../../elements/footer.php");
