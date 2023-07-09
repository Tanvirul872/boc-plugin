<?php 


// save form data to database 
add_action( 'wp_ajax_boc_registration_data', 'boc_registration_data' );
add_action( 'wp_ajax_nopriv_boc_registration_data', 'boc_registration_data' );
function boc_registration_data(){

    $formFields = [];
    wp_parse_str($_POST['boc_registration_data'], $formFields); 
    // print_r($formFields) ; 

  // Sanitize and prepare the form data
  global $wpdb;

  $name = $formFields['name'];
  $dob = $formFields['dob']; 
  $designation = sanitize_text_field($formFields['designation']);
  $father = sanitize_text_field($formFields['father']);
  $mother = sanitize_text_field($formFields['mother']);
  $spouse = sanitize_text_field($formFields['spouse']);
  $spouse_profession = sanitize_text_field($formFields['spouse_profession']);
  $children = sanitize_text_field($formFields['children']);
  $nationality = sanitize_text_field($formFields['nationality']);
  $email = sanitize_email($formFields['email']);
  $password = sanitize_text_field($formFields['password']);
  $nid = sanitize_text_field($formFields['nid']);
  $nid_image = sanitize_text_field($formFields['nid_image']);
  $passport = sanitize_text_field($formFields['passport']);
  $mobile = absint($formFields['mobile']);
  $cellphone = absint($formFields['cellphone']);
  $present_address = sanitize_text_field($formFields['present_address']);
  $permanent_address = sanitize_text_field($formFields['permanent_address']);
  $bmdc_registration_no = absint($formFields['bmdc_registration_no']);
  // $signature_img = $formFields['signature'];
  $membership_dropdown = $formFields['membership_dropdown'];

print_r($_POST['signature_img']) ;  



$attachment = '';
  
if (file_exists($_FILES['signature_img']['tmp_name'])) {

  if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/noop.php');
  }

  $uploadedfile = $_FILES['signature_img'];
  $upload_overrides = array('test_form' => false);
  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
  if ($movefile) {
    $attachment = $movefile ['url'];
    $explodeArray = explode('wp-content', $attachment);                   
    $attachment = get_home_url() . '/wp-content' . $explodeArray[1];

  }
}


print_r($attachment) ;

  





  // Define the table name with the WordPress prefix
  $table_name = $wpdb->prefix . 'boc_registration_form';

  // Prepare data array for insertion
  $data = array(
   
    'name' => $name,
    'dob' => $dob,
    'present_designation' => $designation,
    'father_name' => $father,
    'mother_name' => $mother,
    'spouse_name' => $spouse,
    'spouse_profession' => $spouse_profession,
    'num_children' => $children,
    'nationality' => $nationality,
    'email' => $email,
    'password' => $password,
    'national_id_no' => $nid,
    'nid_image' => $nid_image,
    'passport_no' => $passport,
    'mobile_no' => $mobile,
    'cell_phone' => $cellphone,
    'present_address' => $present_address,
    'permanent_address' => $permanent_address,
    'bmdc_registration_no' => $bmdc_registration_no,
    'signature_image' => $attachment,
    'status' => 1,
   
    // ... continue adding other form fields
  );

  // Insert data into the custom table
  $wpdb->insert($table_name, $data);  
}





// save manual registration data to database 
add_action( 'wp_ajax_boc_registration_data_manual', 'boc_registration_data_manual' );
add_action( 'wp_ajax_nopriv_boc_registration_data_manual', 'boc_registration_data_manual' );
function boc_registration_data_manual(){

    $formFields = [];
    wp_parse_str($_POST['formData'], $formFields); 
    // print_r($formFields) ; 


  // Sanitize and prepare the form data
  global $wpdb;

  $name = $formFields['name'];
  $dob = $formFields['dob']; 
  $designation = sanitize_text_field($formFields['designation']);
  $father = sanitize_text_field($formFields['father']);
  $mother = sanitize_text_field($formFields['mother']);
  $spouse = sanitize_text_field($formFields['spouse']);
  $spouse_profession = sanitize_text_field($formFields['spouse_profession']);
  $children = sanitize_text_field($formFields['children']);
  $nationality = sanitize_text_field($formFields['nationality']);
  $email = sanitize_email($formFields['email']);
  $password = sanitize_text_field($formFields['password']);
  $nid = sanitize_text_field($formFields['nid']);
  $nid_image = sanitize_text_field($formFields['nid_image']);
  $passport = sanitize_text_field($formFields['passport']);
  $mobile = absint($formFields['mobile']);
  $cellphone = absint($formFields['cellphone']);
  $present_address = sanitize_text_field($formFields['present_address']);
  $permanent_address = sanitize_text_field($formFields['permanent_address']);
  $bmdc_registration_no = absint($formFields['bmdc_registration_no']);
  $signature_img = $formFields['signature'];



  // Define the table name with the WordPress prefix
  $table_name = $wpdb->prefix . 'boc_registration_form';

  // Prepare data array for insertion
  $data = array(
   
    'name' => $name,
    'dob' => $dob,
    'present_designation' => $designation,
    'father_name' => $father,
    'mother_name' => $mother,
    'spouse_name' => $spouse,
    'spouse_profession' => $spouse_profession,
    'num_children' => $children,
    'nationality' => $nationality,
    'email' => $email,
    'password' => $password,
    'national_id_no' => $nid,
    'nid_image' => $nid_image,
    'passport_no' => $passport,
    'mobile_no' => $mobile,
    'cell_phone' => $cellphone,
    'present_address' => $present_address,
    'permanent_address' => $permanent_address,
    'bmdc_registration_no' => $bmdc_registration_no,
    'signature_image' => $signature_img,
    'status' => 1,
   
    // ... continue adding other form fields
  );

  // Insert data into the custom table
  $wpdb->insert($table_name, $data);


}




// approve member 
add_action( 'wp_ajax_approve_member', 'approve_member' );
add_action( 'wp_ajax_nopriv_approve_member', 'approve_member' );
function approve_member(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
  
  $wpdb->update( $table_name, array('status' => '3') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data
  wp_die();

}


// reject member 
add_action( 'wp_ajax_reject_member', 'reject_member' );
add_action( 'wp_ajax_nopriv_reject_member', 'reject_member' );
function reject_member(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
  
  $wpdb->update( $table_name, array('status' => '4') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data
  wp_die();

}

// inactive member 
add_action( 'wp_ajax_inactive_member', 'inactive_member' );
add_action( 'wp_ajax_nopriv_inactive_member', 'inactive_member' );
function inactive_member(){

    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
    $wpdb->update( $table_name, array('status' => '2') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data

  wp_die();

}


?>