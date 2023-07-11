<?php 
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    echo print_r($uri);
    echo $_SERVER["REQUEST_METHOD"];
    header("HTTP/1.1 200");
?>