<?php
function makeRequest($URL,$CLIENT_ID){
    //MAKES REQUEST TO MY ANIME LIST
    
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

function makeDBRequest($type){
    $serv ="localhost";
    $user ="root";
    $pass ="";
    $bbdd ="mal_db";

    $sql="SELECT * FROM manga";

    $conexion = new mysqli ($serv, $user, $pass, $bbdd);
    if ($conexion-> connect_error)
    {die("Error en la conexion: ".$conexion->connect_error);}


    if ($conexion->query($sql)===TRUE){
        echo "LA CONSULTA SE HA REALIZADO";}
    else { echo "Error: ".$conexion->error;}
    $conexion->close();
    }
    ?>


