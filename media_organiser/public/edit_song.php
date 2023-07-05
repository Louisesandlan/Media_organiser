<?php require_once('../private/initialize.php'); ?> 


<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php // changing header colour for active page
    echo '<style type="text/css">

    #home {
        background-color: #00ADB5;
    }

    </style>'
     ;

     $song = $_GET['editSong'];
     //find the songs array position in the json file
     $songsLength = count($array['Songs']);
     for($x = 0; $x < $songsLength; $x++) {
        if(array_search($song, $array['Songs'][$x]) !== false) {
            $songKey = $x;
        }
    }
  ?>

<!-- Inner content -->
<div id="innerContent">
<div class="flexSB">
    <p class="pageTitle"><?php echo $song; ?></p>
    <a href="<?php echo url_for('/index.php');?>" class="button">
        <p>Cancel</p> 
    </a>
</div>
<form action="index.php" method="post" enctype="multipart/form-data" class="formGrid">
    <label for="comment">Comment:</label>
    <input type="text" id="comment" name="comment" value="<?php echo $array['Songs'][$songKey]['Comment'] ?>">
    <label for="categories">Categories:</label>
        <div class="formChecklist">
            <!-- php to insert the different categories -->
            <?php
                $categoryLength = count($array['Category']);
                for ($i = 0; $i < $categoryLength; $i++) {
                    $category = $array['Category'][$i]['Category'];
                    echo '<div>
                    <input class="checkbox" type="checkbox" name="category[]" value="' . $category . ' "';
                    // check if song is in catgeory
                    $songsCatgories = $array['Songs'][$songKey]['Category'];
                    if(array_search($category, $songsCatgories) !== false) {
                        echo "checked";
                    }
                    echo '>
                    <label for="' . $category . '">' . $category . '</label>
                    </div>';
                };
            ?>
        </div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <!-- send song key with form subit-->
        <input type="hidden" name="songKey" value="<?php echo $songKey ;?>" >
        <input class="button" type="submit"  name="editSong" value="EDIT SONG">
</form>

</diV>

<?php require_once(SHARED_PATH . '/footer.php'); ?>