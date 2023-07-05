<?php require_once('../private/initialize.php'); ?> 

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php 
if (isset($_GET['category'])) {
    $type = "category";
    $editing = $_GET['category'];
// changing header colour for active page
 echo '<style type="text/css">

    #categories {
        background-color: #00ADB5;
    }

    </style>'
     ;
} 
if(isset($_GET['playlist'])) {
    $type = "playlist";
    $editing = $_GET['playlist'];
    echo '<style type="text/css">

    #playlist {
        background-color: #00ADB5;
    }

    </style>'
     ;
}
  ?>

<!-- Inner content -->
<div id="innerContent">
    <p class="pageTitle">Edit <?php echo $editing .' '. $type;?></p>

    <form action="
        <?php
        if($type == "category") {
           echo 'category.php' ;
        } else {
            echo 'playlist.php' ;
        }
        ?>
    " method="post" enctype="multipart/form-data" class="formGrid">
        <label for="newName">New Name:</label>
        <input type="text" name="newName" value="<?php echo $editing; ?>">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <!-- send if its a playlist or category with form sumbit-->
        <input type="hidden" name="type" value="<?php echo $type ;?>" >
        <!-- send playlis/category being changed-->
        <input type="hidden" name="editing" value="<?php echo $editing ;?>" >
        <input class="button" type="submit"  name="submitChange" value="CHANGE">
    </form>

</div>


<?php require_once(SHARED_PATH . '/footer.php'); ?>