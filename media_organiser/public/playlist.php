<?php require_once('../private/initialize.php'); ?> 
<?php require_once(PUBLIC_PATH . '/script.php'); ?> 

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php // changing header colour for active page
 echo '<style type="text/css">

    #playlist {
        background-color: #00ADB5;
    }

    </style>'
     ;
  
  ?>

<!-- Inner content -->
<div id="innerContent">
<?php echo @$key; ?></p>
  <div class="flexSB">
    <p class="pageTitle">Playlists</p>
    <a href="<?php echo url_for('/add_new_playlist.php');?>" class="button">
        <p>Add New</p> 
    </a>
  </div>

  <!-- for loop to display all categories -->
<?php 
$playlistLength = count($array['Playlist']);
for ($i = 0; $i < $playlistLength; $i++) {
    $imgPlaylist = $array['Playlist'][$i]['ImagePath'];
    $playlist = $array['Playlist'][$i]['Name'];
    $songs = $array['Playlist'][$i]['Songs'];
    echo '<div class="flexSB">
        <div class="flex">
            <img src="';
            if ($imgPlaylist !== null ) {
                echo url_for($imgPlaylist) ;
            } else {
                echo url_for("/images/placeholder.jpg");
            };
            echo '" class="topImg">
            <p class="playlistName">' . $playlist . '</p>
        </div>
        <div class="btnBox"> 
            <a href="'. url_for('edit.php'). '?playlist=' . $playlist .'" class="button">
                <p>Edit</p>
            </a>
            <div id="' . $playlist . '" class="button deleteBtn">
                <p>Delete</p>
            </div>
        </div>
    </div>
    <!-- pop up to delete playlist -->
    <div id="deletePlaylist' . $playlist . '" class="popUp">
        <p>Are you sure you would like to delete the ' . $playlist . ' playlist?</p>
        <div class="flexSB">
            <a href="playlist.php?deletePlaylist=' . $playlist .'" class="button">
                <p>Yes</p>
            </a>
            <div onclick="closePopUp()" class="button">
                <p>No</p>
            </div>
        </div>
    </div>
    <table id="playlistTable" class="mediaTable">
        <tr>
            <th></th>
            <th></th>
            <th>Name</th>
            <th>Comment</th>
            <th style="width: 30px"></th>
            <th style="width: 30px"></th>
        </tr>';
        // PHP for loop to go through songs
        $noOfSongs = count($songs);
        for($y = 0; $y < $noOfSongs; $y++) {
            $songsLength = count($array['Songs']);
            for($x = 0; $x < $songsLength; $x++) {
                if($array['Songs'][$x]['FileName'] == $songs[$y]) {
                    $img = $array['Songs'][$x]['Image']['FilePath'];
                    echo
                    '<tr>
                    <td>' . ($y+1) . '</td>
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
                            <a href="playlist.php?moveUp=' . $array['Songs'][$x]['FileName'] . '&playlist=' . $playlist . '">
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-up activeIcon" viewBox="0 0 16 16">
                                <path d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"/>
                              </svg>
                            </a>
                            <a href="playlist.php?moveDown=' . $array['Songs'][$x]['FileName'] . '&playlist=' . $playlist . '">
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-down activeIcon" viewBox="0 0 16 16">
                                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                              </svg>
                            </a>
                        </td>
                        <td>
                            <a href="playlist.php?playlist=' . $playlist . '&song=' . $array['Songs'][$x]['FileName'] . ' ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash3 activeIcon" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg>
                            </a>
                        </td>
                    </tr>';
                }
            }
        };
    echo '</table>
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" id="'. $playlist .'" class="bi bi-plus-circle activeIcon" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>
    <form action="" method="post" id="add'.$playlist.'" class="addNewForm"> 
        <select name="newSong" id="newSong">';
            for($x = 0; $x < $songsLength; $x++) {
                $contained = in_array($array['Songs'][$x]['FileName'], $songs);
                if($contained == false) {
                    echo '<option value="'. $array['Songs'][$x]['FileName'] .'">'. $array['Songs'][$x]['FileName'] .'</option>';
                }
            };
    echo '</select>
    <input type="hidden" name="playlist" value="'. $playlist .'" >
    <input class="button" type="submit"  name="addSongPlaylist" value="ADD">
</form>
    <div class="margin"></div>';
}
?>

