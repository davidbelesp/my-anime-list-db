<?php
include 'request.php';
include 'config.php';

if (isset($_GET["user"]) || isset($_GET["type"])){
    $user = $_GET["user"];
    $type = $_GET["type"];
    $url = "https://api.myanimelist.net/v2/users/$user/".$type."list?nsfw=$NSFW";
    echo makeRequest($url,$CLIENT_ID);
} else {
    $url = "https://api.myanimelist.net/v2/anime?q=one&limit=10";
    echo makeRequest($url, $CLIENT_ID);
    return;
}

?>