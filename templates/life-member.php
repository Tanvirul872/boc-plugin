<?php wp_head(); ?>

<h2>  this is a page for life member  </h2>

<div class="container-fluid">

<!-- Another variation with a button -->
<form >
<div class="input-group">
  <input type="text" class="form-control" name="search_doctor" placeholder="Search doctor/member">
  <div class="input-group-append">
    <input type="submit" value="search">
  </div>
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
  $results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 3 AND membership_type = 1 LIMIT $items_per_page OFFSET $offset");
  // Loop through the results and display data
  foreach ($results as $result) {

    $name = $result->name;
    $personal_img = $result->personal_img;
    $mobile_no = $result->mobile_no;
    $present_designation = $result->present_designation;
    $member_id = $result->id;

    $view_link = admin_url('admin.php?page=view-boc-member') . '&id=' . $member_id;

    ?>
    <div class="col-md-6">
      <div class="card">
        <img src="<?php echo $personal_img; ?>" class="card-img-top" alt="profile_image">
        <div class="card-body">
          <h5 class="card-title"><?php echo $name; ?></h5>
          <p class="card-text"><?php echo $present_designation; ?></p>
          <p class="card-text"><?php echo $mobile_no; ?></p>
        </div>
      </div>
    </div>
  <?php } ?>

</div>

<?php
// Calculate the total number of items
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 3 AND membership_type = 1");
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