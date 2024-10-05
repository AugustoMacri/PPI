<?php

require "usuarios.php";

// coleta os dados do formulário
$email = $_POST["email"] ?? "";
$senhaSemHash = $_POST["senha"] ?? "";

$senha = password_hash($senhaSemHash, PASSWORD_DEFAULT);

// cria um novo Usuarios e acrescenta no arquivo de texto
$novoUsuarios = new Usuario($email, $senha);
$novoUsuarios->SalvaEmArquivo();

// redireciona o navegador para a página de listagem de Usuarioss
header("location: listaUsuarios.php");
