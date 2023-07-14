
jQuery(document).ready(function($){

//frontent registration form 

$('#boc_registration').submit(function (event) {
    event.preventDefault();
  
    alert('boc_registration')  

  var password = $('#password').val();
  var confirmPassword = $('#confirm_password').val();

  if (password !== confirmPassword) {
    alert('Password does not match!');
    return; // Prevent form submission
  }else{ 
    
    var ajax_url = plugin_ajax_object.ajax_url;     
    // Get the educational certificate files
  
    var form = $('#boc_registration').serialize();

    var formData = new FormData ;  
    formData.append('action','boc_registration_data') ;;
    formData.append('signature_img', jQuery('#signature_img')[0].files[0]); 
    formData.append('nid_image', jQuery('#nid_image')[0].files[0]);  
    formData.append('personal_img', jQuery('#personal_img')[0].files[0]);  
       
    var eduCertificates = $('.edu_certificate');
    // Loop through each educational certificate file input field
    for (var i = 0; i < eduCertificates.length; i++) {
        var files = eduCertificates[i].files;
        // Loop through each selected file for the current educational certificate
        for (var j = 0; j < files.length; j++) {
        formData.append('edu_certificate[]', files[j]);
        }
    } 

    formData.append('boc_registration_data', form ) ;

    $.ajax({
        url: ajax_url,
        data: formData,
        processData:false,
            contentType:false,
            type:'post',
        // data: data,
        
        success: function(response){
          // console.log(coupon_code);
            alert('successfully store data') ;
        }
    });
  }     
  
  

  
  });


  // manual registration from admin dashboard 
  $('#boc_registration_manual').submit(function (event) {
    event.preventDefault();
 


    var password = $('#password_manual').val();
    var confirmPassword = $('#confirm_password_manual').val();

  if (password !== confirmPassword) {
    alert('Password does not match!');
    return; // Prevent form submission
  }else{ 
    
    var ajax_url = plugin_ajax_object.ajax_url;     
    // Get the educational certificate files
  
    var form = $('#boc_registration_manual').serialize();

    var formData = new FormData ;  
    formData.append('action','boc_registration_data_manual') ;;
    formData.append('signature_img', jQuery('#signature_img_manual')[0].files[0]); 
    formData.append('nid_image', jQuery('#nid_image_manual')[0].files[0]);  
    formData.append('personal_img', jQuery('#personal_img_manual')[0].files[0]);  
       
    var eduCertificates = $('.edu_certificate');
    // Loop through each educational certificate file input field
    for (var i = 0; i < eduCertificates.length; i++) {
        var files = eduCertificates[i].files;
        // Loop through each selected file for the current educational certificate
        for (var j = 0; j < files.length; j++) {
        formData.append('edu_certificate[]', files[j]);
        }
    } 

    formData.append('boc_registration_data_manual', form ) ;

    $.ajax({
        url: ajax_url,
        data: formData,
        processData:false,
            contentType:false,
            type:'post',
        // data: data,
        
        success: function(response){
          // console.log(coupon_code);
            alert('successfully store data') ;
        }
    });
  }     
  







  
  });






  // Approve member 
  $('.member-approve').click(function (event) {
    event.preventDefault();

    var member_id = $(this).attr('member_id');
    var ajax_url = plugin_ajax_object.ajax_url;
    var data = {
        'action': 'approve_member',
        'formData': member_id
    };
  
    $.ajax({
        url: ajax_url,
        type: 'post',
        data: data,
        success: function(response){
            alert('Member Approved Successfully') ; 
            location.reload(); 
        }
    });
  
  })



   // Reject member 
   $('.member-reject').click(function (event) {
    event.preventDefault();
    var member_id = $(this).attr('member_id');
    var ajax_url = plugin_ajax_object.ajax_url;
    var data = {
        'action': 'reject_member',
        'formData': member_id
    };
    $.ajax({
        url: ajax_url,
        type: 'post',
        data: data,
        success: function(response){
            alert('Member Rejected Successfully') ; 
            location.reload(); 
        }
    });
  })


  // Inactive member 
  $('.member-inactive').click(function (event) {
  event.preventDefault();
  var member_id = $(this).attr('member_id');
  var ajax_url = plugin_ajax_object.ajax_url;
  var data = {
      'action': 'inactive_member',
      'formData': member_id
  };
  $.ajax({
      url: ajax_url,
      type: 'post',
      data: data,
      success: function(response){
          alert('Member Inactive Successfully') ; 
          location.reload(); 
      }
  });
})




// add new item in form 



	
	$("#extend").click(function(e){
		e.preventDefault();
		// $("#extend-field").append('<div><input type="text"><a class="add-text-field"><button>+</button></a><a class="remove-extend-field"><button>-</button></a>');
        $("#extend-field").append('<div class="educational_qualification"><input type="text" name="edu_degree[]" id="edu_degree" placeholder="Degree" ><input type="text" name="edu_year[]" id="edu_year"  placeholder="Year"><input type="text" name="edu_institute[]" id="edu_institute"  placeholder="Institution" > <input type="file" name="edu_certificate[]" class="edu_certificate" accept="image/*" multiple><a class="add-text-field"><button>+</button></a><a class="remove-extend-field"><button>-</button></a>');
    });

	
	$("#extend-field").on("click",".add-text-field",function(e){
		e.preventDefault();
        $("#extend-field").append('<div class="educational_qualification"><input type="text" name="edu_degree[]" id="edu_degree" placeholder="Degree" ><input type="text" name="edu_year[]" id="edu_year"  placeholder="Year"><input type="text" name="edu_institute[]" id="edu_institute"  placeholder="Institution" > <input type="file" name="edu_certificate[]" class="edu_certificate" accept="image/*" multiple><a class="add-text-field"><button>+</button></a><a class="remove-extend-field"><button>-</button></a>');
		
	});

	$("#extend-field").on("click",".remove-extend-field",function(e){
		e.preventDefault();
		$(this).parent('div').remove();
	});

	







});

