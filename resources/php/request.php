<?php
function makeRequest($URL,$CLIENT_ID){
    
    $curl = curl_init($URL);
    curl_setopt($curl, CURLOPT_URL, $URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
    "X-MAL-CLIENT-ID: $CLIENT_ID"
    );
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    
    $obj = json_decode($resp, true);
    $json = json_encode($obj["data"]);
    return $json;
}

?>
