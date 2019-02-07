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
                <h2 class="bc-font text-center">Active Listings</h2>
            </div><!-- .col-sm-12 -->
        </div><!-- .row -->
        <div class="search-bar">
            <form id="listing-ajax-search" class="search-form" action="/listings/" method="get">
                <div class="form-row mx-2">
                    <div class="form-group">
                        <input id="citySelect" type="text" name="location" value="" placeholder="City">
                    </div><!-- .form-group -->
                    <div class="form-group" id="minPriceSelect">
                        <select name="min_price" class="form-control">
                            <option hidden value="">Min Price</span></option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select><!-- #minPriceSelect -->
                    </div><!-- .form-group -->
                    <div class="form-group" id="maxPriceSelect">
                        <select name="max_price" class="form-control">
                            <option hidden value="">Max Price</option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select><!-- #maxPriceSelect -->
                    </div><!-- .form-group -->
                    <div class="form-group" id="buildingTypeSelect">
                        <select name="building_type" class="form-control">
                            <option hidden value="">Building Type</option>
                            <option value="">Any</option>
                            <option>House</option>
                            <option>Condo</option>
                            <option>Apartment</option>
                        </select><!-- #buildingTypeSelect -->
                    </div><!-- .form-group -->
                    <div class="form-group" id="bedSelect">
                        <select name="beds" class="form-control">
                            <option hidden value="1">Beds</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                            <option value="5">5+</option>
                        </select><!-- #bedSelect -->
                    </div><!-- .form-group -->
                    <div class="form-group" id="bathSelect">
                        <select name="baths" class="form-control">
                            <option hidden value="1">Baths</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                        </select><!-- #bathSelect -->
                    </div><!-- .form-group -->
                </div><!-- .form-row mx-2 -->
            </form><!-- #listing-ajax-search -->
        </div><!-- .search-bar -->
    </div><!-- .search-wrap text-center col-sm-12 text-center -->
<!-- SEARCH END -->

<!-- RECENT POSTS START -->
<div class="active-posts container">
    <div id="listings-search-results" class="row pt-3">

        <?php
        $l = new Listing;
        $listings = $l->get_all();

        foreach($listings as $listing){

        ?><!-- Beginning for each loop -->
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">
                <div class="card listing-card mb-5" data-projectID="<?=$listing['id']?>">
                    <div class="card-header">
                        <img src="/assets/<?=!empty(trim($listing['listing_photo'])) ? 'files/' . $listing['listing_photo'] : 'images/listing-photo-default.jpg'?>" alt="Listing Photo">
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
                        <p>$<?=number_format($listing['price'])?></p>
                    </div><!-- .card-building-price -->
                </div><!-- .card listing-card mb-5 -->
            </div><!-- .col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left -->
        <?php
        }
        ?>
    </div><!-- #listings-search-results -->
</div><!-- .active-posts container -->
<!-- RECENT POSTS END-->

<?php require_once("../../elements/footer.php");
