<?php 

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  // $phpmailer->Username = '6e380d75012caa';
  // $phpmailer->Password = '3a6c7363c5dc8f';
}

add_action('phpmailer_init', 'mailtrap');





// save form data to database 
add_action( 'wp_ajax_boc_registration_data', 'boc_registration_data' );
add_action( 'wp_ajax_nopriv_boc_registration_data', 'boc_registration_data' );
function boc_registration_data(){


  //  shortcode of sslcommerze
  //  do_shortcode('[sslcommerz_payment]') ;


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

  // send mail for confirmation 

$to = 'anmtanvir872@gmail.com' ; 
$subject = 'Subject';
// $body = $formdata['temp_desc'];
$headers[] = 'Content-type: text/html; charset=utf-8';
$headers[] = 'From:' . "testing@gmail.com";


    //Message
    $message = "Your registration is successful.Your registration number is ".$randomNumber;

    // foreach ($formdata as $index => $field) {
    //     $message .= '<strong>' . $index . '</strong> :' . $field . '<br/>';
    // }

$test = wp_mail( $to , $subject, $message, $headers );


// sslcommerze code start 
$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
// Prepare the data to be sent in the POST request
$post_data = array(
    'store_id' => "anmta64c0f40b25788",
    'store_passwd' => "anmta64c0f40b25788@ssl",
    'total_amount' => "10000",
    'currency' => "BDT",
    'tran_id' => "SSLCZ_TEST_" . uniqid(),
    'success_url' => "http://www.packetbd.com/wp_test/success/",
    'fail_url' => "http://www.packetbd.com/wp_test/fail/",
    'cancel_url' => "http://www.packetbd.com/wp_test/cancel/",
    // 'emi_option' => "1",
    // 'emi_max_inst_option' => "9",
    // 'emi_selected_inst' => "9",
    'cus_name' => $name, 
    'cus_email' => $email ,
    // 'cus_add1' => "Dhaka",
    // 'cus_add2' => "Dhaka",
    // 'cus_city' => "Dhaka",
    // 'cus_state' => "Dhaka",
    // 'cus_postcode' => "1000",
    'cus_country' => "Bangladesh",
    'cus_phone' => $mobile,
    // 'cus_fax' => "01711111111",
    'ship_name' => "testanmtam1gp",
    // 'ship_add1' => "Dhaka",
    // 'ship_add2' => "Dhaka",
    // 'ship_city' => "Dhaka",
    // 'ship_state' => "Dhaka",
    // 'ship_postcode' => "1000",
    // 'ship_country' => "Bangladesh",
    // 'value_a' => "ref001",
    // 'value_b' => "ref002",
    // 'value_c' => "ref003",
    // 'value_d' => "ref004",
    // 'cart' => json_encode(array(
    //     array("product" => "DHK TO BRS AC A1", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A2", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A3", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A4", "amount" => "200.00")
    // )),
    // 'product_amount' => "100",
    // 'vat' => "5",
    // 'discount_amount' => "5",
    // 'convenience_fee' => "3"
);

// Send the API request using wp_remote_post()
$response = wp_remote_post($direct_api_url, array(
    'method' => 'POST',
    'body' => $post_data,
    'timeout' => 30,
    'sslverify' => false, // KEEP IT FALSE IF YOU RUN FROM LOCAL PC
));

// Check for errors and process the response
if (!is_wp_error($response) && $response['response']['code'] == 200) {
    $sslcommerzResponse = $response['body'];
    // Process the response here as needed
    // Example: json_decode($sslcommerzResponse, true);
} else {
    echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
    exit;
}


# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true );


if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
   wp_send_json($sslcz['GatewayPageURL']) ;
  //  echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
  # header("Location: ". $sslcz['GatewayPageURL']);
exit;
} else {
echo "JSON Data parsing error!";
}
    
// sslcommerze code end 


wp_die() ;

}





