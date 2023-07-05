<?php
    //Assiging file paths for PHP contastants
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    //URL paths
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public');
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    //function files
    require_once('functions.php');

?> 