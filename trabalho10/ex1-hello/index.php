<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect(); // Função localizada em conexaoMysql.php

// Listagem de dados da tabela aluno
try {
  $sql = <<<SQL
    SELECT nome, telefone
    FROM aluno
  SQL;

  $stmt = $pdo->query($sql); // $stmt é um objeto do tipo PDOStatement
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello World - Listagem de Dados em Tabela do MySQL</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados na tabela <b>aluno</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Telefone</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) // Rodar enquanto ainda existir próx linha 
      {
        // Caracteres especiais para evitar ataque xss
        $nome = htmlspecialchars($row['nome']); // 
        $telefone = htmlspecialchars($row['telefone']);

        //Sintaxe para a geração das linhas da tabela com dados
        echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$telefone</td>
        </tr>      
        HTML;
      }
      ?>
    </table>
    <a href="../index.html">Menu de opções</a> <!-- Link para o menu de opções -->
  </div>

</body>

</html>