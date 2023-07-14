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

  $edu_degrees = $formFields['edu_degree'];
  $edu_years = $formFields['edu_year'];
  $edu_institutes = $formFields['edu_institute'];
  


  // print_r($edu_certificates); 


  $attachment_urls = [];

  if (isset($_FILES['edu_certificate']) && !empty($_FILES['edu_certificate'])) {
      $edu_certificates = $_FILES['edu_certificate'];
  
      foreach ($edu_certificates['tmp_name'] as $key => $tmp_name) {
          $uploaded_file = [
              'name'     => $edu_certificates['name'][$key],
              'type'     => $edu_certificates['type'][$key],
              'tmp_name' => $tmp_name,
              'error'    => $edu_certificates['error'][$key],
              'size'     => $edu_certificates['size'][$key]
          ];
  
          if (file_exists($tmp_name)) {
              if (!function_exists('wp_handle_upload')) {
                  require_once(ABSPATH . 'wp-admin/includes/file.php');
                  require_once(ABSPATH . 'wp-admin/includes/noop.php');
              }
  
              $upload_overrides = ['test_form' => false];
              $movefile = wp_handle_upload($uploaded_file, $upload_overrides);
  
              if ($movefile && isset($movefile['url'])) {
                  $attachment_urls[] = $movefile['url'];
              }
          }
      }
  }
  $edu_certificates = $attachment_urls ;



  $edu_qualifications = array();    
  // Iterate through the arrays
  for ($i = 0; $i < count($edu_degrees); $i++) {
      // Create a new array for each set of values
      $edu_qualification = array(
          $edu_degrees[$i],
          $edu_years[$i],
          $edu_institutes[$i],
          $edu_certificates[$i]
      );

      // Add the new array to the main array
      $edu_qualifications[] = $edu_qualification;
  }

  

  
  // Output the restructured array

  $edu_qualification = json_encode($edu_qualifications) ; 

  $jsonData = '[["degree 1","year 1 ","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/rose-flower-flowers-red-rose-royalty-free-thumbnail-70.jpg"],["","year 1 ","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/WIN_20230709_21_40_37_Pro-150.jpg"],["degree 1","","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/rose-flower-flowers-red-rose-royalty-free-thumbnail-71.jpg"]]';

// Decode the JSON data
$data111 = json_decode($jsonData, true);


print_r($data111) ; 
  


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



$nid_image = '';
if (file_exists($_FILES['nid_image']['tmp_name'])) {

  if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/noop.php');
  }

  $uploadedfile = $_FILES['nid_image'];
  $upload_overrides = array('test_form' => false);
  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
  if ($movefile) {
    $nid_image = $movefile ['url'];
    $explodeArray = explode('wp-content', $nid_image);                   
    $nid_image = get_home_url() . '/wp-content' . $explodeArray[1];

  }
}

$personal_img = '' ; 

if (file_exists($_FILES['personal_img']['tmp_name'])) {

  if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/noop.php');
  }

  $uploadedfile = $_FILES['personal_img'];
  $upload_overrides = array('test_form' => false);
  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
  if ($movefile) {
    $personal_img = $movefile ['url'];
    $explodeArray = explode('wp-content', $personal_img);                   
    $personal_img = get_home_url() . '/wp-content' . $explodeArray[1];

  }
}





  




  $randomNumber = mt_rand(100000, 999999);
  // Define the table name with the WordPress prefix
  $table_name = $wpdb->prefix . 'boc_registration_form';

  // Prepare data array for insertion
  $data = array(
    'name' => $name,
    'member_id' => $randomNumber  ,  
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
    'personal_img' => $personal_img,
    'membership_type' => $membership_dropdown,
    'educational_qualification' => $edu_qualification,
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
  wp_parse_str($_POST['boc_registration_data_manual'], $formFields); 
  print_r($formFields) ; 

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
$edu_degrees = $formFields['edu_degree'];
$edu_years = $formFields['edu_year'];
$edu_institutes = $formFields['edu_institute'];



// print_r($edu_certificates); 


$attachment_urls = [];

if (isset($_FILES['edu_certificate']) && !empty($_FILES['edu_certificate'])) {
    $edu_certificates = $_FILES['edu_certificate'];

    foreach ($edu_certificates['tmp_name'] as $key => $tmp_name) {
        $uploaded_file = [
            'name'     => $edu_certificates['name'][$key],
            'type'     => $edu_certificates['type'][$key],
            'tmp_name' => $tmp_name,
            'error'    => $edu_certificates['error'][$key],
            'size'     => $edu_certificates['size'][$key]
        ];

        if (file_exists($tmp_name)) {
            if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/noop.php');
            }

            $upload_overrides = ['test_form' => false];
            $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

            if ($movefile && isset($movefile['url'])) {
                $attachment_urls[] = $movefile['url'];
            }
        }
    }
}
$edu_certificates = $attachment_urls ;



