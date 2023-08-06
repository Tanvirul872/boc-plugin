<?php
// Template Name: Member Details

// get_header();

// Get the member ID from the query string
$member_id = $_GET['id'];

// Query the database to retrieve the member details
global $wpdb;
$table_name = $wpdb->prefix . 'boc_registration_form';
$member_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $member_id");

// Check if the member details are found
if ($member_details) {

    $member_id = $member_details->member_id;
    $present_address = $member_details->present_address;
    $bmdc_registration_no = $member_details->bmdc_registration_no;

    $name = $member_details->name;
    $personal_img = $member_details->personal_img;
    $mobile_no = $member_details->mobile_no;
    $present_designation = $member_details->present_designation;
    $educational_qualification = json_decode($member_details->educational_qualification,true);
    

    // Display the member details
    echo '<h2>Member Details</h2>';
    echo '<div class="card">';
    echo '<img src="' . $personal_img . '" class="card-img-top" alt="profile_image">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $name . '</h5>';
    echo '<p class="card-text">' . $present_designation . '</p>';
    echo '<p class="card-text">' . $mobile_no . '</p>';
    echo '<p class="card-text">' . $member_id . '</p>';
    echo '<p class="card-text">' . $present_address . '</p>';
    echo '<p class="card-text">' . $bmdc_registration_no . '</p>';


    foreach($educational_qualification as $edu_quali){
        $qualification = $edu_quali[0].$edu_quali[1].$edu_quali[2] ;
        echo '<p class="card-text">' . $qualification . '</p>';
    }


    
    echo '</div>';
    echo '</div>';
} else {
    // Member details not found
    echo '<p>Member not found.</p>';
}

// get_footer();
?>
