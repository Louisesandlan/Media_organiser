<?php require_once('../private/initialize.php'); ?> 
<?php require_once(PUBLIC_PATH . '/script.php'); ?> 

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php // changing header colour for active page
 echo '<style type="text/css">

    #upload {
        background-color: #00ADB5;
    }

    </style>'
     ;
  
  ?>

<!-- Inner content -->
<div id="innerContent">
    <p class="pageTitle">Upload A New Media File</p>
    <form action="" method="post" enctype="multipart/form-data" class="formGrid">
        <label for="fileName">File Name:</label>
        <input type="text" id="fileName" name="fileName" required>
        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment">
        <label for="categories">Categories:</label>
        <div class="formChecklist">
            <!-- php to insert the different categories -->
            <?php
                $categoryLength = count($array['Category']);
                for ($i = 0; $i < $categoryLength; $i++) {
                    $category = $array['Category'][$i]['Category'];
                    echo '<div>
                    <input class="checkbox" type="checkbox" name="category[]" value="' . $category . '">
                    <label for="' . $category . '">' . $category . '</label>
                    </div>';
                };
            ?>
        </div>
        <label for="mediaFile">Media File:</label>
        <input type="file" name="mediaFile" id="mediaFile" accept="audio/*"  required>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <input class="button" type="submit"  name="submit" value="UPLOAD">
    </form>
    <!-- success or error message-->
    <div class="flexSB">
        <div id="mediaMessages">
            <p class="error"><?php echo @$error; ?></p>
            <p class="success"><?php echo @$success; ?></p>
        </div>
        <div id="imageMessages">
            <p class="error"><?php echo @$errorImg; ?></p>
            <p class="success"><?php echo @$successImg; ?></p>
        </div>
    </div>
</div>


<?php require_once(SHARED_PATH . '/footer.php'); ?>