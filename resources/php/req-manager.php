<?php
include 'request.php';
include 'config.php';

$user = $_GET["user"];

if (!$user) {
    $url = "https://api.myanimelist.net/v2/anime?q=one&limit=10";
    echo makeRequest($url, $CLIENT_ID);
    return;
}

$url = "https://api.myanimelist.net/v2/users/$user/mangalist?nsfw=$NSFW";
echo makeRequest($url,$CLIENT_ID);

?>