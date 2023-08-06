<?php wp_head(); ?>

<h2>  this is a page for general member  </h2>

<div class="container-fluid">

<!-- Another variation with a button -->
<form >
<div class="input-group">
  <input type="text" class="form-control" name="search_doctor" placeholder="Search doctor/member">
  <div class="input-group-append">
    <input type="submit" value="search">
  </div>
  <?php 
     $current_page = get_post(get_the_ID());
     $current_slug = $current_page->post_name;
     $running_url = home_url().'/'.$current_slug ; 
     
   ?>
  <a href="<?php echo  $running_url ; ?>" class="btn btn-success">Reset</a>
</div>
</form>


<div class="row">
  <?php
  global $wpdb;
  // Define the table name with the WordPress prefix
  $table_name = $wpdb->prefix . 'boc_registration_form';
  // Define the number of items per page
  $items_per_page = 2;
  // Get the current page number
  $current_page = max(1, get_query_var('paged'));
  // Calculate the offset
  $offset = ($current_page - 1) * $items_per_page;
  // Retrieve rows with status = 3 and membership_type = 1

  // Retrieve the value of search_doctor from $_GET
  $search_doc = isset($_GET['search_doctor']) ? $_GET['search_doctor'] : '';

// Prepare the SQL query based on whether $search_doc has a value or not
if (!empty($search_doc)) {
    // If $search_doc has a value, use it to filter the results
    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name 
            WHERE (status = 3 AND membership_type = 2) 
            AND (name LIKE '%%%s%%' OR member_id LIKE '%%%s%%') 
            LIMIT %d OFFSET %d",
            $search_doc, // Search for the value of $search_doc in the field_name column
            $search_doc, // Search for the value of $search_doc in the member_id column
            $items_per_page,
            $offset
        )
    );
} else {
    // If $search_doc is empty, retrieve rows with status = 3 and membership_type = 1 without any filtering
    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 3 AND membership_type = 2 LIMIT $items_per_page OFFSET $offset");
}  
  // Loop through the results and display data
  foreach ($results as $result) {

    $name = $result->name;
    $personal_img = $result->personal_img;
    $mobile_no = $result->mobile_no;
    $present_designation = $result->present_designation;
    $member_id = $result->id;

    $view_link = get_permalink() . 'member-details?id=' . $member_id;                     
   
    ?>
    <div class="col-md-6">
      <div class="card">
         
      <a href="<?php echo $view_link ; ?>">
        <img src="<?php echo $personal_img; ?>" class="card-img-top" alt="profile_image">
        <div class="card-body">
          <h5 class="card-title"><?php echo $name; ?></h5>
          <p class="card-text"><?php echo $present_designation; ?></p>
          <p class="card-text"><?php echo $mobile_no; ?></p>
       </a>
        </div>
      </div>
    </div>
  <?php } ?>

</div>

<?php
// Calculate the total number of items
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 3 AND membership_type = 2");
// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);
// Define the pagination base URL
$pagination_base_url = get_permalink();
// Generate the pagination links
$pagination_links = paginate_links(array(
  'base'      => $pagination_base_url . '%_%',
  'format'    => 'page/%#%',
  'current'   => $current_page,
  'total'     => $total_pages,
  'prev_text' => '&laquo;',
  'next_text' => '&raquo;',
));
// Display the pagination links
if ($pagination_links) {
  echo '<div class="pagination">' . $pagination_links . '</div>';
}
?>

</div>



<?php wp_footer(); ?>