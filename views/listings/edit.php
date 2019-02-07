<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Home Page';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");

    $l = new Listing;
    $listing = $l->get_by_id($_GET['id']);
?>

<div class="title-wrap text-center col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center">Edit Listing</h2>
        </div><!-- .col-sm-12 -->
    </div><!-- .row -->
</div><!-- .title-wrap text-center col-sm-12 -->

<div class="listing-wrap container">
    <form class="create-listing-form" action="/listings/actions/edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$listing['id']?>">
        <div class="row">

<!-- PHOTO SECTION START -->
            <div class="col-lg-5">
                <div class="images-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <img id="img-preview" class="property-pic-primary img-fluid" src="/assets/<?=!empty(trim($listing['listing_photo'])) ? 'files/' . $listing['listing_photo'] : 'images/listing-photo-default.jpg' ?>" alt="Listing Photo">
                        </div><!-- .col-md-12 -->
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <input type="file" name="listing_photo" onchange="previewFile()" id="file-with-preview" class="upload-photo-btn inputfile">
                                <label for="file-with-preview">Select Photo</label>
                            </div><!-- .form-group -->
                        </div><!-- .col-sm-6 -->
                    </div><!-- .row -->
                    <!-- <div class="row">
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                        <div class="col-4 col-sm-3 col-lg-4">
                            <img class="property-pic-secondary img-fluid" src="/assets/images/vector/for-sale-sign.jpg" alt="">
                        </div>
                    </div> -->
                </div><!-- .images-wrap -->
            </div><!-- .col-5 -->
<!-- PHOTO SECTION END -->

<!-- INFO SECTION START -->
            <div class="col-lg-7">
                <input type="hidden" name="id" value="<?=$listing['id']?>">
                <div class="row">
                    <div class="col-12">
                        <label>Listing Info</label>
                    </div><!-- .col-12 -->
                    <div class="col-12 col-sm-8 form-group" id="titleField">
                        <input type="text" name="title" placeholder="Listing Title" value="<?= !empty(trim($listing['title'])) ? $listing['title'] : '' ?>" required>
                    </div><!-- #titleField -->
                    <div class="col-12 col-sm-4 form-group" id="priceField">
                        <input type="number" name="price" placeholder="Price" value="<?= !empty(trim($listing['price'])) ? $listing['price'] : '' ?>" required>
                    </div><!-- #priceField -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Property Details</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group" id="streetField">
                        <input type="text" name="street" placeholder="Street" value="<?= !empty(trim($listing['street'])) ? $listing['street'] : '' ?>" required>
                    </div><!-- #streetField -->
                    <div class="col-sm-4 form-group" id="cityField">
                        <input type="text" name="city" placeholder="City" value="<?= !empty(trim($listing['city'])) ? $listing['city'] : '' ?>" required>
                    </div><!-- #cityField -->
                    <div class="col-sm-4 form-group" id="provinceSelect">
                        <select class="form-control" name="province" required>
                            <option hidden>Province</option>
                            <?php
                                $provinces = array('AB',
                                'BC',
                                'MB',
                                'NB',
                                'NL',
                                'NT',
                                'NS',
                                'NU',
                                'ON',
                                'PE',
                                'QC',
                                'SK',
                                'YT');

                                $selected = '';

                                foreach ($provinces as $province) {
                                    if ($listing['province'] == $province) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $province . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #provinceSelect -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Building Details</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group" id="buildingTypeSelect">
                        <select class="form-control" name="building_type" required>
                            <option hidden>Building Type</option>
                            <?php
                                $buildings = array('House',
                                'Condo',
                                'Apartment');

                                $selected = '';

                                foreach ($buildings as $building) {
                                    if ($listing['building_type'] == $building) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $building . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #buildingTypeSelect -->
                    <div class="col-sm-4 form-group" id="yearBuiltField">
                        <input type="text" name="year_built" placeholder="Year Built" value="<?= !empty(trim($listing['year_built'])) ? $listing['year_built'] : '' ?>" required>
                    </div><!-- #yearBuiltField -->
                    <div class="col-sm-4 form-group" id="areaField">
                        <input type="text" name="square_footage" placeholder="Square Footage" value="<?= !empty(trim($listing['square_footage'])) ? $listing['square_footage'] : '' ?>" required>
                    </div><!-- #areaField -->
                    <div class="col-sm-4 form-group" id="garageSelect">
                        <select class="form-control" name="garage" required>
                            <option hidden>Garage</option>
                            <?php
                                $garages = array('0',
                                '1 car',
                                '2 car');

                                $selected = '';

                                foreach ($garages as $garage) {
                                    if ($listing['garage'] == $garage) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $garage . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- garageSelect -->
                    <div class="col-sm-4 form-group" id="bedSelect">
                        <select class="form-control" name="beds" required>
                            <option hidden>Beds</option>
                            <?php
                                $beds = array('1',
                                '2',
                                '3',
                                '4',
                                '5');

                                $selected = '';

                                foreach ($beds as $bed) {
                                    if ($listing['beds'] == $bed) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $bed . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #bedSelect -->
                    <div class="col-sm-4 form-group" id="bathSelect">
                        <select class="form-control" name="baths" required>
                            <option hidden>Baths</option>
                            <?php
                                $baths = array('1',
                                '2',
                                '3',
                                '4');

                                $selected = '';

                                foreach ($baths as $bath) {
                                    if ($listing['baths'] == $bath) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $bath . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #bathSelect -->
                    <div class="col-sm-4 form-group" id="utiltySelect">
                        <select class="form-control" name="utilities" required>
                            <option hidden>Utilities</option>
                            <?php
                                $utilities = array('Electric',
                                'Gas',
                                'Electric + Gas');

                                $selected = '';

                                foreach ($utilities as $utility) {
                                    if ($listing['utilities'] == $utility) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $utility . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #utiltySelect -->
                    <div class="col-sm-4 form-group" id="sewerSelect">
                        <select class="form-control"name="sewer" required>
                            <option hidden>Sewer</option>
                            <?php
                                $sewers = array('Municipal',
                                'Septic');

                                $selected = '';

                                foreach ($sewers as $sewer) {
                                    if ($listing['sewer'] == $sewer) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $sewer . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #sewerSelect -->
                    <div class="col-sm-4 form-group" id="waterSelect">
                        <select class="form-control" name="water" required>
                            <option hidden>Water</option>
                            <?php
                                $waters = array('Municipal',
                                'Well');

                                $selected = '';

                                foreach ($waters as $water) {
                                    if ($listing['water'] == $water) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $water . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #waterSelect -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Overview</label>
                    </div><!-- .col-12 -->
                    <div class="col-12 form-group" id="priceField">
                        <textarea name="overview" rows="8" cols="80" placeholder="Add description here..." required><?= !empty(trim($listing['overview'])) ? $listing['overview'] : '' ?></textarea>
                    </div><!-- #priceField -->
                    <div class="col-12">
                        <input class="or-btn mx-auto" id="create-submit-btn" type="submit" name="createSubmit" value="Submit Listing">
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .col-lg-7 -->
<!-- INFO SECTION END -->

        </div><!-- .row -->
    </form><!-- .create-listing-form -->
</div><!-- .listing-wrap container -->

<?php require_once("../../elements/footer.php");
