<?php
wp_head(); 
?>


<h2>  this is a frontend form.  </h2>

<form action="#" id="boc_registration" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" >
  </div>
  
  <div class="form-group">
    <label for="dob">Date of Birth:</label>
    <input type="date" class="form-control" id="dob" name="dob" >
  </div>
  <div class="form-group">
    <label for="designation">Present Designation:</label>
    <input type="text" class="form-control" id="designation" name="designation" >
  </div>
  <div class="form-group">
    <label for="father">Father's Name:</label>
    <input type="text" class="form-control" id="father" name="father" >
  </div>
  <div class="form-group">
    <label for="mother">Mother's Name:</label>
    <input type="text" class="form-control" id="mother" name="mother" >
  </div>
  <div class="form-group">
    <label for="spouse">Spouse Name:</label>
    <input type="text" class="form-control" id="spouse" name="spouse">
  </div>
  <div class="form-group">
    <label for="spouse_profession">Profession of Spouse:</label>
    <input type="text" class="form-control" id="spouse_profession" name="spouse_profession">
  </div>
  <div class="form-group">
    <label for="children">Number of Children:</label>
    <input type="number" class="form-control" id="children" name="children">
  </div>
  <div class="form-group">
    <label for="nationality">Nationality:</label>
    <input type="text" class="form-control" id="nationality" name="nationality" >
  </div>
  <div class="form-group">
    <label for="email">E-mail Address:</label>
    <input type="email" class="form-control" id="email" name="email" >
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
  </div>
  <div class="form-group">
    <label for="nid">National ID No:</label>
    <input type="text" class="form-control" id="nid" name="nid" >
  </div>
  <div class="form-group">
    <label for="nid_image">Upload NID Image:</label>
    <input type="file" class="form-control-file" id="nid_image" name="nid_image" accept="image/*" >
  </div>
  <div class="form-group">
    <label for="passport">Passport No:</label>
    <input type="text" class="form-control" id="passport" name="passport" >
  </div>
  <div class="form-group">
    <label for="mobile">Mobile No:</label>
    <input type="tel" class="form-control" id="mobile" name="mobile" >
  </div>
  <div class="form-group">
    <label for="cellphone">Cell Phone:</label>
    <input type="tel" class="form-control" id="cellphone" name="cellphone">
  </div>
  <div class="form-group">
    <label for="present_address">Present Address:</label>
    <textarea class="form-control" id="present_address" name="present_address" rows="3" ></textarea>
  </div>
  <div class="form-group">
    <label for="permanent_address">Permanent Address:</label>
    <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3" ></textarea>
  </div>
  <div class="form-group">
    <label for="bmdc_registration">BMDC Registration No:</label>
    <input type="text" class="form-control" id="bmdc_registration" name="bmdc_registration_no" >
  </div>
  <div class="form-group">
    <label for="dropdown">Membership Dropdown:</label>
    <select class="form-control" id="membership_dropdown" name="membership_dropdown">
      <option value="1">Life Member</option>
      <option value="2">General Member</option>
    </select>
  </div>
  <div class="form-group">
    <label for="signature">Upload Signature Image:</label>
    <input type="file" class="form-control-file" id="signature_img" name="signature" accept="image/*" >
  </div>
  <div class="form-group">
    <label for="signature">Upload Your Image:</label>
    <input type="file" class="form-control-file" id="personal_img" name="personal_img" accept="image/*" >
  </div>



  <h1>Educational Qualification</h1>
  <div class="educational_qualification">
      <input type="text" name="edu_degree[]" id="edu_degree" placeholder="Degree" >
      <input type="text" name="edu_year[]" id="edu_year"  placeholder="Year">
      <input type="text" name="edu_institute[]" id="edu_institute"  placeholder="Institution" > 
      <input type="file" name="edu_certificate[]" class="edu_certificate" accept="image/*" multiple> 
    <button id="extend">Add</button>

    <div id="extend-field"></div>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="#" class="btn ssl-pay" id="sslcomerze-pay" style="display:none;" >Pay</a>


</form>



<?php
wp_footer();
?>