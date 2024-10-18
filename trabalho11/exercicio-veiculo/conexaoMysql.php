<?php

function mysqlConnect()
{
  $db_host = "sql213.infinityfree.com";
  $db_username = "if0_37068805";
  $db_password = "3OjZdvjyAQ";
  $db_name = "if0_37068805_ppi";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
