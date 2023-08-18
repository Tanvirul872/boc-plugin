<?php 


// import by csv code start 


// Handle the CSV import
function handle_csv_import() { 

?>
<!-- html code  -->
<div class="wrap">
      <h2>CSV Import</h2>
      <form method="post" action="" enctype="multipart/form-data">
          <input type="file" name="csv_file" accept=".csv">
          <?php wp_nonce_field('csv_import_nonce', 'csv_import_nonce'); ?>
          <input type="submit" name="submit" value="Import CSV">
      </form>
</div>

<?php 
  global $wpdb;
  $table_name = $wpdb->prefix . 'boc_registration_form';
  $total_member = $wpdb->get_results("SELECT * FROM $table_name");
  if($total_member){
    $total_count = count($total_member);
  }else{
    $total_count = 0 ;
  }
  
 
  
?>

<h2> You have <?php echo $total_count; ?>  member now </h2>

<?php


  if (isset($_POST['submit']) && isset($_FILES['csv_file'])) {
      if (!wp_verify_nonce($_POST['csv_import_nonce'], 'csv_import_nonce')) {
          die('Security check failed');
      }

      $csv_file = $_FILES['csv_file']['tmp_name'];
      $imported_data = array();

      if (($handle = fopen($csv_file, "r")) !== false) {
          $header_skipped = false; // Flag to skip the first row
          while (($data = fgetcsv($handle, 1000, ",")) !== false) {
              if (!$header_skipped) {
                  $header_skipped = true;
                  continue; // Skip the header row
              }
              // Process and save each row to the imported_data array
              $imported_data[] = $data;
          }
          fclose($handle);
      }

      // Now, let's save the data to the database
      global $wpdb;
      $table_name = $wpdb->prefix . 'boc_registration_form';
      foreach ($imported_data as $row) { 
        $member_id = $row[1];
        // Check if member_id already exists in the database
        $existing_member = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM $table_name WHERE member_id = %s", $member_id)
        );
  
        if (!$existing_member) {
          $data_to_insert = array(
              // 'id' => $row[0], // Assuming id is auto-incremented and you're skipping it in the CSV
              'member_id' => $row[1],
              'name' => $row[2],
              'dob' => $row[3],
              'present_designation' => $row[4],
              'father_name' => $row[5],
              'mother_name' => $row[6],
              'spouse_name' => $row[7],
              'spouse_profession' => $row[8],
              'num_children' => $row[9],
              'nationality' => $row[10],
              'email' => $row[11],
              'password' => $row[12],
              'national_id_no' => $row[13],
              'nid_image' => $row[14],
              'passport_no' => $row[15],
              'mobile_no' => $row[16],
              'cell_phone' => $row[17],
              'present_address' => $row[18],
              'permanent_address' => $row[19],
              'bmdc_registration_no' => $row[20],
              'signature_image' => $row[21],
              'personal_img' => $row[22],
              'membership_type' => $row[23],
              'educational_qualification' => $row[24],
              // 'status' => $row[25],
              'status' => 1,
              
              
              // ... continue with the other fields ...
          );

          $wpdb->insert($table_name, $data_to_insert);
        }
      }
  }
}
add_action('admin_post_import_csv', 'handle_csv_import');





// import by csv code end  



?>