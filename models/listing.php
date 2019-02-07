<?php
class Listing extends Db {

/* ====================================
   BRINGS ALL INFO FROM DB
   ==================================== */

    function get_all($limit = 20){

        $user_id = (int)$_SESSION['user_logged_in'];

        if( !empty($_GET) ){
            $city = trim($this->params['location']);
            $min_price = trim($this->params['min_price']);
            $max_price = trim($this->params['max_price']);
            $priceQuery = '';
            if( !empty($min_price) ){
                $priceQuery .= " AND price >= '$min_price' ";
            }
            if( !empty($max_price) ){
                $priceQuery .= " AND price <= '$max_price' ";
            }
            $building_type = trim($this->params['building_type']);
            $beds = trim($this->params['beds']);
            $baths = trim($this->params['baths']);

            $sql = "SELECT listings.*, loves.id AS love_id,
            (SELECT COUNT(loves.id) FROM loves WHERE loves.listing_id = listings.id) AS love_count,
            IF(0 != '$user_id', 'true', 'false') AS user_logged_in
            FROM listings
            LEFT JOIN users
            ON listings.user_id = users.id
            LEFT JOIN loves
            ON listings.id = loves.listing_id AND loves.user_id = '$user_id'
            WHERE listings.city LIKE '%$city%'
            $priceQuery
            AND listings.building_type LIKE '%$building_type%'
            AND listings.beds >= '$beds'
            AND listings.baths >= '$baths'
            ORDER BY listings.posted_time DESC
            LIMIT $limit";

        }else{
            $sql = "SELECT listings.*, loves.id AS love_id,
            (SELECT COUNT(loves.id) FROM loves WHERE loves.listing_id = listings.id) AS love_count,
            IF(0 != '$user_id', 'true', 'false') AS user_logged_in
            FROM listings
            LEFT JOIN users
            ON listings.user_id = users.id
            LEFT JOIN loves
            ON listings.id = loves.listing_id AND loves.user_id = '$user_id'
            ORDER BY listings.posted_time DESC
            LIMIT $limit";
        }
        $listings = $this->select($sql);

        return $listings;
    }

/* ====================================
   BRINGS ALL INFO FROM BY USER
   ==================================== */

   function get_all_by_user_id($user_id){
       $user_id = (int)$user_id;

       if( !empty($_GET) ){
           $city = trim($this->params['location']);
           $min_price = trim($this->params['min_price']);
           $max_price = trim($this->params['max_price']);
           $priceQuery = '';
           if( !empty($min_price) ){
               $priceQuery .= " AND price >= '$min_price' ";
           }
           if( !empty($max_price) ){
               $priceQuery .= " AND price <= '$max_price' ";
           }
           $building_type = trim($this->params['building_type']);
           $beds = trim($this->params['beds']);
           $baths = trim($this->params['baths']);

           $sql = "SELECT listings.*
           FROM listings
           LEFT JOIN users
           ON listings.user_id = users.id
           WHERE listings.user_id = '$user_id'
           AND listings.city LIKE '%$city%'
           $priceQuery
           AND listings.building_type LIKE '%$building_type%'
           AND listings.beds >= '$beds'
           AND listings.baths >= '$baths'
           ORDER BY listings.posted_time DESC";

       }else{
           $sql = "SELECT listings.*, users.first_name, users.last_name, users.company, users.email, users.website, users.phone
           FROM listings
           LEFT JOIN users
           ON listings.user_id = users.id
           WHERE listings.user_id = '$user_id'
           ORDER BY listings.posted_time DESC";
       }
       $listings = $this->select($sql);

       return $listings;
   }

/* ====================================
   BRINGS INFORMATION ABOUT LOGGED IN USER
   ==================================== */

    function get_by_id($id){

        $id = (int)$id;
        $sql = "SELECT listings.*, users.first_name, users.last_name, users.company, users.email, users.website, users.phone FROM listings LEFT JOIN users ON listings.user_id = users.id WHERE listings.id = '$id'";
        $listing = $this->select($sql)[0];

        return $listing;
    }

/* ====================================
   ADDS LISTING TO DATABASE
   ==================================== */

