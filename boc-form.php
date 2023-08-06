<?php
/**
 * Plugin Name: BOC Form
 * Description: A plugin for creating custom forms for BOC.
 * Version: 1.0.0
 * Author: Tanvirul Karim
 */
 


include('ajax-actions.php');
 
// Register activation hook
register_activation_hook( __FILE__, 'create_custom_table' );

// Function to create the custom table
function create_custom_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'boc_registration_form';
    // SQL query to create the table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        member_id INT,
        name VARCHAR(255),
        dob DATE,
        present_designation VARCHAR(255),
        father_name VARCHAR(255),
        mother_name VARCHAR(255),
        spouse_name VARCHAR(255),
        spouse_profession VARCHAR(255),
        num_children INT,
        nationality VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255),
        national_id_no VARCHAR(255),
        nid_image VARCHAR(255),
        passport_no VARCHAR(255),
        mobile_no VARCHAR(255),
        cell_phone VARCHAR(255),
        present_address TEXT,
        permanent_address TEXT,
        bmdc_registration_no VARCHAR(255),
        signature_image VARCHAR(255),
        personal_img VARCHAR(255),
        membership_type VARCHAR(255),
        educational_qualification LONGTEXT NOT NULL,   
        status INT
    )";

    // Execute the SQL query
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}




// Register activation hook
register_activation_hook( __FILE__, 'create_boc_settings_table' );
// Function to create the settings table
function create_boc_settings_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'boc_settings';
    // SQL query to create the table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,

        direct_api_url VARCHAR(255),
        store_id VARCHAR(255),
        store_passwd VARCHAR(255),
        total_amount VARCHAR(255),
        success_url VARCHAR(255),
        fail_url VARCHAR(255),
        cancel_url VARCHAR(255),             
        ship_name VARCHAR(255),
        status INT
                     
    )";

    // Execute the SQL query
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}






