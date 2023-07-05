<?php require_once('../private/initialize.php'); ?>

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php // changing header colour for active page
 echo '<style type="text/css">

    #categories {
        background-color: #00ADB5;
    }

    </style>'
     ;
  
  ?>

<!-- Inner content -->
<div id="innerContent">
    <p class="pageTitle">Add New Playlist</p>

    <form action="playlist.php" method="post" enctype="multipart/form-data" class="formGrid">
        <label for="playlistName">Playlist Name:</label>
        <input type="text" name="playlistName" required>
        <label for="songs">Add Songs:</label>
        <div class="formChecklist">
            <!-- php to insert the diffrent songs -->
            <?php
                $songLength = count($array['Songs']);
                for ($i = 0; $i < $songLength; $i++) {
                    $Song = $array['Songs'][$i]['FileName'];
                    echo '<div>
                    <input class="checkbox" type="checkbox" name="song[]" value="' . $Song . '">
                    <label for="' . $Song . '">' . $Song . '</label>
                    </div>';
                };
            ?>
        </div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <input class="button" type="submit"  name="submitPlaylist" value="Create">
    </form>

</div>

<?php require_once(SHARED_PATH . '/footer.php'); ?>