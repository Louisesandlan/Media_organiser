<?php
    // uploading image
    $target_dir = PUBLIC_PATH . "/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    // uploading media file
    $target_dir_media = PUBLIC_PATH . "/media/";
    $target_file_media = $target_dir_media . basename($_FILES["mediaFile"]["name"]);
    $fileType_media = strtolower(pathinfo($target_file_media,PATHINFO_EXTENSION));

// uplading a new media file
  if(isset($_POST['submit'])){
    $imagePath = "";
    //check if media file already exists
    if (file_exists($target_file_media)) {
        $error = "Sorry, file already exists. 
        <br><br>This song has not been added to the media organiser.";
    } else {
        //check if image was uploaded
        if( basename($_FILES["image"]["name"]) !== "") {
            $imagePath = '/images/' . basename($_FILES["image"]["name"]);
            // uploading image
            // Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $errorImg = "This image has already been uploaded. 
                <br> Please check the correct image has been addded.";
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk !== 0) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
                } else {
                    $errorImg = "Sorry, there was an error uploading your image. <br><br>";
                }
            }
        }

        // uploading media file
        if (move_uploaded_file($_FILES["mediaFile"]["tmp_name"], $target_file_media)) {
            $success = "The media file ". htmlspecialchars( basename( $_FILES["mediaFile"]["name"])). " has been uploaded.";
            // read json file
            $data = file_get_contents(PUBLIC_PATH . "/json/media.json");

            // decode json
            $json_arr = json_decode($data, true);
            saveOld($json_arr);
 
            $json_arr['Songs'][] = array(
                "FileName" => $_POST['fileName'],
                "FilePath" => '/media/' . basename( $_FILES["mediaFile"]["name"]),
                "MediaFileType" => $fileType_media,
                "Comment" => $_POST['comment'],
                "Image" => array(
                    "FileName" => basename($_FILES["image"]["name"]),
                    "FilePath" =>  $imagePath),
                "Category" => $_POST['category']
            );

            // encode json and save to file
            file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } else {
            $error = "Sorry, there was an error uploading your media file.";
        }
    }
 }

 //adding a new category
 if(isset($_POST['submitCategory'])){
     $imagePath = "";
     //check if image was uploaded
     if( basename($_FILES["image"]["name"]) !== "") {
         $imagePath = '/images/' . basename($_FILES["image"]["name"]);
        // uploading image
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $errorImg = "This image has already been uploaded. 
            <br> Please check the correct image has been addded.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk !== 0) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
            } else {
                $errorImg = "Sorry, there was an error uploading your image. <br><br>";
            }
        }
    }
    //add to media.json
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);

    //adding category
    $json_arr['Category'][] = array(
        "Category" => $_POST['categoryName'],
        "ImagePath" =>  $imagePath
    );

    //adding the category to the song
    $songs = $_POST['song'];
    for($x = 0; $x < count($songs); $x++) {
        for($y = 0; $y < count($json_arr['Songs']); $y++) {
            if($songs[$x] == $json_arr['Songs'][$y]['FileName']) {
                array_push($json_arr['Songs'][$y]['Category'], $_POST['categoryName']);
            }
        }
    }
     // encode json and save to file
     file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

 }

 //adding a new playlist
  if(isset($_POST['submitPlaylist'])){
    $imagePath = "";
    $playlistUpload= true;
    //check if image was uploaded
    if( basename($_FILES["image"]["name"]) !== "") {
        $imagePath = '/images/' . basename($_FILES["image"]["name"]);
       // uploading image
       // Check if file already exists
       if (file_exists($target_file)) {
           $uploadOk = 0;
           $errorImg = "This image has already been uploaded. 
           <br> Please check the correct image has been addded.";
       }

       // Check if $uploadOk is set to 0 by an error
       if ($uploadOk !== 0) {
           if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
               $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
           } else {
               $errorImg = "Sorry, there was an error uploading your image. <br><br>";
           }
       }
   }
   //add to media.json
   // read json file
   $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
   // decode json
   $json_arr = json_decode($data, true);
   saveOld($json_arr);
    
   //adding playlist
    $json_arr['Playlist'][] = array(
        "Name" => $_POST['playlistName'],
        "ImagePath" =>  $imagePath,
        "Songs" => $_POST['song']
    );

     // encode json and save to file
     file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    };

    //edit song
    if(isset($_POST['editSong'])){
        //song being edited position
        $songKey = $_POST['songKey'];
        // read json file
        $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
        // decode json
        $json_arr = json_decode($data, true);
        saveOld($json_arr);
        //changing the image
        //check if image was uploaded
        if( basename($_FILES["image"]["name"]) !== "") {
            $imagePath = '/images/' . basename($_FILES["image"]["name"]);
            // uploading image
            // Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $errorImg = "This image has already been uploaded. 
                <br> Please check the correct image has been addded.";
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk !== 0) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
                } else {
                    $errorImg = "Sorry, there was an error uploading your image. <br><br>";
                }
            }
            $json_arr['Songs'][$songKey]['Image']['FileName'] = basename($_FILES["image"]["name"]);
            $json_arr['Songs'][$songKey]['Image']['FilePath'] = $imagePath;
        }
        //changing the comment 
        $json_arr['Songs'][$songKey]['Comment'] = $_POST['comment'];

        //changing the catgories
        $json_arr['Songs'][$songKey]['Category'] = $_POST['category'];
        // encode json and save to file
        file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    // editing the name and image for category and playlist
    if(isset($_POST['submitChange'])){
        //type & category/playlist being editied 
        $type = $_POST['type'];
        $editing = $_POST['editing'];
        // read json file
        $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
        // decode json
        $json_arr = json_decode($data, true);
        saveOld($json_arr);
        if($type == "category") {
            //find the corrrect category in json file
            $length = count($json_arr['Category']);
            for($x = 0; $x < $length; $x++) {
                $found = array_search($editing, $json_arr['Category'][$x]);
                if($found !== false) {
                    $json_arr['Category'][$x]['Category'] = $_POST['newName'];
                    //changing the image
                    //check if image was uploaded
                    if( basename($_FILES["image"]["name"]) !== "") {
                        $imagePath = '/images/' . basename($_FILES["image"]["name"]);
                        // uploading image
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $uploadOk = 0;
                    }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk !== 0) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
                    } else {
                        $errorImg = "Sorry, there was an error uploading your image. <br><br>";
                    }
                }
                $json_arr['Category'][$x]['ImagePath'] = $imagePath;
                }
                }
            }
        } else {
            //find the corrrect playlist in json file
            $length = count($json_arr['Playlist']);
            for($x = 0; $x < $length; $x++) {
                $found = array_search($editing, $json_arr['Playlist'][$x]);
                if( $found !== false) {
                    $json_arr['Playlist'][$x]['Name'] = $_POST['newName'];
                    //changing the image
                    //check if image was uploaded
                    if( basename($_FILES["image"]["name"]) !== "") {
                        $imagePath = '/images/' . basename($_FILES["image"]["name"]);
                        // uploading image
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk !== 0) {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $successImg = "The image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded. <br><br>";
                            } else {
                                $errorImg = "Sorry, there was an error uploading your image. <br><br>";
                            }
                        }
                        $json_arr['Playlist'][$x]['ImagePath'] = $imagePath;
                    }
                }
            }
        }
     // encode json and save to file
     file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