// save manual registration data to database 
add_action( 'wp_ajax_boc_registration_data_manual', 'boc_registration_data_manual' );
add_action( 'wp_ajax_nopriv_boc_registration_data_manual', 'boc_registration_data_manual' );
function boc_registration_data_manual(){




  $formFields = [];
  wp_parse_str($_POST['boc_registration_data_manual'], $formFields); 
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










// edit manual registration data to database 
add_action( 'wp_ajax_boc_registration_data_manual_update', 'boc_registration_data_manual_update' );
add_action( 'wp_ajax_nopriv_boc_registration_data_manual_update', 'boc_registration_data_manual_update' );
function boc_registration_data_manual_update(){




  $formFields = [];
  wp_parse_str($_POST['boc_registration_data_manual_update'], $formFields); 
  // print_r($formFields) ;  

  // exit;  

// Sanitize and prepare the form data
global $wpdb;


$user_id_manual =  $formFields['user_id_manual'];  
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
}else{
  $attachment_urls =  $formFields['edu_certificate_old'];
}

$edu_certificates = $attachment_urls ;


print_r($attachment_urls) ;

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
}else{
  $attachment =  $formFields['signature_img_manual_old'];
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
}else{  
  $nid_image =  $formFields['nid_image_manual_old'];
}


// print_r($nid_image) ; 




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

}else{
  $personal_img =  $formFields['personal_img_manual_old'];
}


$randomNumber = mt_rand(100000, 999999);
// Define the table name with the WordPress prefix
$table_name = $wpdb->prefix . 'boc_registration_form';

// Prepare data array for update
$data = array(
    'name' => $name,
    'member_id' => $randomNumber,
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
    // 'status' => 1,
    // ... continue adding other form fields
);

// Update data in the custom table where member_id is 364
$wpdb->update($table_name, $data, array('id' => $user_id_manual));



}

















// save frontend registration data to database 
add_action( 'wp_ajax_boc_settings_form', 'boc_settings_form' );
add_action( 'wp_ajax_nopriv_boc_settings_form', 'boc_settings_form' );
function boc_settings_form(){


  $formFields = [];
  wp_parse_str($_POST['boc_settings_form'], $formFields); 
 
// Sanitize and prepare the form data
global $wpdb;

$direct_api_url = $formFields['direct_api_url'];
$store_id = $formFields['store_id']; 


$store_passwd = sanitize_text_field($formFields['store_passwd']);
$total_amount = sanitize_text_field($formFields['total_amount']);
$success_url = sanitize_text_field($formFields['success_url']);
$fail_url = sanitize_text_field($formFields['fail_url']);
$cancel_url = sanitize_text_field($formFields['cancel_url']);
$ship_name = sanitize_text_field($formFields['ship_name']);

// Define the table name with the WordPress prefix
$table_name = $wpdb->prefix . 'boc_settings';

// Prepare data array for insertion/update
$data = array(
  'id' => 1, // Assuming 1 is the primary key value of the row you want to update
  'direct_api_url' => $direct_api_url,
  'store_id' => $store_id,
  'store_passwd' => $store_passwd,
  'total_amount' => $total_amount,
  'success_url' => $success_url,
  'fail_url' => $fail_url,
  'cancel_url' => $cancel_url,
  'ship_name' => $ship_name,
  'status' => 1,
  // ... continue adding other form fields
);

// Prepare format for data types (%s for string, %d for integer, etc.)
$data_formats = array(
  '%d', // Assuming 'id' is an integer
  '%s',
  '%s',
  '%s',
  '%d',
  '%s',
  '%s',
  '%s',
  '%s',
  '%d', // Assuming 'status' is an integer

);

// Check if there are any data in the table
$count_query = "SELECT COUNT(*) FROM $table_name";
$count = $wpdb->get_var($count_query);

if ($count > 0) {
  // Data exists, perform an update
  $wpdb->replace($table_name, $data, $data_formats);
} else {
  // No data exists, perform an insert
  $wpdb->insert($table_name, $data, $data_formats);
}


  
}




// Make  inactive members
add_action( 'wp_ajax_make_active', 'make_active' );
add_action( 'wp_ajax_nopriv_make_active', 'make_active' );
function make_active(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
    $wpdb->update( $table_name, array('status' => '3') , array('id' => $member_id), '', '' );
  wp_die();

}

// Make  active members
add_action( 'wp_ajax_make_inactive', 'make_inactive' );
add_action( 'wp_ajax_nopriv_make_inactive', 'make_inactive' );
function make_inactive(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
    $wpdb->update( $table_name, array('status' => '2') , array('id' => $member_id), '', '' );
  wp_die();

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