<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whizzy Media Organiser</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet-->
    <link rel="stylesheet" href="<?php echo url_for("/stylesheets/styles.css"); ?>">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo url_for('/images/icon.svg'); ?>">
</head>
<body>
<?php 
    // Get the contents of the JSON file 
    $strJsonFileContents = file_get_contents(PUBLIC_PATH . "/json/media.json");
    // Convert to array 
    $array = json_decode($strJsonFileContents, true);
?>

<div id="header">
    <div id="headerLeft">
        <a id="home" class="menuItem" href="<?php echo url_for("/index.php"); ?>">
            <p>HOME</p>
        </a>
        <a id="playlist" class="menuItem" href="<?php echo url_for("/playlist.php"); ?>">
            <p>PLAYLIST</p>
        </a>
        <a id="categories" class="menuItem" href="<?php echo url_for("/category.php"); ?>">
            <p>CATEGORIES</p>
        </a>
        <a id="upload" class="menuItem" href="<?php echo url_for("/upload.php"); ?>">
            <p>UPLOAD</p>
        </a>
    </div>
    <div id="headerRight">
        <a href="<?php echo url_for('old_saves.php');?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-archive activeIcon" viewBox="0 0 16 16">
                <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </a>
    </div>

</div>

    