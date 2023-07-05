<?php require_once('../private/initialize.php'); ?> 
<?php require_once(PUBLIC_PATH . '/script.php'); ?> 

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php 
    // Get the contents of the JSON file 
    $strJsonFileContents_old = file_get_contents(PUBLIC_PATH . "/json/media_old.json");
    // Convert to array 
    $array_old = json_decode($strJsonFileContents_old, true);
?>

<!-- Inner content -->
<div id="innerContent">
    <p class="pageTitle">Load old save</p>

    <?php 
        $length = count($array_old['oldVersions']);
        for ($i = 0; $i < $length; $i++) {
           echo'
           <form action="" method="post" enctype="multipart/form-data">
           <input class="button" type="submit" name="changeToOld" value="'. $array_old['oldVersions'][$i]['Date'] .'">
           </form>';
        };
    ?>


</div>


<?php require_once(SHARED_PATH . '/footer.php'); ?>