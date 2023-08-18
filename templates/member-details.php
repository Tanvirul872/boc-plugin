<?php
// Template Name: Member Details

// get_header();

// Get the member ID from the query string
$member_id = $_GET['id'];

// Query the database to retrieve the member details
global $wpdb;
$table_name = $wpdb->prefix . 'boc_registration_form';
$member_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $member_id");

// Check if the member details are found
if ($member_details) {

    
    $member_id = $member_details->member_id;
    $present_address = $member_details->present_address;
    $bmdc_registration_no = $member_details->bmdc_registration_no;
    $name = $member_details->name;
    $personal_img = $member_details->personal_img;
    $mobile_no = $member_details->mobile_no;
    $present_designation = $member_details->present_designation;
    $educational_qualification = json_decode($member_details->educational_qualification,true);
    if ($member_details->membership_type==1){ 
        $membership_type = 'Life Member' ;
    }else{ 
        $membership_type = 'General Member';
    }
    
    // Display the member details
    // echo '<h2>Member Details</h2>';
    // echo '<div class="card">';
    // echo '<img src="' . $personal_img . '" class="card-img-top" alt="profile_image">';
    // echo '<div class="card-body">';
    
    // echo '<h5 class="card-title">' . $name . '</h5>';
    // echo '<p class="card-text">' . $membership_type . '</p>';
    // echo '<p class="card-text">' . $present_designation . '</p>';
    // echo '<p class="card-text">' . $mobile_no . '</p>';
    // echo '<p class="card-text">' . $member_id . '</p>';
    // echo '<p class="card-text">' . $present_address . '</p>';
    // echo '<p class="card-text">' . $bmdc_registration_no . '</p>';


    ?>


<table>
	<tbody>
		<tr>
		<td colspan="2">
			<img class="profile_frontend" src="<?php echo $personal_img; ?>">
		</td>
		</tr>
        <tr>
			<th>Member Type :</th>
			<td>  <?php echo $membership_type; ?>  </td>
		</tr> 
		<tr>
			<th>Member Id :</th>
			<td>  <?php echo $member_id; ?>  </td>
		</tr> 
		<tr>
			<th>Name :</th>
			<td><?php echo $name; ?></td>
		</tr> 
		<tr>
			<th>Designation :</th>
			<td> <?php echo $present_designation; ?>    </td>
		</tr>  
		<tr>
			<th>Phone :</th>
			<td> <?php echo $mobile_no; ?>   </td>
		</tr> 
		<tr>
			<th>Present Address :</th>
			<td> <?php echo $present_address; ?>   </td>
		</tr> 
		<tr>
			<th>BMDC Registration No :</th>
			<td> <?php echo $bmdc_registration_no; ?>  </td>
		</tr> 
	</tbody>
</table>




<!-- Educational Qualification --> 

<table class="table table-bordered text-center">
	<thead>
	  <tr>
		<th colspan="3">Qualification</th>
	  </tr>
	</thead>
	<tbody> 
    <tr>
        <td>Degree</td>
        <td>Year</td>
        <td>Institution</td>
	</tr>
<?php

    foreach($educational_qualification as $edu_quali){ 
        $edu_degree =  $edu_quali[0] ;
        $edu_year =  $edu_quali[1] ;
        $edu_institute =  $edu_quali[2] ;
        ?>
        <tr>
            <tr>
            <td><?php echo  $edu_degree ; ?></td>
            <td><?php echo  $edu_year ; ?></td>
            <td><?php echo  $edu_institute ; ?></td>
         </tr>

   <?php } ?>
</tbody>
</table>

  <?php } else {
    // Member details not found
    echo '<p>Member not found.</p>'; }

// get_footer();
?>
