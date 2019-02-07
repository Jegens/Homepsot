<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Home Page';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");
?>

<!-- CAROUSEL START-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/splash/home-interior-03.jpg" class="d-block w-100" alt="...">
        </div><!-- .carousel-item -->
        <div class="carousel-item">
            <img src="assets/images/splash/home-exterior-01.jpg" class="d-block w-100" alt="...">
        </div><!-- .carousel-item -->
        <div class="carousel-item">
            <img src="assets/images/splash/home-interior-01.jpg" class="d-block w-100" alt="...">
        </div><!-- .carousel-item -->
        <div class="carousel-item">
            <img src="assets/images/splash/cityscape-01.jpg" class="d-block w-100" alt="...">
        </div><!-- .carousel-item -->
    </div><!-- .carousel-inner -->
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

<!-- SPLASH START -->
    <div class="splash-content text-center container col-sm-12 text-center">
        <h2 class="splash-title">Find Your Dream Home Today</h2>
        <div class="search-bar">
            <form class="search-form" action="/listings/" method="get">
                <div class="form-row mx-2">
                    <div class="form-group">
                        <input id="citySelect" type="text" name="location" value="" placeholder="City">
                    </div>
                    <div class="form-group" id="minPriceSelect">
                        <select name="min_price" class="form-control">
                            <option hidden value="">Min Price</span></option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="maxPriceSelect">
                        <select name="max_price" class="form-control">
                            <option hidden value="">Max Price</option>
                            <option value="">Any</option>
                            <?php
                                for($min_price=50000; $min_price<=2000000; $min_price+=50000)
                                echo '<option>' . $min_price . '</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="buildingTypeSelect">
                        <select name="building_type" class="form-control">
                            <option hidden value="">Building Type</option>
                            <option value="">Any</option>
                            <option>House</option>
                            <option>Condo</option>
                            <option>Apartment</option>
                        </select>
                    </div>
                    <div class="form-group" id="bedSelect">
                        <select name="beds" class="form-control">
                            <option hidden value="1">Beds</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                    <div class="form-group" id="bathSelect">
                        <select name="baths" class="form-control">
                            <option hidden value="1">Baths</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                        </select>
                    </div>
                    <input class="search-submit btn" type="submit" name="" value="Search">
                </div><!-- .form-row -->
            </form><!-- .search-form -->
        </div><!-- .search-bar -->
    </div><!-- .splash-content -->
<!-- SPLASH END -->

</div><!-- #carouselExampleIndicators -->
<!-- CAROUSEL END-->

<!-- RECENT POSTS START -->
<div class="recent-posts container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center">Recently Listed</h2>
        </div><!-- .col-sm-12 -->
    </div>
    <div id="listing-card-section">
        <div class="row pt-3">

            <?php
            $l = new Listing;
            $listings = $l->get_all(4);

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
                            <p>$<?=number_format($listing['price'])?></p>
                        </div><!-- .card-building-price -->
                    </div><!-- .card -->
                </div><!-- .col -->
            <?php
            }
            ?>
            <div class="col-sm-12">
                <a class="bl-btn seeAllHomes mx-auto" href="/listings/index.php">See All Homes</a>
            </div><!-- .col-sm-12 -->
        </div><!-- .row -->
    </div><!-- #listing-card-section -->
</div><!-- .container -->
<!-- RECENT POSTS END-->

<!-- FIND AGENT START-->
<div class="find-agent-wrap lg-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h3 class="o-text">Realtors You Can Count On</h3>
                <h4>Find the agent you need to make the best home decision. </h4>
                <hr>
                <p>Helping you navigate the in’s and out’s of purchasing a home, from lining up viewings all the way to signing on the dotted line and handing you the keys to your dream home.</p>
                <a class="or-btn findYourAgent" href="/users/index.php">Find Your Agent</a>
            </div><!-- .col-md-7 -->
            <div class="col-md-5 text-center">
                <img class="img-fluid realtor-pic" src="assets/images/vector/agent-vector.jpg" alt="">
            </div><!-- .col-md-5 -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .find-agent-wrap -->
<!-- FIND AGENT END-->

<!-- FIND TOOL START-->
<div class="mortgage-calc-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h3>The Tool You Need To Have</h3>
                <h4>Find out just how much you can afford before you start your search. </h4>
                <hr>
                <p>Buying a house can be stressful enough as is. Don’t let financial uncertainty complicate things further. Find out what your payments will look like so you can find the right fit.</p>
                <a class="bl-btn findYourTool" href="#">Mortgage Calculator</a>
            </div><!-- .col-md-7 -->
            <div class="col-md-5 text-center">
                <img class="img-fluid calculator-pic" src="assets/images/vector/tools-vector.jpg" alt="">
            </div><!-- .col-md-5 -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .find-agent-wrap -->
<!-- FIND TOOL END-->

<?php require_once("../elements/footer.php");