<!-- Snapshot of some categories-->
<div class="examples">
    <div class="flexSB">
        <p class="tilesTitle">Categories</p>
        <a href="<?php echo url_for('category.php') ;?>" class="button">
            <p>View All</p>
        </a>
    </div>
    <div class="tilesSection">
        <!-- php to go through categories and display them -->
        <?php 
            $categoryLength = count($array['Category']);
            if ($categoryLength > 4 ) {
                $categoryLength = 4;
            };
            for ($i = 0; $i < $categoryLength; $i++) {
                $imgCategory = $array['Category'][$i]['ImagePath'];
                echo '<div class="tile">
                    <img class="tileImg" src="';
                    if ($imgCategory !== null ) {
                        echo url_for($imgCategory) ;
                    } else {
                        echo url_for("/images/placeholder.jpg");
                    };
                    echo '">
                    <p class="tileText">' . $array['Category'][$i]['Category'] . '</p>
                </div>';
            };
        ?>
    </div>
</div>
</div>


<script>
  // Javascript to open pop up
    var deleteBtns = document.getElementsByClassName('deleteBtn');
    var popUp = document.getElementsByClassName('popUp');
    for(let x=0; x < deleteBtns.length; x++) {
        deleteBtns[x].addEventListener("click", function(){
            var id = deleteBtns[x].id;
            var popUp = document.getElementById('deletePlaylist' + id);
            popUp.style.display = "flex";
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
  //move song up playlist order
  if (isset($_GET['moveUp'])) {
    $moveing = $_GET['moveUp'];
    $playlist = $_GET['playlist'];
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    //find correct playlist
    $playlistLength = count($json_arr['Playlist']);
    for($x = 0; $x < $playlistLength ; $x++) {
        if (array_search($playlist, $json_arr['Playlist'][$x]) !== false) {
            $playlistKey = $x;
        }
    }
    //find song position in playlist
    $playlistLength = count($json_arr['Playlist'][$playlistKey]['Songs']);
    for($x = 0; $x < $playlistLength ; $x++) {
        if ($json_arr['Playlist'][$playlistKey]['Songs'][$x] == $moveing) {
            $songKey = $x;
        }
    }
    $out = array_splice($json_arr['Playlist'][$playlistKey]['Songs'], $songKey, 1);
    array_splice($json_arr['Playlist'][$playlistKey]['Songs'], ($songKey-1), 0, $out);

    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  }

  //move song down playlist order
  if (isset($_GET['moveDown'])) {
    $moveing = $_GET['moveDown'];
    $playlist = $_GET['playlist'];
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    //find correct playlist
    $playlistLength = count($json_arr['Playlist']);
    for($x = 0; $x < $playlistLength ; $x++) {
        if (array_search($playlist, $json_arr['Playlist'][$x]) !== false) {
            $playlistKey = $x;
        }
    }
    //find song position in playlist
    $playlistLength = count($json_arr['Playlist'][$playlistKey]['Songs']);
    for($x = 0; $x < $playlistLength ; $x++) {
        if ($json_arr['Playlist'][$playlistKey]['Songs'][$x] == $moveing) {
            $songKey = $x;
        }
    }
    $out = array_splice($json_arr['Playlist'][$playlistKey]['Songs'], $songKey, 1);
    array_splice($json_arr['Playlist'][$playlistKey]['Songs'], ($songKey+1), 0, $out);

    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  }

  //delete a playlist
  if (isset($_GET['deletePlaylist'])) {
    $playlist = $_GET['deletePlaylist'];
    deletePlaylist($playlist);
  }

  function deletePlaylist($playlist){
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    $length =count($json_arr['Playlist']);
    for($x = 0; $x < $length; $x++) {
        $key = in_array($playlist, $json_arr['Playlist'][$x]);
        if ($key == true) {
            unset($json_arr['Playlist'][$x]);
            $json_arr['Playlist'] = array_values($json_arr['Playlist']);
        }
    }
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  };

  // delete song from playlist 

  if (isset($_GET['playlist'])) {
    $playlist = $_GET['playlist'];
    $song = $_GET['song'];
    removeSong($playlist, $song);
  }


  function removeSong($playlist, $song){
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);

    //find playlist
    $length =count($json_arr['Playlist']);
    for($x = 0; $x < $length; $x++) {
        if ($json_arr['Playlist'][$x]['Name'] == $playlist) {
            $key = $x;
        }
    }

    //find song
    $length = count($json_arr['Playlist'][$key]['Songs']);
    for($x = 0; $x < $length; $x++) {
        if ($json_arr['Playlist'][$key]['Songs'][$x] == $song) {
            unset($json_arr['Playlist'][$key]['Songs'][$x]);
        }
    }

    //reset values to 0 within arrays
    $json_arr['Playlist'][$key]['Songs'] = array_values($json_arr['Playlist'][$key]['Songs']);
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  }
?>


<?php require_once(SHARED_PATH . '/footer.php'); ?>