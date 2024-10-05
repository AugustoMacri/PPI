<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Dinâmica - Listagem de Contatos - Segura</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

  <div class="container">

    <h3>Contatos Carregados do Arquivo <i>clientes.txt</i></h3>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>cpf</th>
          <th>E-mail</th>
          <th>Senha</th>
          <th>cep</th>
          <th>Endereco</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>Estado</th>
        </tr>
      </thead>

      <tbody>
        <?php
        require "contatos.php";
        $arrayContatos = carregaContatosDeArquivo();
        foreach ($arrayContatos as $contato) {
          $nome = htmlspecialchars($contato->nome);
          $cpf = htmlspecialchars($contato->cpf);
          $email = htmlspecialchars($contato->email);
          $senha = htmlspecialchars($contato->senha);
          $cep = htmlspecialchars($contato->cep);
          $endereco = htmlspecialchars($contato->endereco);
          $bairro = htmlspecialchars($contato->bairro);
          $cidade = htmlspecialchars($contato->cidade);
          $estado = htmlspecialchars($contato->estado);
          echo <<<HTML
            <tr>
              <td>$nome</td>
              <td>$cpf</td>
              <td>$email</td>
              <td>$senha</td>
              <td>$cep</td>
              <td>$endereco</td>
              <td>$bairro</td>
              <td>$cidade</td>
              <td>$estado</td>
            </tr>
          HTML;
        }
        ?>
      </tbody>
    </table>
    <a href="index.html">Voltar à página inicial</a>
  </div>

</body>

</html>