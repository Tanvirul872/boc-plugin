
<?php
/*
Template Name: Members list
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



<div class="boc-form-container">
    <div class="boc-form-box">
        <a href="#">
            Life Members 
        </a>
    </div> 
    <div class="boc-form-box">
        <a href="#">
           General Members
        </a>
    </div>
    <div class="boc-form-box">
        <a href="#">
           EC Members
        </a>
    </div>

    <div class="boc-form-box">
       
    </div>

</div>


<div class="wrap">
<h2> All Members </h2>
<table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Date of Birth</th>
            <th>Father's name</th>
            <th>Mother's name</th>
            <th>Status</th>
        </tr>
    </thead>
<tbody>
<?php
 global $wpdb; 
// Define the table name with the WordPress prefix
$table_name = $wpdb->prefix . 'boc_registration_form';
// Retrieve rows with status = 1
$results = $wpdb->get_results("SELECT * FROM $table_name");
// Loop through the results and display data
foreach ($results as $result) {
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
    if($result->status==1){
        echo '<a href="#" class="btn btn-pending">Pending</a>';
    }elseif($result->status==2){
        echo '<a href="#" class="btn btn-inactive">Inactive</a>';
    }elseif($result->status==3){
        echo '<a href="#" class="btn btn-approve">Approved</a>';
    }elseif($result->status==4){
        echo '<a href="#" class="btn btn-reject">Rejected</a>';
    }
  
   
   
    echo '</td>';
    echo '</tr>';
}

?>

</tbody>
</table>
</div>

<?php wp_footer(); ?>