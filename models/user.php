<?php
class User extends Db {

/* ====================================
   BRINGS ALL INFO FROM DB
   ==================================== */

    function get_all(){

        if( !empty($_GET) ){
            $realtorName = trim($this->params['realtorName']);
            $realtorCompany = trim($this->params['realtorCompany']);
            $realtorLocation = trim($this->params['realtorLocation']);

            $sql = "SELECT * FROM users
            WHERE CONCAT(users.first_name, ' ', users.last_name) LIKE '%$realtorName%'
            AND users.company LIKE '%$realtorCompany%'
            AND users.city LIKE '%$realtorLocation%'";

        }else{
            $sql = "SELECT * FROM users";
        }
        $users = $this->select($sql);

        return $users;
    }

/* ====================================
   BRINGS INFO ABOUT LOGGED IN USER
   ==================================== */

    function get_by_id($id){

        $id = (int)$id;
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $user = $this->select($sql)[0];

        return $user;
    }

/* ====================================
   ADDS USER TO DATABASE
   ==================================== */

    function add(){

        $_SESSION = array(); // Empty session and start fresh

        $util = new Util;
        $firstname = trim($this->data['first_name']);
        $lastname = trim($this->data['last_name']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $email = trim($this->data['email']);
        // $profile_photo = $util->file_upload(APP_ROOT."/views/assets/files/", "profile_photo");
        // $profile_photo = $profile_photo['filename'];

        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
        $new_user_id = $this->execute_return_id($sql);
        return $new_user_id;
    }

/* ====================================
   CHECK TO SEE IF USER IS IN DATABASE
   ==================================== */

    function exists(){

        $email = $this->data['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $user = $this->select($sql);
        return $user;
    }

/* ====================================
   LOG IN
   ==================================== */

    function login(){

        $_SESSION = array(); // Empty session and start fresh

        // Get the users details from the db and store it in a define_syslog_variable
        $email = $this->data['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $user = $this->select($sql)[0];

        // DOES PASSWORD MATCH FROM FORM AND DB
        if( password_verify($_POST['password'], $user['password']) ){
            $_SESSION['user_logged_in'] = $user['id'];

            header("Location: /");
            exit();

        }else{ // Login attempt failed
            $_SESSION['login_attempt_msg'] = '<p class="user-error-message">*** Incorrect Username/Password ***</p>';
            $_SESSION['remember_email'] = $_POST['email']; // REMEMBERS EMAIL IN CASE OF SIGN UP ERROR

            header("Location: /users/login.php?login_error=true");
            exit();
        }
    }

/* ====================================
   EDIT
   ==================================== */

    function edit(){

        $util = new Util;
        $id = (int)$_SESSION['user_logged_in'];
        $firstname = trim($this->data['first_name']);
        $lastname = trim($this->data['last_name']);
        $email = trim($this->data['email']);
        $company = trim($this->data['company']);
        $street = trim($this->data['street']);
        $city = trim($this->data['city']);
        $province = trim($this->data['province']);
        $website = trim($this->data['website']);
        $phone = trim($this->data['phone']);
        $bio = trim($this->data['bio']);

        $profile_photo = '';

        if( !empty($_FILES['profile_photo']['name']) ) {
            //Delete the old project image file
            $old_profile_image = trim($this->get_by_id($id)['profile_photo']);
            if( !empty($old_profile_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$old_profile_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$old_profile_image );
                }
            }
            $fileupload = $util->file_upload(APP_ROOT."/views/assets/files/", "profile_photo");

            /*
            $fileupload['file_upload_error_status'] // holds zero or one. one if successful, 0 if not
            $fileupload['errors'] // if unsuccessful, will hold a numeric array of all errors
            $fileupload['filename'] // holds the name of the file that was uploaded to the server, if it was successful
            */

            $filename = $fileupload['filename'];
            $profile_photo = ", profile_photo='$filename'";
        }

        $password = password_hash(trim($this->data['password']), PASSWORD_DEFAULT);

        if( !empty(trim($_POST['password'])) ){ // New password entered

            $sql = "UPDATE users SET password='$password', first_name='$firstname', last_name='$lastname', company='$company', street='$street', city='$city', province='$province', website='$website', phone='$phone', bio='$bio' $profile_photo WHERE id='$id'";

        }else{ // No new password entered

            $sql = "UPDATE users SET first_name='$firstname', last_name='$lastname', company='$company', street='$street', city='$city', province='$province', website='$website', phone='$phone', bio='$bio' $profile_photo WHERE id='$id'";
        }
        $this->execute($sql);
    }
}
