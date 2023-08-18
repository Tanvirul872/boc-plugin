
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

<table class="wp-list-table widefat fixed striped posts view_user_table">
    <thead>
        <tr>
            <th><?php echo $data->name ; ?>  </th>
        </tr>
    </thead>
<tbody>


    <tr><td> <span> Member Id : </span>  <?php echo $data->member_id ; ?></td></tr>
    <tr><td> <span> Name : </span>   <?php echo $data->name ; ?></td></tr>
    <tr><td> <span> Profile Image : </span>  <img  class="profile_image" src="<?php echo $data->personal_img ; ?>" alt="personal-image"> </td></tr>
    <tr><td> <span> Date of Birth : </span>   <?php echo $data->dob ; ?> </td></tr>
    <tr><td> <span> Present Designation: </span>   <?php echo $data->present_designation ; ?>  </td></tr>
    <tr><td> <span> Father's Name:  </span> <?php echo $data->father_name ; ?>  </td></tr>
    <tr><td> <span> Mother's Name: </span>   <?php echo $data->mother_name ; ?>  </td></tr>
    <tr><td> <span> Spouse  Name: </span>   <?php echo $data->spouse_name ; ?> </td></tr>
    <tr><td> <span> Profession of Spouse : </span>   <?php echo $data->spouse_profession ; ?> </td></tr>
    <tr><td> <span> Number of Children:  </span>   <?php echo $data->num_children ; ?>  </td></tr>
    <tr><td> <span> Nationality: </span>   <?php echo $data->nationality ; ?> </td></tr>
    <tr><td> <span> E-mail Address: </span>   <?php echo $data->email ; ?>  </td></tr>
    <tr><td> <span> National ID No: </span> <?php echo $data->national_id_no ; ?>  </td></tr>
    <tr><td> <span> NID Image : </span>   <img class="profile_image" src="<?php echo $data->nid_image ; ?>" alt="nid-image"> </td></tr>
    <tr><td> <span> Singnature Image : </span>  <img  class="profile_image" src="<?php echo $data->signature_image ; ?>" alt="signature-image"> </td></tr>
    <tr><td> <span> Passport No:  </span>  <?php echo $data->passport_no ; ?>  </td></tr>
    <tr><td> <span> Mobile No: </span>   <?php echo $data->mobile_no ; ?>  </td></tr>
    <tr><td> <span> Cell Phone : </span>  <?php echo $data->cell_phone ; ?>  </td></tr>
    <tr><td> <span> Present Address: </span>   <?php echo $data->present_address ; ?> </td></tr>
    <tr><td> <span> Permanent Address:  </span>   <?php echo $data->permanent_address ; ?>  </td></tr>
    <tr><td> <span> BMDC Registration No: </span>   <?php echo $data->bmdc_registration_no ; ?>   </td></tr> 
    <tr><td> <span> Membership type : </span>   <?php if ($data->membership_type==1){ echo 'Life Member' ;}else{ echo 'General Member';}  ?> </td></tr>


    <?php  $edu_qualification = json_decode( $data->educational_qualification ) ;  
    //   echo '<pre>' ; 
    //     print_r($edu_qualification) ; 
    //     echo '</pre>' ; 
    ?>


    <tr><td> <span> Educational Qualification  : </span> <br>
          
        <?php foreach($edu_qualification as $edu_quali){  ?> 

            <span> Degree : </span>   <?php echo $edu_quali[0] ;?> <br>
            <span> Year :  </span> <?php echo $edu_quali[1] ;?> <br>
            <span> Institution : </span>  <?php echo $edu_quali[2] ;?> <br>
            <span> Certificate : </span>  <img data-enlargable class="profile_image" src="<?php echo $edu_quali[3] ;?>" > <br><br><br>
               
        <?php  }?>
    
    </td></tr>


</tbody>
</table>
</div>





<?php wp_footer(); ?>