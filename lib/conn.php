<?php

  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "escola_ead";

  try{
    $conn = new PDO("mysql:host=$host;dbname=" .$dbname, $user, $pass);
    //echo "conexão realizada com sucesso";
  }catch(PDOException $e){
    echo "Erro ao conectar ".$e->getMessage();
  }
?>