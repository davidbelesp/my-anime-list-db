<?php
include 'request.php';
include 'config.php';

if (isset($_GET["user"]) || isset($_GET["type"])){
    $user = $_GET["user"];
    $type = $_GET["type"];
    if (isset($_GET["offset"])){
        $offset = $_GET["offset"];
    } else {
        $offset = 0;
    }
    
    $url = "https://api.myanimelist.net/v2/users/$user/".$type."list?offset=".$offset."&nsfw=$NSFW&fields=list_status&limit=20";
    echo makeRequest($url,$CLIENT_ID);
} else {
    $url = "https://api.myanimelist.net/v2/anime?q=one&limit=10";
    echo makeRequest($url, $CLIENT_ID);
    return;
}

?>