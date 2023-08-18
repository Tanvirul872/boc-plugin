

<?php
/*
Template Name: Edit User
*/
wp_head(); 
?>         

   
  <?php 

  $user_id =  $_GET['id'] ;
  global $wpdb;
  $table_name = $wpdb->prefix . 'boc_registration_form'; // Assuming the table has a prefix
  $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $user_id);
  $results = $wpdb->get_results($query);

  ?> 

<h2> Edit User </h2>

<div class="wrap">
<form action="#" id="boc_registration_manual_update" enctype="multipart/form-data">    

<div class="form-group">
    <input type="hidden" class="form-control" id="user_id_manual" name="user_id_manual" value="<?php echo $user_id ; ?>" >
</div>

<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $results[0]->name ; ?>" >
</div>
  
  <div class="form-group">
    <label for="dob">Date of Birth:</label>
    <input type="date" class="form-control" id="dob" name="dob"  value="<?php echo $results[0]->dob ; ?>"  >
  </div>
  <div class="form-group">
    <label for="designation">Present Designation:</label>
    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $results[0]->present_designation ; ?>" >
  </div>
  <div class="form-group">
    <label for="father">Father's Name:</label>
    <input type="text" class="form-control" id="father" name="father"  value="<?php echo $results[0]->father_name ; ?>">
  </div>
  <div class="form-group">
    <label for="mother">Mother's Name:</label>
    <input type="text" class="form-control" id="mother" name="mother"  value="<?php echo $results[0]->mother_name ; ?>">
  </div>
  <div class="form-group">
    <label for="spouse">Spouse Name:</label>
    <input type="text" class="form-control" id="spouse" name="spouse"  value="<?php echo $results[0]->spouse_name ; ?>" > 
  </div>
  <div class="form-group">
    <label for="spouse_profession">Profession of Spouse:</label>
    <input type="text" class="form-control" id="spouse_profession" name="spouse_profession"  value="<?php echo $results[0]->spouse_profession ; ?>" >
  </div>
  <div class="form-group">
    <label for="children">Number of Children:</label>
    <input type="number" class="form-control" id="children" name="children" value="<?php echo $results[0]->num_children ; ?>" >
  </div>
  <div class="form-group">
    <label for="nationality">Nationality:</label>
    <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $results[0]->nationality ; ?>">
  </div>
  <div class="form-group">
    <label for="email">E-mail Address:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $results[0]->email ; ?>">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password_manual" name="password" value="<?php echo $results[0]->password ; ?>" >
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" class="form-control" id="confirm_password_manual" name="confirm_password" value="<?php echo $results[0]->password ; ?>" >
  </div>
  <div class="form-group">
    <label for="nid">National ID No:</label>
    <input type="text" class="form-control" id="nid" name="nid" value="<?php echo $results[0]->national_id_no ; ?>">
  </div>

<div class="form-group">
    <label for="nid_image">Upload NID Image:</label>
    <input type="file" class="form-control-file" id="nid_image_manual" name="nid_image" accept="image/*" value="<?php echo $results[0]->password ; ?>">
    <input type="hidden" class="form-control-file"  name="nid_image_manual_old" value="<?php echo $results[0]->nid_image ; ?>" >

  </div>

<div class="form-group">
    <label for="nid_image"></label>
    <img class="edit_image" src="<?php echo $results[0]->nid_image ; ?>" height="50px" width="50px" alt="nid_image"> 
