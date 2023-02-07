
<?php
require('config.php');

$user = $_GET["user"];

// $url = "https://api.myanimelist.net/v2/anime?q=one&limit=4";
$url = "https://api.myanimelist.net/v2/users/$user/mangalist";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
"X-MAL-CLIENT-ID: $CLIENT_ID"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!

$resp = curl_exec($curl);
curl_close($curl);

$obj = json_decode($resp, true);
$json = json_encode($obj["data"]);
echo $json;
?>