//adding a new song to a category
if(isset($_POST['addSong'])){
    //the song being added
    $newSong = $_POST['newSong'];
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);

    //find correct song
    for($y = 0; $y < count($json_arr['Songs']); $y++) {
        if($newSong == $json_arr['Songs'][$y]['FileName']) {
            array_push($json_arr['Songs'][$y]['Category'], $_POST['category']);
        }
    }
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

//adding a new song to a playlist
if(isset($_POST['addSongPlaylist'])){
    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);
    //find correct playlist
    for($x = 0; $x < count($json_arr['Playlist']); $x++) {
        if($json_arr['Playlist'][$x]['Name'] == $_POST['playlist']) {
            $key = $x;
        }
    }
    //add song to playlist
    array_push($json_arr['Playlist'][$key]['Songs'], $_POST['newSong']);
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

    //put previous saves into old json file
    function saveOld($oldArray) {
        // read json file
        $data_old = file_get_contents(PUBLIC_PATH . "/json/media_old.json");
        // decode json
        $json_arr_old = json_decode($data_old, true);

        //adding oldVersion
        $json_arr_old['oldVersions'][] = array(
            "Date" => date('Y/m/d'),
            "Content" => $oldArray
        );

        // encode json and save to file
        file_put_contents(PUBLIC_PATH . "/json/media_old.json", json_encode($json_arr_old, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

//make the current json file one of the pervious version
if(isset($_POST['changeToOld'])){
    $changeTo = $_POST['changeToOld'];

    // read json file
    $data_old = file_get_contents(PUBLIC_PATH . "/json/media_old.json");
    // decode json
    $json_arr_old = json_decode($data_old, true);
    $length = count($json_arr_old['oldVersions']);
    for ($i = 0; $i < $length; $i++) {
        if($json_arr_old['oldVersions'][$i]['Date'] == $changeTo) {
            $newArray = $json_arr_old['oldVersions'][$i]['Content'];
        }
    }

    // read json file
    $data = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // decode json
    $json_arr = json_decode($data, true);
    saveOld($json_arr);

    $json_arr = $newArray;
    // encode json and save to file
    file_put_contents(PUBLIC_PATH . "/json/media.json", json_encode($json_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

?>