<?php 

add_action( 'wp_ajax_boc_registration_data', 'boc_registration_data' );
add_action( 'wp_ajax_nopriv_boc_registration_data', 'boc_registration_data' );
function boc_registration_data(){

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
  $membership_dropdown = $formFields['membership_dropdown'];




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
   
    // ... continue adding other form fields
  );

  // Insert data into the custom table
  $wpdb->insert($table_name, $data);


}


?>