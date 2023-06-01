<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "escola_ead";

  $mysqli = new mysqli($host, $user, $pass, $dbname);

  if($mysqli->connect_errno){
    echo "Erro ao conectar ".$mysqli->connect_error;
    exit();
  }

?>