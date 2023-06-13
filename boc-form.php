<?php
/**
 * Plugin Name: BOC Form
 * Description: A plugin for creating custom forms for BOC.
 * Version: 1.0.0
 * Author: Tanvirul Karim
 */

// Activate the plugin
function boc_form_activate() {
    // Add any activation tasks here
}
register_activation_hook( __FILE__, 'boc_form_activate' );

// Deactivate the plugin
function boc_form_deactivate() {
    // Add any deactivation tasks here
}
register_deactivation_hook( __FILE__, 'boc_form_deactivate' );




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


}
add_action('admin_menu', 'boc_form_menu_page');

// Callback function to render the page content
function boc_form_page_content() {
    // Include the template file for the BOC Form page
    include(plugin_dir_path(__FILE__) . 'templates/boc-form-page.php');
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
