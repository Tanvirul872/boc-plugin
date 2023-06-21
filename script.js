
jQuery(document).ready(function($){


$('#boc_registration').submit(function (event) {
    event.preventDefault();
  
    var ajax_url = plugin_ajax_object.ajax_url;
    var form = $('#boc_registration').serialize();
    var data = {
        'action': 'boc_registration_data',
        'formData': form
  
    };
  
    $.ajax({
        url: ajax_url,
        type: 'post',
        data: data,
        success: function(response){
          // console.log(coupon_code);
            alert('successfully store data') ;
        }
    });
  
  });


  // manual registration from admin dashboard 
  $('#boc_registration_manual').submit(function (event) {
    event.preventDefault();
 

    alert('manual registration')
    var ajax_url = plugin_ajax_object.ajax_url;
    var form = $('#boc_registration_manual').serialize();
    var data = {
        'action': 'boc_registration_data_manual',
        'formData': form
  
    };
  
    $.ajax({
        url: ajax_url,
        type: 'post',
        data: data,
        success: function(response){
            alert('Successfully store manual registration data') ;
            // $('#boc_registration_manual').reset() ; 
            location.reload() ; 
        }
    });
  
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



});

