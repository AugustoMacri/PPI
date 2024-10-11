<?php

require "../conexaoMysql.php";
require "produto.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {
    
  case "adicionarProduto":
    //--------------------------------------------------------------------------------------    
    $nome = $_POST["nome"] ?? "";
    $marca = $_POST["marca"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    // gera o hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
      Produto::Create($pdo, $nome, $marca, $descricao);
      header("location: produtos.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

    
  case "excluirProduto":
    //--------------------------------------------------------------------------------------
    $idProduto = $_GET["idProduto"] ?? "";
    try {
      Produto::Remove($pdo, $idP);
      header("location: produtos.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "listarProdutos":
    //--------------------------------------------------------------------------------------
    try {
      $arrayProdutos = Produto::GetFirst30($pdo);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($arrayProdutos);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

    //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}