    function add(){
        $util = new Util;

        $title = trim($this->data['title']);
        $price = trim($this->data['price']);
        $price = preg_replace('/[^0-9]/', '', $price);
        $overview = trim($this->data['overview']);
        $building_type = trim($this->data['building_type']);
        $year_built = trim($this->data['year_built']);
        $square_footage = trim($this->data['square_footage']);
        $garage = trim($this->data['garage']);
        $beds = trim($this->data['beds']);
        $baths = trim($this->data['baths']);
        $utilities = trim($this->data['utilities']);
        $sewer = trim($this->data['sewer']);
        $water = trim($this->data['water']);
        $street = trim($this->data['street']);
        $city = trim($this->data['city']);
        $province = trim($this->data['province']);
        $posted_time = time();
        $user_id = (int)$_SESSION['user_logged_in'];


        if( !empty($_FILES['listing_photo']['name']) ){ // New File was submitted
            $listing_photo = $util->file_upload(APP_ROOT."/views/assets/files/", "listing_photo");
            $listing_photo = $listing_photo['filename'];

            $sql = "INSERT INTO listings (title, price, overview, building_type, year_built, square_footage, garage, beds, baths, utilities, sewer, water, street, city, province, posted_time, user_id, listing_photo) VALUES ('$title', '$price', '$overview', '$building_type', '$year_built', '$square_footage', '$garage', '$beds', '$baths', '$utilities', '$sewer', '$water', '$street', '$city', '$province', '$posted_time', '$user_id', '$listing_photo')";
        }else{
            $sql = "INSERT INTO listings (title, price, overview, building_type, year_built, square_footage, garage, beds, baths, utilities, sewer, water, street, city, province, posted_time, user_id) VALUES ('$title', '$price', '$overview', '$building_type', '$year_built', '$square_footage', '$garage', '$beds', '$baths', '$utilities', '$sewer', '$water', '$street', '$city', '$province', '$posted_time', '$user_id')";
            }

        $listing_id = $this->execute_return_id($sql); // puts information from form and sends it to the database
        header("Location: /listings/view.php?id=$listing_id");
        exit();
    }

/* ====================================
   EDIT
   ==================================== */

    function edit(){

        $util = new Util;
        $id = (int)$this->data['id'];
        $this->check_ownership($id); //make sure user owns post that's being edited

        $title = trim($this->data['title']);
        $price = trim($this->data['price']);
        $price = preg_replace('/[^0-9]/', '', $price);
        $overview = trim($this->data['overview']);
        $building_type = trim($this->data['building_type']);
        $year_built = trim($this->data['year_built']);
        $square_footage = trim($this->data['square_footage']);
        $garage = trim($this->data['garage']);
        $beds = trim($this->data['beds']);
        $baths = trim($this->data['baths']);
        $utilities = trim($this->data['utilities']);
        $sewer = trim($this->data['sewer']);
        $water = trim($this->data['water']);
        $street = trim($this->data['street']);
        $city = trim($this->data['city']);
        $province = trim($this->data['province']);
        $posted_time = time();
        $user_id = (int)$_SESSION['user_logged_in'];

        $listing_photo = '';

        if( !empty($_FILES['listing_photo']['name']) ) {
            //Delete the old project image file
            $old_listing_image = trim($this->get_by_id($id)['listing_photo']);
            if( !empty($old_listing_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$old_listing_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$old_listing_image );
                }
            }
            $fileupload = $util->file_upload(APP_ROOT."/views/assets/files/", "listing_photo");

            /*
            $fileupload['file_upload_error_status'] // holds zero or one. one if successful, 0 if not
            $fileupload['errors'] // if unsuccessful, will hold a numeric array of all errors
            $fileupload['filename'] // holds the name of the file that was uploaded to the server, if it was successful
            */

            $filename = $fileupload['filename'];
            $listing_photo = ", listing_photo='$filename'";
        }

        $sql = "UPDATE listings SET title='$title', price='$price', overview='$overview', building_type='$building_type', year_built='$year_built', square_footage='$square_footage', garage='$garage', beds='$beds', baths='$baths', utilities='$utilities', sewer='$sewer', water='$water', street='$street', city='$city', province='$province', posted_time='$posted_time', user_id='$user_id' $listing_photo WHERE id='$id' AND user_id='$user_id'";

        $this->execute($sql);

        header("Location: /listings/manage.php");
        exit();
    }

/* ====================================
  DELETE
  ==================================== */

    function delete(){

        $current_user_id = (int)$_SESSION['user_logged_in'];
        $id = (int)$_POST['listing_id'];
        $this->check_ownership($id);

        // Delete the old project image file
        $listing_image = trim($this->get_by_id($id)['listing_photo']);
        if( !empty($listing_image) ){
            if( file_exists(APP_ROOT.'/views/assets/files/'.$listing_image )){
                unlink( APP_ROOT.'/views/assets/files/'.$listing_image );
            }
        }

        $sql = "DELETE FROM listings WHERE id='$id' AND user_id='$current_user_id'";
        $this->execute($sql);

        exit();
    }

/* ====================================
  CHECK OWENERSHIP
  ==================================== */

    function check_ownership($id){

        $id = (int)$id;
        $sql = "SELECT * FROM listings WHERE id = '$id'";
        $listing = $this->select($sql)[0];

        if( $listing['user_id'] == $_SESSION['user_logged_in'] ){
            return true;
        }else{
            header("Location: /");
            exit();
        }
    }
}
