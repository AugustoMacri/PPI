<?php

/*
Motivo da vulnerabilidade:
A vulnerabilidade ocorre porque quando o usuario passa um valor do formulário, o código original insere diretamente os dados do usuário na 
consulta SQL.
Então, se for inserido comandos SQL no campo de formulário, esses comandos vão ser executados pelo banco.

Diferente de quando se usa o prepared statement, que aloca o comando sem os valores primeiro e depois os insere, não sendo executado como sql.
*/
require "../conexaoMysql.php";
$pdo = mysqlConnect();

//Obtenção dos dados do formulario via metodo POST
$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

try {

  /*
  // NÃO FAÇA ISSO! Exemplo de código vulnerável a inj. de sql
  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES ('$nome', '$telefone');
  SQL;  
  
  //foi feito um cadastro com "tolo'); DELETE FROM aluno; -- comment" no campo do telefone
  //Executando esse código, ele apagou todos os alunos da tabela alunos
  $pdo->exec($sql);
  header("location: mostra-alunos.php");
  exit();
  */

  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES (?, ?);
  SQL;  

  // Prepara a declaração SQL
  $stmt = $pdo->prepare($sql);
  // Executa a declaração com os parâmetros fornecidos
  $stmt->execute([$nome, $telefone]);
  
  header("location: mostra-alunos.php"); //Redireciona para a pagina de alunos cadastrados
  exit();

} 
catch (Exception $e) {  
  exit('Falha ao cadastrar os dados: ' . $e->getMessage()); //mensagem de erro
}
