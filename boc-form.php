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
        membership_type INT, 
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

    // JavaScript
    wp_enqueue_script( 'script-js', plugins_url( '/script.js', __FILE__ ),array('jquery'));

    // Pass ajax_url to script.js
    wp_localize_script( 'script-js', 'plugin_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}



// Add the BOC Form menu page
function boc_form_menu_page() {
    add_menu_page(
        'BOC Form',          // Page title
        'BOC Form',          // Menu title
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


