
<?php
wp_head(); 
?>


<div class="wrap">
<h2> View User Details  </h2> 
<?php
 global $wpdb; 
$id = $_GET['id'];
$table_name = $wpdb->prefix . 'boc_registration_form';
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id );
$data = $wpdb->get_row($query);
?>

<table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
            <th><?php echo $data->name ; ?><?php echo $id ; ?> : </th>
        </tr>
    </thead>
<tbody>


    <tr><td> Name : <?php echo $data->name ; ?></td></tr>
    <tr><td> Date of Birth : <?php echo $data->dob ; ?> </td></tr>
    <tr><td> Present Designation: <?php echo $data->present_designation ; ?>  </td></tr>
    <tr><td> Father's Name: <?php echo $data->father_name ; ?>  </td></tr>
    <tr><td> Mother's Name: <?php echo $data->mother_name ; ?>  </td></tr>
    <tr><td> Spouse  Name: <?php echo $data->spouse_name ; ?> </td></tr>
    <tr><td> Profession of Spouse : <?php echo $data->spouse_profession ; ?> </td></tr>
    <tr><td> Number of Children:  <?php echo $data->num_children ; ?>  </td></tr>
    <tr><td> Nationality:  <?php echo $data->nationality ; ?> </td></tr>
    <tr><td> E-mail Address: <?php echo $data->email ; ?>  </td></tr>
    <tr><td> National ID No: <?php echo $data->national_id_no ; ?>  </td></tr>
    <tr><td> NID Image : <img src="#" alt="nid-image"> </td></tr>
    <tr><td> Passport No: <?php echo $data->passport_no ; ?>  </td></tr>
    <tr><td> Mobile No: <?php echo $data->mobile_no ; ?>  </td></tr>
    <tr><td> Cell Phone : <?php echo $data->cell_phone ; ?>  </td></tr>
    <tr><td> Present Address:  <?php echo $data->present_address ; ?> </td></tr>
    <tr><td> Permanent Address:  <?php echo $data->permanent_address ; ?>  </td></tr>
    <tr><td> BMDC Registration No:  <?php echo $data->bmdc_registration_no ; ?>   </td></tr> 
    <tr><td> Membership type : Life type member </td></tr>

</tbody>
</table>
</div>





<?php wp_footer(); ?>