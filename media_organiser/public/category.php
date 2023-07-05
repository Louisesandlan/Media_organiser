<?php require_once('../private/initialize.php'); ?> 
<?php require_once(PUBLIC_PATH . '/script.php'); ?> 

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
<div class="flexSB">
    <p class="pageTitle">Categories</p>
    <a href="<?php echo url_for('/add_new_category.php');?>" class="button">
        <p>Add New</p> 
    </a>
</div>

<!-- for loop to display all categories -->
<?php 
$categoryLength = count($array['Category']);
for ($i = 0; $i < $categoryLength; $i++) {
    $imgCategory = $array['Category'][$i]['ImagePath'];
    $category = $array['Category'][$i]['Category'];
    echo '<div class="flexSB">
        <div class="flex">
            <img src="';
            if ($imgCategory !== null ) {
                echo url_for($imgCategory) ;
            } else {
                echo url_for("/images/placeholder.jpg");
            };
            echo '" class="topImg">
            <p class="categoryName">' . $category . '</p>
        </div>
        <div class="btnBox"> 
            <a href="'. url_for('edit.php'). '?category=' . $category .'" class="button">
                <p>Edit</p>
             </a>
             <div id="'.$category.'" class="button deleteBtn">
                <p>Delete</p>
            </div>
        </div>
    </div>
    <!-- pop up to delete category -->
    <div id="deleteCategory' . $category . '" class="popUp">
        <p id="categoryDelTxt">Are you sure you would like to delete the ' . $category . ' category?</p>
        <div class="flexSB">
            <a href="category.php?delete=' . $category .'" class="button">
                <p>Yes</p>
            </a>
            <div onclick="closePopUp()" class="button">
                <p>No</p>
            </div>
        </div>
    </div>
    <table class="mediaTable">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Comment</th>
            <th style="width: 30px"></th>
        </tr>';
        // PHP for loop to go through songs
        $songsLength = count($array['Songs']);
        for($x = 0; $x < $songsLength; $x++) {
            //check if song is in category
            $songCategories = $array['Songs'][$x]['Category'];
            for($y = 0; $y < count($songCategories); $y++) {
                if($songCategories[$y] == $category) {
                    $img = $array['Songs'][$x]['Image']['FilePath'];
                    echo
                    '<tr>
                        <td>
                            <img class="tableImg" src="';
                            if ($img !== null) {
                                echo url_for($img);
                            } else {
                                echo url_for("/images/placeholder.jpg");
                            };
                            echo '">
                        </td>
                        <td>' . $array['Songs'][$x]['FileName'] . '</td>
                        <td>' . $array['Songs'][$x]['Comment'] . '</td>
                        <td>
                            <a href="category.php?category=' . $category . '&song=' . $array['Songs'][$x]['FileName'] . ' ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash3 activeIcon" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>';
                }
            }
        };
        echo '
        </table>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" id="'. $category .'" class="bi bi-plus-circle activeIcon" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
        <form action="" method="post" id="add'.$category.'" class="addNewForm"> 
            <select name="newSong" id="newSong">';
                for($x = 0; $x < $songsLength; $x++) {
                    $contained = in_array($category, $array['Songs'][$x]['Category']);
                    if($contained == false) {
                        echo '<option value="'. $array['Songs'][$x]['FileName'] .'">'. $array['Songs'][$x]['FileName'] .'</option>';
                    }
                };
            echo '</select>
            <input type="hidden" name="category" value="'. $category .'" >
            <input class="button" type="submit"  name="addSong" value="ADD">
        </form>
        <div class="margin"></div>';
}
?>

<!-- Snapshot of some playlists-->
<div class="examples">
    <div class="flexSB">
        <p class="tilesTitle">Playlist</p>
        <a href="<?php echo url_for('playlist.php') ;?>" class="button">
            <p>View All</p>
        </a>
    </div>
    <div class="tilesSection">
        <!-- php to go through playlist and display them -->
        <?php 
            $playlistLength = count($array['Playlist']);
            if ($playlistLength > 4 ) {
                $playlistLength = 4;
            };
            for ($i = 0; $i < $playlistLength; $i++) {
                $imgPlaylist = $array['Playlist'][$i]['ImagePath'];
                echo '<div class="tile">
                    <img class="tileImg" src="';
                    if ($imgPlaylist !== null ) {
                        echo url_for($imgPlaylist) ;
                    } else {
                        echo url_for("/images/placeholder.jpg");
                    };
                    echo '">
                    <p class="tileText">' . $array['Playlist'][$i]['Name'] . '</p>
                </div>';
            };
        ?>
    </div> 
</div>
    
</div>

<!-- Javascript to open pop up -->
<script>
    var deleteBtns = document.getElementsByClassName('deleteBtn');
    var popUp = document.getElementsByClassName('popUp');
    for(let x=0; x < deleteBtns.length; x++) {
        deleteBtns[x].addEventListener("click", function(){
            var id = deleteBtns[x].id;
            var currentPopUp = document.getElementById('deleteCategory' + id);
            currentPopUp.style.display = "flex";
        })
    }

    //close pop up 
    function closePopUp() {
        for(let x=0; x < popUp.length; x++) {
            popUp[x].style.display = "none";
        }
    }

    //add in new song
    var add = document.getElementsByClassName('bi-plus-circle');
    for(let x=0; x < add.length; x++) {
        add[x].addEventListener("click", function(){
            var id = add[x].id;
            add[x].style.display = "none";
            var currentAdd = document.getElementById('add' + id);
            currentAdd.style.display = "flex";
        })
    }
</script>

<?php    
//delete category
   if (isset($_GET['delete'])) {
    $category = $_GET['delete'];
    deleteCategory($category);
  }

  function deleteCategory($category){
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    $length =count($json_arr['Category']);
    for($x = 0; $x < $length; $x++) {
        $key = in_array($category, $json_arr['Category'][$x]);
        if ($key == true) {
            unset($json_arr['Category'][$x]);
            $json_arr['Category'] = array_values($json_arr['Category']);
        }
    }
     // remove category from songs
     $songsLength = count($json_arr['Songs']);
     for($y = 0; $y < $songsLength; $y++) {
        $categoryLength = count($json_arr['Songs'][$y]['Category']);
            $contained = false;
            $contained = array_search($category, $json_arr['Songs'][$y]['Category']);
        if ($contained !== false) {
            unset($json_arr['Songs'][$y]['Category'][$contained]);
            $json_arr['Songs'][$y]['Category'] = array_values($json_arr['Songs'][$y]['Category']);
        }
    }

    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  };

  //remove a song from a category

  if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $song = $_GET['song'];
    removeSong($category, $song);
  }

  function removeSong($category, $song){
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    for($x = 0; $x < count($json_arr['Songs']); $x++) {
      if(array_search($song, $json_arr['Songs'][$x]) !== false) {
        $songKey = $x;
      }
    }
    $categoryKey = array_search($category, $json_arr['Songs'][$songKey]['Category']);
    if ($categoryKey !== false) {
        unset($json_arr['Songs'][$songKey]['Category'][$categoryKey]);
        $json_arr['Songs'][$songKey]['Category'] = array_values($json_arr['Songs'][$songKey]['Category']);
    }
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  }
  ?>


<?php require_once(SHARED_PATH . '/footer.php'); ?>