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
                <h2 class="bc-font text-center">Manage Listings</h2>
            </div><!-- .col-sm-12 -->
        </div><!-- . -->
        <div class="search-bar">
            <form id="manage-ajax-search" class="search-form" action="/listings/manage.php" method="get">
                <div class="form-row mx-2">
                    <div class="form-group">
                        <input id="citySelect" type="text" name="location" value="" placeholder="City">
                    </div><!-- . -->
                    <div class="form-group" id="minPriceSelect">
                        <select name="min_price" class="form-control">
                            <option hidden value="">Min Price</span></option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select><!-- . -->
                    </div><!-- . -->
                    <div class="form-group" id="maxPriceSelect">
                        <select name="max_price" class="form-control">
                            <option hidden value="">Max Price</option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select><!-- . -->
                    </div><!-- . -->
                    <div class="form-group" id="buildingTypeSelect">
                        <select name="building_type" class="form-control">
                            <option hidden value="">Building Type</option>
                            <option value="">Any</option>
                            <option>House</option>
                            <option>Condo</option>
                            <option>Apartment</option>
                        </select><!-- . -->
                    </div><!-- . -->
                    <div class="form-group" id="bedSelect">
                        <select name="beds" class="form-control">
                            <option hidden value="1">Beds</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                            <option value="5">5+</option>
                        </select><!-- . -->
                    </div><!-- . -->
                    <div class="form-group" id="bathSelect">
                        <select name="baths" class="form-control">
                            <option hidden value="1">Baths</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                        </select><!-- . -->
                    </div><!-- . -->
                </div><!-- .form-row -->
            </form><!-- .search-form -->
        </div><!-- .search-bar -->
    </div><!-- .splash-content -->
<!-- SEARCH END -->

<!-- RECENT POSTS START -->
<div class="active-posts container">
    <div id="manage-search-results" class="row pt-3">

        <?php
        $l = new Listing;
        $listings = $l->get_all_by_user_id($_SESSION['user_logged_in']);

        foreach($listings as $listing){

        ?><!-- Beginning for each loop -->
            <div class="manage-card-wrap col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">
                <div class="card listing-card mb-5">
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
                            <a href="/listings/edit.php?id=<?=$listing['id']?>" class="col-3 edit-listing-link">
                                <i class="fas fa-edit"></i>
                            </a><!-- .col-3 edit-listing-link -->
                                <a href="/listings/view.php?id=<?=$listing['id']?>" class="col-6 view-listing-link">
                                <p class="text-center mb-0">View Lising</p>
                            </a><!-- .col-6 view-listing-link -->
                            <div class="col-3 delete-listing-link" data-listingID="<?=$listing['id']?>">
                                <i class="fas fa-eraser"></i>
                            </div><!-- .col-3 delete-listing-link -->
                        </div><!-- .row mx-0 -->
                    </div><!-- .card-footer -->
                    <div class="card-building-price">
                        <p>$<?=number_format($listing['price'])?></p>
                    </div><!-- .card-building-price -->
                </div><!-- .card listing-card mb-5 -->
            </div><!-- .manage-card-wrap col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left -->
        <?php
        }
        ?>
    </div><!-- #manage-search-results -->
</div><!-- .active-posts container -->
<!-- RECENT POSTS END-->

<?php require_once("../../elements/footer.php");
