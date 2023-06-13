
<?php
/*
Template Name: Approved Members
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







<div class="wrap">
<h2> Pending Members </h2>

<table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Image</th>
            <th>Date of Birth</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Nationality</th>
            <th>Religion</th>
        </tr>
    </thead>
    <tbody>
        <!-- Add your table rows dynamically with the data -->
        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>


        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td><img src="path/to/image.jpg" alt="Profile Image"></td>
            <td>1998-05-15</td>
            <td>Michael Doe</td>
            <td>Jane Doe</td>
            <td>USA</td>
            <td>Christianity</td>
        </tr>
        <tr>
            <!-- Add more rows as needed -->
        </tr>
    </tbody>
</table>
</div>

<?php wp_footer(); ?>