<?php

function exitWhenNotLoggedIn()
{
  if (!isset($_SESSION['loggedIn'])) {
    //Se loggedIn não estiver definido, o usuário então não passou pelo login e não deve acessar esta página 
    header("Location: index.html");
    exit();
  }
}
