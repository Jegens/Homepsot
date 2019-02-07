<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'HomeSpot Edit User';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");
?>

<div class="title-wrap text-center col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="bc-font text-center">Edit Profile</h2>
        </div><!-- .col-sm-12 -->
    </div><!-- .row -->
</div><!-- .title-wrap text-center col-sm-12 -->

<div class="listing-wrap container">
    <form class="create-listing-form" action="/users/actions/edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$user['id']?>">
        <div class="row">

<!-- PHOTO SECTION START -->
            <div class="col-lg-5">
                <div class="realtor-image-wrap">
                    <div class="row">
                        <div class="col-md-12 pb-5">
                            <div class="realty-profile-pic-container">
                                <img id="img-preview" class="realtor-profile-pic" src="/assets/<?=!empty(trim($user['profile_photo'])) ? 'files/' . $user['profile_photo'] : 'images/profile-photo-default.jpg'?>" alt="Profile Photo">
                            </div><!-- .realty-profile-pic-container -->
                        </div><!-- .col-md-12 pb-5 -->
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <input type="file" name="profile_photo" onchange="previewFile()" id="file-with-preview" class="upload-photo-btn inputfile">
                                <label for="file-with-preview">Select Photo</label>
                            </div><!-- .form-group -->
                        </div><!-- .col-12 mt-4 -->
                    </div><!-- .row -->
                </div><!-- .realtor-image-wrap -->
            </div><!-- .col-lg-5 -->
<!-- PHOTO SECTION END -->

<!-- INFO SECTION START -->
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-12">
                        <label>Realtor Info</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4  form-group" id="realtor-first-name">
                        <input type="text" name="first_name" placeholder="First Name" value="<?= !empty(trim($user['first_name'])) ? $user['first_name'] : '' ?>">
                    </div><!-- #realtor-first-name .col-sm-4 form-group -->
                    <div class="col-sm-4  form-group" id="realtor-last-name">
                        <input type="text" name="last_name" placeholder="Last Name" value="<?= !empty(trim($user['last_name'])) ? $user['last_name'] : '' ?>">
                    </div><!-- #realtor-last-name .col-sm-4 form-group -->
                    <div class="col-sm-4  form-group" id="realtor-company-name">
                        <input type="text" name="company" placeholder="Company" value="<?= !empty(trim($user['company'])) ? $user['company'] : '' ?>">
                    </div><!-- #realtor-company-name .col-sm-4 form-group -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Address</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group" id="streetField">
                        <input type="text" name="street" placeholder="Street" value="<?= !empty(trim($user['street'])) ? $user['street'] : '' ?>">
                    </div><!-- #streetField .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group" id="cityField">
                        <input type="text" name="city" placeholder="City" value="<?= !empty(trim($user['city'])) ? $user['city'] : '' ?>">
                    </div><!-- #cityField .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group" id="provinceSelect">
                        <select class="form-control" name="province">
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
                                    if ($user['province'] == $province) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option ' .$selected. '>' . $province . '</option>';
                                }
                            ?>
                        </select><!-- .form-control -->
                    </div><!-- #provinceSelect .col-sm-4 form-group -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Contact Info</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group" id="emailField">
                        <input type="email" name="email" value="<?= $user['email'] ?>">
                    </div><!-- #emailField .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group" id="webField">
                        <input type="text" name="website" placeholder="Website" value="<?= !empty(trim($user['website'])) ? $user['website'] : '' ?>">
                    </div><!-- #webField .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group" id="phoneField">
                        <input type="phone" name="phone" placeholder="Phone" value="<?= !empty(trim($user['phone'])) ? $user['phone'] : '' ?>">
                    </div><!-- #phoneField .col-sm-4 form-group -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Overview</label>
                    </div><!-- .col-12 -->
                    <div class="col-12 form-group" id="bio">
                        <textarea rows="8" cols="80" name="bio" placeholder="Add bio here..."><?=$user['bio']?></textarea>
                    </div><!-- #bio .col-12 form-group -->
                </div><!-- .row -->
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label>Password Change</label>
                    </div><!-- .col-12 -->
                    <div class="col-sm-4 form-group">
                        <input id="userPassword" type="password" name="password" placeholder="Password">
                    </div><!-- .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group">
                        <input id="userPassword2" type="password" name="password2" placeholder="Confirm Password">
                    </div><!-- .col-sm-4 form-group -->
                    <div class="col-sm-4 form-group">
                        <input id="userPasswordVerify" type="text" name="passwordMatch" placeholder="Password Match">
                    </div><!-- .col-sm-4 form-group -->
                    <div class="col-12">
                        <input class="or-btn mx-auto" id="edit-submit-btn" type="submit" name="createSubmit" value="Submit Changes">
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .col-lg-7 -->
<!-- INFO SECTION END -->

        </div><!-- .row -->
    </form><!-- .create-listing-form -->
</div><!-- .listing-wrap container -->

<?php require_once("../../elements/footer.php");
