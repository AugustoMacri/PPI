<?php

require "../conexaoMysql.php";
require "paciente.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {

  case "adicionarPaciente":
    //--------------------------------------------------------------------------------------    
    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";

    // Resgata os dados do paciente
    $peso = $_POST["peso"] ?? "";
    $altura = $_POST["altura"] ?? "";
    $tipoSanguineo = $_POST["tipoSanguineo"] ?? "";

    try {
      // Insere os dados nas tabelas correlacionadas, cliente e enderecoCliente, utilizando transação
      Paciente::Create($pdo, $nome, $sexo, $email, $peso, $altura, $tipoSanguineo);
      header("location: pacientes.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "listarPacientes":
    //--------------------------------------------------------------------------------------
    try {
      $arrayPacientes = Paciente::GetFirst30($pdo);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($arrayPacientes);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

    //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}