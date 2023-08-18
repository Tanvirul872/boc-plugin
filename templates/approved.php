
<?php
/*
Template Name: Approved Members
*/
wp_head(); 
?>

<div class="boc-form-container">
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=members-list'); ?>">
            Members List
        </a>
    </div> 
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=pending-member'); ?>">
            Pending Review
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=approved-member'); ?>">
            Approved
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=rejected-member'); ?>">
            Rejected
        </a>
    </div>

    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=inactive-member'); ?>">
            Inactive
        </a>
    </div>
</div>





<div class="wrap">
<h2> Approved Members </h2>

<table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Date of Birth</th>
            <th>Father's name</th>
            <th>Mother's name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
<tbody>


<?php
 global $wpdb; 
 // Define the table name with the WordPress prefix
 $table_name = $wpdb->prefix . 'boc_registration_form';
 $items_per_page = 2;
 if(isset($_GET['paged'])){
  $current_page = max(1, $_GET['paged']); 
 }else{
     $current_page = 1; 
 }
 $offset = ($current_page - 1) * $items_per_page;
 $results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 3 LIMIT $items_per_page OFFSET $offset");

// $results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 3");
// Loop through the results and display data
foreach ($results as $result) {
    $member_id = $result->id;
    $name = $result->name;
    $image = $result->signature_image;
    $personal_img = $result->personal_img;
    $dob = $result->dob;
    $father = $result->father_name;
    $mother = $result->mother_name;


   $view_link = admin_url('admin.php?page=view-boc-member').'&id='.$member_id; 
   $edit_link = admin_url('admin.php?page=edit-boc-member').'&id='.$member_id; 


    // Display the data in the HTML table format
    echo '<tr>';
    echo '<td>' . $name . '</td>'; 
    echo '<td><img class="profile_image" src="' . $personal_img . '"height="20px"  width="20px"  alt="Profile Image"></td>';
    echo '<td>' . $dob . '</td>';
    echo '<td>' . $father . '</td>';
    echo '<td>' . $mother . '</td>';
    echo '<td>';
    // echo '<a href="#" class="btn-approve">Approved</a>';
    echo '<a href="'.$edit_link.'" class="btn-approve" member_id='.$member_id.'>Edit</a>'; 
    echo '<a href="'.$view_link.'" class="btn-view" member_id='.$member_id.'>View</a>'; 
    echo '</td>';
    echo '<td><a href="#" class="btn-inactive make_inactive" id="'. $member_id .'">Make Inactive</a></td>';
    echo '</tr>';
}

$total_pages = ceil($wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 3") / $items_per_page);
$pagination_args = array(
    'base' => add_query_arg('paged', '%#%'),
    'format' => '',
    'total' => $total_pages,
    'current' => $current_page,
    'show_all' => false,
    'prev_next' => true,
    'prev_text' => '&laquo; Previous',
    'next_text' => 'Next &raquo;',
); 

// print_r($total_pages ) ;
?>

</tbody>
</table>
<?php 
echo '<div class="pagination">';
echo paginate_links($pagination_args);
echo '</div>';
?>
</div>

<?php wp_footer(); ?>