$edu_qualifications = array();    
// Iterate through the arrays
for ($i = 0; $i < count($edu_degrees); $i++) {
    // Create a new array for each set of values
    $edu_qualification = array(
        $edu_degrees[$i],
        $edu_years[$i],
        $edu_institutes[$i],
        $edu_certificates[$i]
    );

    // Add the new array to the main array
    $edu_qualifications[] = $edu_qualification;
}




// Output the restructured array

$edu_qualification = json_encode($edu_qualifications) ; 

$jsonData = '[["degree 1","year 1 ","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/rose-flower-flowers-red-rose-royalty-free-thumbnail-70.jpg"],["","year 1 ","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/WIN_20230709_21_40_37_Pro-150.jpg"],["degree 1","","institute 1 ","http:\/\/localhost\/wp_test\/wp-content\/uploads\/2023\/07\/rose-flower-flowers-red-rose-royalty-free-thumbnail-71.jpg"]]';

// Decode the JSON data
$data111 = json_decode($jsonData, true);


print_r($data111) ; 



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



$nid_image = '';
if (file_exists($_FILES['nid_image']['tmp_name'])) {

if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/noop.php');
}

$uploadedfile = $_FILES['nid_image'];
$upload_overrides = array('test_form' => false);
$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
if ($movefile) {
  $nid_image = $movefile ['url'];
  $explodeArray = explode('wp-content', $nid_image);                   
  $nid_image = get_home_url() . '/wp-content' . $explodeArray[1];

}
}

$personal_img = '' ; 

if (file_exists($_FILES['personal_img']['tmp_name'])) {

if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/noop.php');
}

$uploadedfile = $_FILES['personal_img'];
$upload_overrides = array('test_form' => false);
$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
if ($movefile) {
  $personal_img = $movefile ['url'];
  $explodeArray = explode('wp-content', $personal_img);                   
  $personal_img = get_home_url() . '/wp-content' . $explodeArray[1];

}
}










$randomNumber = mt_rand(100000, 999999);
// Define the table name with the WordPress prefix
$table_name = $wpdb->prefix . 'boc_registration_form';

// Prepare data array for insertion
$data = array(
  'name' => $name,
  'member_id' => $randomNumber  ,  
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
  'personal_img' => $personal_img,
  'membership_type' => $membership_dropdown,
  'educational_qualification' => $edu_qualification,
  'status' => 1,
 
  // ... continue adding other form fields
);

// Insert data into the custom table
$wpdb->insert($table_name, $data); 






  //   $formFields = [];
  //   wp_parse_str($_POST['formData'], $formFields); 
  //   // print_r($formFields) ; 


  // // Sanitize and prepare the form data
  // global $wpdb;

  // $name = $formFields['name'];
  // $dob = $formFields['dob']; 
  // $designation = sanitize_text_field($formFields['designation']);
  // $father = sanitize_text_field($formFields['father']);
  // $mother = sanitize_text_field($formFields['mother']);
  // $spouse = sanitize_text_field($formFields['spouse']);
  // $spouse_profession = sanitize_text_field($formFields['spouse_profession']);
  // $children = sanitize_text_field($formFields['children']);
  // $nationality = sanitize_text_field($formFields['nationality']);
  // $email = sanitize_email($formFields['email']);
  // $password = sanitize_text_field($formFields['password']);
  // $nid = sanitize_text_field($formFields['nid']);
  // $nid_image = sanitize_text_field($formFields['nid_image']);
  // $passport = sanitize_text_field($formFields['passport']);
  // $mobile = absint($formFields['mobile']);
  // $cellphone = absint($formFields['cellphone']);
  // $present_address = sanitize_text_field($formFields['present_address']);
  // $permanent_address = sanitize_text_field($formFields['permanent_address']);
  // $bmdc_registration_no = absint($formFields['bmdc_registration_no']);
  // $signature_img = $formFields['signature'];

  // $personal_member_id = 12345; 


  // // Define the table name with the WordPress prefix
  // $table_name = $wpdb->prefix . 'boc_registration_form';

  
  // // Prepare data array for insertion
  // $data = array(
  //   'member_id' => $name , 
  //   'random_member_id' => $name  ,  
  //   'name' => $name,
  //   'dob' => $dob,
  //   'present_designation' => $designation,
  //   'father_name' => $father,
  //   'mother_name' => $mother,
  //   'spouse_name' => $spouse,
  //   'spouse_profession' => $spouse_profession,
  //   'num_children' => $children,
  //   'nationality' => $nationality,
  //   'email' => $email,
  //   'password' => $password,
  //   'national_id_no' => $nid,
  //   'nid_image' => $nid_image,
  //   'passport_no' => $passport,
  //   'mobile_no' => $mobile,
  //   'cell_phone' => $cellphone,
  //   'present_address' => $present_address,
  //   'permanent_address' => $permanent_address,
  //   'bmdc_registration_no' => $bmdc_registration_no,
  //   'signature_image' => $signature_img,  
  //   'status' => 1,
   
  //   // ... continue adding other form fields
  // );

  // // print_r($data) ;
  // // Insert data into the custom table
  // $wpdb->insert($table_name, $data);







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