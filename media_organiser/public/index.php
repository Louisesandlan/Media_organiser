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
  ?>

<!-- Inner content -->
<div id="innerContent">

<table class="mediaTable">
  <tr>
    <th></th>
    <th>Name</th>
    <th>Comment</th>
    <th style="width: 30px"></th>
    <th style="width: 30px"></th>
  </tr>
  <!-- PHP for loop to go through songs -->
  <?php 
    $songsLength = count($array['Songs']);
    for($x = 0; $x < $songsLength; $x++) {
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
            <td>
                <a class="activeIcon" href="'. url_for('view_song.php') .'?song=' . $array['Songs'][$x]['FileName'] . '">' 
                    . $array['Songs'][$x]['FileName'] . 
                '</a>
            </td>
            <td>' . $array['Songs'][$x]['Comment'] . '</td>
            <td>
                <a href="'. url_for('edit_song.php') .'?editSong=' . $array['Songs'][$x]['FileName'] . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil activeIcon" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </a>
            </td>
            <td id="' . $array['Songs'][$x]['FilePath'] . '" class="delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash3 activeIcon" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </td>
        </tr>
        <!-- pop up to delete song -->
        <div id="deleteSong' . $array['Songs'][$x]['FilePath'] . '" class="popUp">
            <p id="songDelTxt">Are you sure you would like to delete ' . $array['Songs'][$x]['FileName'] . '?</p>
            <div class="flexSB">
                <a href="index.php?deleteSong=' . $array['Songs'][$x]['FilePath'] .'" class="button">
                    <p>Yes</p>
                </a>
                <div onclick="closePopUp()" class="button">
                    <p>No</p>
                </div>
            </div>
        </div>';
    };
  ?>
</table>
<div class="margin"></div>


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


<!-- Javascript to open pop up -->
<script>
    var deleteBtns = document.getElementsByClassName('delete');
    var popUp = document.getElementsByClassName('popUp');
    for(let x=0; x < deleteBtns.length; x++) {
        deleteBtns[x].addEventListener("click", function(){
            var id = deleteBtns[x].id;
            var popUpCurrent = document.getElementById('deleteSong' + id);
            popUpCurrent.style.display = "flex";
        })
    }
    //close pop up 
    function closePopUp() {
        for(let x=0; x < popUp.length; x++) {
            popUp[x].style.display = "none";
        }
    }
</script>

<?php
//deleting a song
if (isset($_GET['deleteSong'])) {
    $song = $_GET['deleteSong'];
    deleteSong($song);
}

function deleteSong($song) {
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    $length =count($json_arr['Songs']);
    for($x = 0; $x < $length; $x++) {
        $key = in_array($song, $json_arr['Songs'][$x]);
        if ($key == true) {
            unset($json_arr['Songs'][$x]);
            $json_arr['Songs'] = array_values($json_arr['Songs']);
        }
    }
     // encode json and save to file
     file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

?>


</div>
<?php require_once(SHARED_PATH . '/footer.php'); ?>