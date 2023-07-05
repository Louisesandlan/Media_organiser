<?php require_once('../private/initialize.php'); ?> 
<?php require_once(PUBLIC_PATH . '/script.php'); ?> 

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php // changing header colour for active page
    echo '<style type="text/css">

    #home {
        background-color: #00ADB5;
    }

    </style>'
     ;
     $song = $_GET['song'];
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
    <div class="flex">
        <img class="songImg" src="
            <?php  
            if ($img !== null) {
                echo url_for($img);
            } else {
                echo url_for("/images/placeholder.jpg");
            };
            ?> ">
        <p class="pageTitle"><?php echo $song; ?></p>
    </div>
    <a href="<?php echo url_for('/index.php');?>" class="button">
        <p>Home</p> 
    </a>
</div>

<div class="songGrid">
    <p>File Path:</p>
    <p><?php echo $array['Songs'][$songKey]['FilePath']; ?></p>
    <p>File Type:</p>
    <p><?php echo $array['Songs'][$songKey]['MediaFileType']; ?></p>
    <p>Comment:</p>
    <p><?php echo $array['Songs'][$songKey]['Comment']; ?></p>
    <p>Categories:</p>
    <p>
        <?php 
            for($x = 0; $x < count($array['Songs'][$songKey]['Category']); $x++ ) {
                echo $array['Songs'][$songKey]['Category'][$x];
                if($x < count($array['Songs'][$songKey]['Category'])) {
                    echo '<br>'; 
                }
            }
        ?></p>
</div>


</div>
<?php require_once(SHARED_PATH . '/footer.php'); ?>