<?php

function conectar() : PDO{
    return new PDO('mysql:dbname=;host=;charset=utf8','','',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

?>