<?php

  if(!function_exists("protect")){

  
  function protect($admin)
  { 
    if(!isset($_SESSION)){
      session_start();
    }
  
    if(!isset($_SESSION['usuario'])){
      die("Você não tem permissão");
    }

    if($admin == 1 && $_SESSION['admin'] != 1){
      die("Você não tem permissão");
  
    }

  }
}
