
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
        <a href="<?php echo admin_url('admin.php?page=pending-member'); ?>">
            Pending Review
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=inactive-member'); ?>">
            Inactive
        </a>
    </div>
</div>




<div class="wrap">
<h2> Pending Members </h2>

<table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Date of Birth</th>
            <th>Father's name</th>
            <th>Mother's name</th>
            <th>Action</th>
        </tr>
    </thead>
<tbody>
<?php
 global $wpdb; 
// Define the table name with the WordPress prefix
$table_name = $wpdb->prefix . 'boc_registration_form';
// Retrieve rows with status = 1
$results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 1");
// Loop through the results and display data
foreach ($results as $result) {
    $member_id = $result->id;
    $name = $result->name;
    $image = $result->signature_image;
    $dob = $result->dob;
    $father = $result->father_name;
    $mother = $result->mother_name;

    // Display the data in the HTML table format
    echo '<tr>';
    echo '<td>' . $name . '</td>';
    echo '<td><img src="' . $image . '" alt="Profile Image"></td>';
    echo '<td>' . $dob . '</td>';
    echo '<td>' . $father . '</td>';
    echo '<td>' . $mother . '</td>';
    echo '<td>';
    echo '<a href="#" class="btn btn-approve member-approve"    member_id='.$member_id.'>Approve</a>';
    echo '<a href="#" class="btn btn-reject member-reject"      member_id='.$member_id.'>Reject</a>';
    echo '<a href="#" class="btn btn-inactive member-inactive"  member_id='.$member_id.'>Inactive</a>';
    echo '</td>';
    echo '</tr>';

}

?>

</tbody>
</table>
</div>

<?php wp_footer(); ?>