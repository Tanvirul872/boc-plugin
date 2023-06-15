
jQuery(document).ready(function($){


$('#boc_registration').submit(function (event) {
    event.preventDefault();
  

    alert('hello world') ;


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





});

