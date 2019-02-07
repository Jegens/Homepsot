$(document).ready(function(){

/* ====================================
   VERIFY PASSWORD CHECK
   ==================================== */
   $('#userPassword2').keyup(checkPasswordMatch);
   $('#userPassword').keyup(checkPasswordMatch);

/* ====================================
   DELETE FUNCTION
   ==================================== */
   $("#manage-search-results").on("click", ".delete-listing-link", function(){
       var listing_id = $(this).attr('data-listingID');
       $(this).closest('.manage-card-wrap').remove();
       $.post('/listings/actions/delete.php', {"listing_id":listing_id}, function(data){
          console.log(data);
       });
   });

/* ====================================
   LOVE FUNCTION
   ==================================== */
   $('#listing-card-section, #listings-search-results, #realtor-listings-section').on('click', '.love-listing-link', function(){

       // Components to be updated
       var $love_listing_link = $(this);
       var $love_icon = $love_listing_link.find('.love-icon');
       var $love_btn_text = $love_listing_link.find('.love-btn-text');
       var $loves_count = $love_listing_link.closest('.listing-card').find('.loves-count');

       // Values
       var listing_id = $love_listing_link.closest('.listing-card').attr('data-projectID');

       $.post('/loves/add.php', {"listing_id":listing_id}, function(love_data){
           console.log(love_data);
           love_data = JSON.parse(love_data);
           if(love_data.error === false){ //loving worked
               if(love_data.loved == 'loved'){
                   $love_icon.removeClass('far').addClass('fas');
                   $love_btn_text.text('Loved');
                   $loves_count.text(love_data.love_count);

               }else if(love_data.loved == 'unloved'){
                   $love_icon.removeClass('fas').addClass('far');
                   $love_btn_text.text('Love it');
                   $loves_count.text(love_data.love_count);
               }
           }
       });
   });

/* ====================================
  SEARCH FUNCTION - ALL
  ==================================== */
  $("#listing-ajax-search").on('keyup change', 'input, select', function(){
      var formdata = $(this).closest('#listing-ajax-search').serialize();
            console.log(formdata);
        $.get("/listings/actions/search.php", formdata, function(data){
            // console.log(data);
            var listings = JSON.parse(data);
            var listingshtml = '';

            $.each(listings, function(key, listing){
                listingshtml += '<div class="manage-card-wrap col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">';
                    listingshtml += '<div class="card listing-card mb-5" data-projectID="' + listing.id + '">';

                        listingshtml += '<div class="card-header">';
                            var listing_photo = 'images/listing-photo-default.jpg';
                            if( listing.listing_photo ){
                                listing_photo = 'files/'+listing.listing_photo;
                            }
                            listingshtml += '<img src="/assets/'+listing_photo+'" alt="Listing Photo">';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-body">';
                            listingshtml += '<p class="card-building-title">' + listing.building_type + ' For Sale</p>';
                            listingshtml += '<p class="card-building-info">' + listing.beds + 'BD | ' + listing.baths + 'BA | ' + listing.square_footage + 'SqFt</p>';
                            listingshtml += '<p class="card-building-address1">' + listing.street + '</p>';
                            listingshtml += '<p class="card-building-address2">' + listing.city + ', ' + listing.province + '</p>';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-footer">';
                            listingshtml += '<div class="row mx-0">';

                            var love_class = 'far';
                            var love_text = 'Love it';
                            if (listing.love_id){ //They love it
                                love_class = 'fas';
                                love_text = 'Loved';
                            }

                            if( listing.user_logged_in === 'true' ){

                                listingshtml += '<div class="col-3 love-listing-link">';
                                    listingshtml += '<i class="' + love_class + ' fa-heart text-danger love-icon"></i>';
                                listingshtml += '</div><!-- .love-listing-link -->';
                            }else{
                                listingshtml += '<div class="col-3"></div>';
                            }

                                    listingshtml += '<a href="/listings/view.php?id=' + listing.id + '" class="col-6 view-listing-link">';
                                        listingshtml += '<p class="text-center mb-0">View Lising</p>';
                                    listingshtml += '</a>';
                                listingshtml += '<div class="col-3"></div>';
                            listingshtml += '</div>';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-building-price">';
                            listingshtml += '<p>$' + listing.price + '</p>';
                        listingshtml += '</div>';

                    listingshtml += '</div><!-- .card -->';
                listingshtml += '</div><!-- .col -->';
            })
            $("#listings-search-results").html(listingshtml);
        })
    });

/* ====================================
  SEARCH FUNCTION - MANAGE
  ==================================== */
  $("#manage-ajax-search").on('keyup change', 'input, select', function(){
      var formdata = $(this).closest('#manage-ajax-search').serialize();
            console.log(formdata);
        $.get("/listings/actions/search_by_id.php", formdata, function(data){
            // console.log(data);
            var listings = JSON.parse(data);
            var listingshtml = '';

            $.each(listings, function(key, listing){
                listingshtml += '<div class="manage-card-wrap col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">';
                    listingshtml += '<div class="card listing-card mb-5" data-projectID="' + listing.id + '">';

                        listingshtml += '<div class="card-header">';
                            var listing_photo = 'images/listing-photo-default.jpg';
                            if( listing.listing_photo ){
                                listing_photo = 'files/'+listing.listing_photo;
                            }
                            listingshtml += '<img src="/assets/'+listing_photo+'" alt="Listing Photo">';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-body">';
                            listingshtml += '<p class="card-building-title">' + listing.building_type + ' For Sale</p>';
                            listingshtml += '<p class="card-building-info">' + listing.beds + 'BD | ' + listing.baths + 'BA | ' + listing.square_footage + 'SqFt</p>';
                            listingshtml += '<p class="card-building-address1">' + listing.street + '</p>';
                            listingshtml += '<p class="card-building-address2">' + listing.city + ', ' + listing.province + '</p>';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-footer">';
                            listingshtml += '<div class="row mx-0">';
                                listingshtml += '<a href="/listings/edit.php?id=' + listing.id + '" class="col-3 edit-listing-link">';
                                    listingshtml += '<i class="fas fa-edit"></i>';
                                listingshtml += '</a>';
                                listingshtml += '<a href="/listings/view.php?id=' + listing.id + '" class="col-6 view-listing-link">';
                                    listingshtml += '<p class="text-center mb-0">View Lising</p>';
                                listingshtml += '</a>';
                                listingshtml += '<div class="col-3 delete-listing-link" data-listingID="' + listing.id + '">';
                                    listingshtml += '<i class="fas fa-eraser"></i>';
                                listingshtml += '</div>';
                            listingshtml += '</div>';
                        listingshtml += '</div>';

                        listingshtml += '<div class="card-building-price">';
                            listingshtml += '<p>$' + listing.price + '</p>';
                        listingshtml += '</div>';

                    listingshtml += '</div><!-- .card -->';
                listingshtml += '</div><!-- .col -->';
            })
            $("#manage-search-results").html(listingshtml);
        })
    });

/* ====================================
  SEARCH FUNCTION - REALTORS
  ==================================== */
  $("#user-ajax-search").on('keyup change', 'input, select', function(){
      var formdata = $(this).closest('#user-ajax-search').serialize();
            console.log(formdata);
        $.get("/users/actions/search.php", formdata, function(data){
            // console.log(data);
            var users = JSON.parse(data);
            var usershtml = '';

            $.each(users, function(key, user){
                usershtml += '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 float-left">';
                    usershtml += '<div class="card realtor-card mb-5" data-userID="' + user.id + '">';
                        usershtml += '<div class="card-header">';

                            usershtml += '<div class="realty-profile-pic-container">';
                                var profile_photo = 'images/profile-photo-default.jpg';
                                if( user.profile_photo ){
                                    profile_photo = 'files/'+user.profile_photo;
                                }
                                usershtml += '<img src="/assets/'+profile_photo+'" alt="Profile Photo">';
                            usershtml += '</div>';
                        usershtml += '</div>';

                        usershtml += '<div class="card-body">';
                            usershtml += '<p class="card-realtor-name">' + user.first_name + ' ' + user.last_name + '</p>';
                            usershtml += '<p class="card-realtor-office">' + user.company + '</p>';
                            usershtml += '<p class="card-building-address1">' + user.street + '</p>';
                            usershtml += '<p class="card-building-address2">' + user.city + ', ' + user.province + '</p>';
                            usershtml += '<span class="realtor-links"><a href="#"><i class="fas fa-envelope"></i></a><a href="#"><i class="fas fa-globe"></i></a><a href="#" title="' + user.phone + '"><i class="fas fa-phone"></i></a></span>';
                        usershtml += '</div>';

                        usershtml += '<div class="card-footer">';
                            usershtml += '<div class="row mx-0">';
                                usershtml += '<a href="/users/view.php?id=' + user.id + '" class="col-12 view-realtor-link">';
                                    usershtml += '<p class="text-center mb-0">View Realtor</p>';
                                usershtml += '</a>';
                            usershtml += '</div>';
                        usershtml += '</div>';
                    usershtml += '</div>';
                usershtml += '</div>';
            })
            $("#realtor-search-results").html(usershtml);
        })
    });

}); // END DOCUMENT READY

/* ====================================
   PASSWORD VERIFICATION
   ==================================== */

//Check to see on edit an account if passwords match using keyup
    function checkPasswordMatch() {
       var password1 = $('#userPassword').val();
       var password2 = $('#userPassword2').val();

       if( password1 != password2) {
           editPasswordsMatch = false;
           $("#userPasswordVerify").css({ "border": " 1px solid red"});
       }else{
           editPasswordsMatch = true;
           $("#userPasswordVerify").css({ "border": "1px solid green"});
       }
   }

/* ====================================
    FILE UPLOAD PREVIEW FUNCTION
    ==================================== */
    function previewFile() {

        var preview = document.getElementById('img-preview');
        var file = document.getElementById('file-with-preview').files[0];

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file) {
            reader.readAsDataURL(file);
        }else{
            preview.src = "";
        }
    }
