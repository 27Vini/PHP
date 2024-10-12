<?php

function conectar(): PDO{
    return new PDO("mysql:host=;dbname=;charset=utf8","","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

?>