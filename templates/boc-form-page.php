<?php
/*
Template Name: BOC Form Page
*/
wp_head(); 
?>

<div class="boc-form-container">
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=members-list'); ?>">
            Members List
        </a>
    </div> 
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=approved-member'); ?>">
            Approved
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=rejected-member'); ?>">
            Rejected
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=pending-member'); ?>">
            Pending Review
        </a>
    </div>
    <div class="boc-form-box">
        <a href="<?php echo admin_url('admin.php?page=inactive-member'); ?>">
            Inactive
        </a>
    </div>
</div>





<?php wp_footer(); ?>