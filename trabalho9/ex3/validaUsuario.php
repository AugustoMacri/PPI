<?php

require "usuarios.php";

// coleta os dados do formulário
$email = $_POST["email"] ?? "";
$senhaFornecida = $_POST["senha"] ?? "";

//resgatando do BD o hash
$senhaHash = resgataSenhaHashDoBD($email);

if (password_verify($senhaFornecida, $senhaHash)) {
    header("location: logado.php");
} else {
    echo "Senha incorreta ou email não encontrado.";
    // echo $senhaHash;
    //header("location: erroLogando.php");
}