add_action('wp_enqueue_scripts','plugin_css_jsscripts');
function plugin_css_jsscripts() {
    // CSS
    wp_enqueue_style( 'style-css', plugins_url( '/style.css', __FILE__ ));
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' );

    // JavaScript
    wp_enqueue_script( 'script-js', plugins_url( '/script.js', __FILE__ ),array('jquery'));
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.5.3', true );

    // Pass ajax_url to script.js
    wp_localize_script( 'script-js', 'plugin_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}



// Add the BOC Form menu page
function boc_form_menu_page() {
    add_menu_page(
        'BOC Form',          // Page title
        'BOC Form' ,          // Menu title
        'manage_options',    // Capability required to access the page
        'boc-form-page',     // Menu slug
        'boc_form_page_content', // Callback function to render the page content
        'dashicons-admin-plugins', // Icon for the menu item
        30 // Position of the menu item
    );


    // Add the submenu page for manual input
       add_submenu_page(
        'boc-form-page',    // Parent menu slug
        'Manual Registration',     // Page title
        'Manual Registration',     // Menu title
        'manage_options',   // Capability required to access the page
        'manual-registration',     // Menu slug
        'boc_manual_registration' // Callback function to render the page content
    );

      // Add the submenu page for member list
      add_submenu_page(
        'boc-form-page',    // Parent menu slug
        'Members List',     // Page title
        'Members List',     // Menu title
        'manage_options',   // Capability required to access the page
        'members-list',     // Menu slug
        'boc_members_list_page' // Callback function to render the page content
    );


       // Add the submenu page for approved member list
       add_submenu_page(
        'boc-form-page',    // Parent menu slug
        'Approved Member',     // Page title
        'Approved Member',     // Menu title
        'manage_options',   // Capability required to access the page
        'approved-member',     // Menu slug
        'boc_approved_members_page' // Callback function to render the page content
     );

        // Add the submenu page for rejected member list
        add_submenu_page(
            'boc-form-page',    // Parent menu slug
            'Rejected Member',     // Page title
            'Rejected Member',     // Menu title
            'manage_options',   // Capability required to access the page
            'rejected-member',     // Menu slug
            'boc_rejected_members_page' // Callback function to render the page content
        );

        // Add the submenu page for pending member list
        add_submenu_page(
            'boc-form-page',    // Parent menu slug
            'Pending Member',     // Page title
            'Pending Member',     // Menu title
            'manage_options',   // Capability required to access the page
            'pending-member',     // Menu slug
            'boc_pending_members_page' // Callback function to render the page content
        );

           // Add the submenu page for inactive member list
           add_submenu_page(
            'boc-form-page',    // Parent menu slug
            'inactive Member',     // Page title
            'inactive Member',     // Menu title
            'manage_options',   // Capability required to access the page
            'inactive-member',     // Menu slug
            'boc_inactive_members_page' // Callback function to render the page content
        );


        // Add the submenu page for view users data
       add_submenu_page(
        'boc-form-page',    // Parent menu slug
        'Users Data',     // Page title
        '',     // Menu title
        'manage_options',   // Capability required to access the page
        'view-boc-member',     // Menu slug
        'boc_view_user_data' // Callback function to render the page content
    );





}
add_action('admin_menu', 'boc_form_menu_page');

// Callback function to render the page content
function boc_form_page_content() {
    // Include the template file for the BOC Form page
    include(plugin_dir_path(__FILE__) . 'templates/boc-form-page.php');
}

function boc_manual_registration() {
    include(plugin_dir_path(__FILE__) . 'templates/manual-registration.php');
}
function boc_members_list_page() {
    include(plugin_dir_path(__FILE__) . 'templates/members-list.php');
}
function boc_approved_members_page() {
    include(plugin_dir_path(__FILE__) . 'templates/approved.php');
}
function boc_rejected_members_page() {
    include(plugin_dir_path(__FILE__) . 'templates/rejected.php');
}
function boc_pending_members_page() {
    include(plugin_dir_path(__FILE__) . 'templates/pending-review.php');
}
function boc_inactive_members_page() {
    include(plugin_dir_path(__FILE__) . 'templates/inactive.php');
}

function boc_view_user_data() {
    include(plugin_dir_path(__FILE__) . 'templates/view-user.php');
}

function frontend_form(){
    ob_start();
    include 'templates/frontend-form.php';
    return ob_get_clean(); 
}
add_shortcode('frontend_registration', 'frontend_form'); 



function show_life_member(){
    ob_start();
    include 'templates/life-member.php';
    return ob_get_clean(); 
}
add_shortcode('show_life_member_shortcode', 'show_life_member'); 


function show_general_member(){
    ob_start();
    include 'templates/general-member.php';
    return ob_get_clean(); 
}
add_shortcode('show_general_member_shortcode', 'show_general_member'); 




function show_member_details_frontend($templates) {
    $templates['member-details.php'] = 'Member Details';
    return $templates;
}
add_filter('theme_page_templates', 'show_member_details_frontend');


function show_member_details_frontend_shortcode($atts) {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'templates/member-details.php');
    return ob_get_clean();
}

add_shortcode('member_details_shortcode', 'show_member_details_frontend_shortcode');



// smtp details 

function mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '6e380d75012caa';
    $phpmailer->Password = '3a6c7363c5dc8f';
  }
  
  add_action('phpmailer_init', 'mailtrap');





  function sslcommerz_payment_handler() {
 
    // ssl
    /* PHP */
    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
    // Prepare the data to be sent in the POST request
    $post_data = array(
        'store_id' => "anmta64c0f40b25788",
        'store_passwd' => "anmta64c0f40b25788@ssl",
        'total_amount' => "20000",
        'currency' => "BDT",
        'tran_id' => "SSLCZ_TEST_" . uniqid(),
        'success_url' => "http://www.packetbd.com/wp_test/success/",
        'fail_url' => "http://www.packetbd.com/wp_test/fail/",
        'cancel_url' => "http://www.packetbd.com/wp_test/cancel/",
        'emi_option' => "1",
        'emi_max_inst_option' => "9",
        'emi_selected_inst' => "9",
        'cus_name' => "Test Customer",
        'cus_email' => "test@test.com",
        'cus_add1' => "Dhaka",
        'cus_add2' => "Dhaka",
        'cus_city' => "Dhaka",
        'cus_state' => "Dhaka",
        'cus_postcode' => "1000",
        'cus_country' => "Bangladesh",
        'cus_phone' => "01711111111",
        'cus_fax' => "01711111111",
        'ship_name' => "testanmtam1gp",
        'ship_add1' => "Dhaka",
        'ship_add2' => "Dhaka",
        'ship_city' => "Dhaka",
        'ship_state' => "Dhaka",
        'ship_postcode' => "1000",
        'ship_country' => "Bangladesh",
        'value_a' => "ref001",
        'value_b' => "ref002",
        'value_c' => "ref003",
        'value_d' => "ref004",
        'cart' => json_encode(array(
            array("product" => "DHK TO BRS AC A1", "amount" => "200.00"),
            array("product" => "DHK TO BRS AC A2", "amount" => "200.00"),
            array("product" => "DHK TO BRS AC A3", "amount" => "200.00"),
            array("product" => "DHK TO BRS AC A4", "amount" => "200.00")
        )),
        'product_amount' => "100",
        'vat' => "5",
        'discount_amount' => "5",
        'convenience_fee' => "3"
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
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
	# header("Location: ". $sslcz['GatewayPageURL']);
	exit;
} else {
	echo "JSON Data parsing error!";
}





    ob_start();
    ?>
    <!-- Your HTML/JS code for the payment button or form goes here -->
    <?php
    return ob_get_clean();
}
add_shortcode('sslcommerz_payment', 'sslcommerz_payment_handler');
