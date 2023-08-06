<?php
/*
Template Name: BOC Form Page
*/
wp_head(); 
?>



<h2> Settings </h2>



<?php 

global $wpdb; 
$table_name = $wpdb->prefix . 'boc_settings';               
$query = "SELECT * FROM $table_name";
$results = $wpdb->get_results($query, ARRAY_A);

if($results ){

       // Access individual fields using column names
       $id = $results[0]['id'];
       $direct_api_url = $results[0]['direct_api_url'];
       $store_id = $results[0]['store_id'];
       $store_passwd = $results[0]['store_passwd'];
       $total_amount = $results[0]['total_amount'];
       $success_url = $results[0]['success_url'];
       $fail_url = $results[0]['fail_url'];
       $cancel_url = $results[0]['cancel_url'];
       $ship_name = $results[0]['ship_name'];

}else{

         // Access individual fields using column names
         $id = '';
         $direct_api_url = '' ;
         $store_id = '' ;
         $store_passwd = '' ;
         $total_amount = '';
         $success_url = '' ;
         $fail_url = '' ;
         $cancel_url = '' ;
         $ship_name = '' ;

         
}

 

?>
<form action="#" id="boc_settings_form">

<div class="boc-settings-container"> 

    <div class="boc-settings-box">
        <label>Api Url : </label>
        <input type="text" class="form-control" id="direct_api_url" name="direct_api_url" value="<?php echo $direct_api_url; ?>">
    </div> 
    <!-- item end  -->

    <div class="boc-settings-box">
        <label>Store Id:</label>
        <input type="text" class="form-control" id="store_id" name="store_id" value="<?php echo $store_id; ?>">
    </div> 
    <!-- item end  -->
    <div class="boc-settings-box">
        <label>Store Password:</label>
        <input type="text" class="form-control" id="store_passwd" name="store_passwd" value="<?php echo $store_passwd; ?>" >
    </div> 
    <!-- item end  -->
    <div class="boc-settings-box">
        <label>Total amount to pay:</label>
        <input type="number" class="form-control" id="total_amount" name="total_amount" value="<?php echo $total_amount; ?>">
    </div> 
    <!-- item end  -->

    <div class="boc-settings-box">
        <label>Success url: </label>
        <input type="text" class="form-control" id="success_url" name="success_url" value="<?php echo $success_url; ?>" >
    </div> 
    <!-- item end  -->

    <div class="boc-settings-box">
        <label>Fail url: </label>
        <input type="text" class="form-control" id="fail_url" name="fail_url" value="<?php echo $fail_url; ?>" >
    </div> 
    <!-- item end  -->

    <div class="boc-settings-box">
        <label>Cancel url: </label>
        <input type="text" class="form-control" id="cancel_url" name="cancel_url" value="<?php echo $cancel_url; ?>" >
    </div> 
    <!-- item end  -->

    <div class="boc-settings-box">
        <label>User Name: </label>
        <input type="text" class="form-control" id="ship_name" name="ship_name" value="<?php echo $ship_name; ?>" >
    </div> 
    <!-- item end  -->

    <input type="submit" value="submit">

</div>



</form>









<?php wp_footer(); ?>