</div>


  <div class="form-group">
    <label for="passport">Passport No:</label>
    <input type="text" class="form-control" id="passport" name="passport"  value="<?php echo $results[0]->passport_no ; ?>" >
  </div>
  <div class="form-group">
    <label for="mobile">Mobile No:</label>
    <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo $results[0]->mobile_no ; ?>"  >
  </div>
  <div class="form-group">
    <label for="cellphone">Cell Phone:</label>
    <input type="tel" class="form-control" id="cellphone" name="cellphone" value="<?php echo $results[0]->cell_phone ; ?>" >
  </div>
  <div class="form-group">
    <label for="present_address">Present Address:</label>
    <textarea class="form-control" id="present_address" name="present_address" rows="3" >
       <?php echo $results[0]->present_address ; ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="permanent_address">Permanent Address:</label>
    <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3" >
       <?php echo $results[0]->permanent_address ; ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="bmdc_registration">BMDC Registration No:</label>
    <input type="text" class="form-control" id="bmdc_registration" name="bmdc_registration_no" value="<?php echo $results[0]->bmdc_registration_no ; ?>" >
  </div>
  <div class="form-group">
    <label for="dropdown">Membership Dropdown:</label>
    <select class="form-control" id="membership_dropdown" name="membership_dropdown">
      <option value="1" <?php if($results[0]->membership_type == 1){ echo 'selected'; } ?> >Life Member</option>
      <option value="2" <?php if($results[0]->membership_type == 2){ echo 'selected'; } ?>  >General Member</option>
    </select>
  </div>
  <div class="form-group">
    <label for="signature">Upload Signature Image:</label>
    <input type="file" class="form-control-file" id="signature_img_manual" name="signature" accept="image/*" >
    <input type="hidden" class="form-control-file"  name="signature_img_manual_old" value="<?php echo $results[0]->signature_image ; ?>" >

  </div>
  
    <div class="form-group">
        <label for="nid_image"></label>
        <img class="edit_image" src="<?php echo $results[0]->signature_image ; ?>" height="50px" width="50px" alt="signature_image"> 
    </div>

    <div class="form-group">
        <label for="signature">Upload Your Image:</label>
        <input type="file" class="form-control-file" id="personal_img_manual" name="personal_img" accept="image/*" >
        <input type="hidden" class="form-control-file"  name="personal_img_manual_old" value="<?php echo $results[0]->personal_img ; ?>" > 
    </div>

    <div class="form-group">
        <label for="nid_image"></label>
        <img class="edit_image" src="<?php echo $results[0]->personal_img ; ?>" height="50px" width="50px" alt="personal_image"> 
    </div>

    <h1>Educational Qualification</h1> 
    <p><b>Note: </b> If you want to update the <b>certificate image</b> also then you have to update the four image at a time. </p>
    <?php 
        $edu_qualification = json_decode($results[0]->educational_qualification) ; 
        $educationalData = array($edu_qualification); 
    ?>

  <div class="educational_qualification fisrt_item">
      <input type="text" name="edu_degree[]" id="edu_degree" placeholder="Degree" value="<?php echo $educationalData[0][0][0] ?>" >
      <input type="text" name="edu_year[]" id="edu_year"  placeholder="Year" value="<?php echo $educationalData[0][0][1] ?>">
      <input type="text" name="edu_institute[]" id="edu_institute"  placeholder="Institution" value="<?php echo $educationalData[0][0][2] ?>"> 
      <input type="file" name="edu_certificate[]" class="edu_certificate" accept="image/*" multiple> 
      <input type="hidden" name="edu_certificate_old[]"  value="<?php echo $educationalData[0][0][3] ?>" > 
      <img class="edit_image" src="<?php echo $educationalData[0][0][3] ?>" alt="">
    <button id="extend">Add</button>
  </div>


  <div id="extend-field">

  <?php 

    $educationalData = $educationalData[0] ;
  
  for ($i = 1; $i < count($educationalData); $i++) { ?>
        <div class="educational_qualification">
            <input type="text" name="edu_degree[]" id="edu_degree" placeholder="Degree" value="<?php echo $educationalData[$i][0]; ?>">
            <input type="text" name="edu_year[]" id="edu_year" placeholder="Year" value="<?php echo $educationalData[$i][1]; ?>">
            <input type="text" name="edu_institute[]" id="edu_institute" placeholder="Institution" value="<?php echo $educationalData[$i][2]; ?>">
            <input type="file" name="edu_certificate[]" class="edu_certificate" accept="image/*" multiple="">
            <input type="hidden" name="edu_certificate_old[]"  value="<?php echo $educationalData[$i][3]; ?>" > 
            <img class="edit_image" src="<?php echo $educationalData[$i][3]; ?>" alt="">
            <a class="add-text-field"><button>+</button></a>
            <a class="remove-extend-field"><button>-</button></a>
        </div>
    <?php } ?>

</div>


  <button type="submit" class="btn btn-primary manual_submit">Submit</button>
</form>

</div>


<?php wp_footer(); ?>