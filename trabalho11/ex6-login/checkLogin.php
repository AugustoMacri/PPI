<?php

class LoginResult
{
  //Atributos
  public $isAuthorized;
  public $newLocation;

  function __construct($isAuthorized, $newLocation) //Definição do construtor da classe
  {
    $this->isAuthorized = $isAuthorized;
    $this->newLocation = $newLocation;
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Validação simplificada para fins didáticos. Não faça isso!
if ($email == 'fulano@mail.com' && $senha == '123456')
  $loginResult = new LoginResult(true, 'home.html');
else
  $loginResult = new LoginResult(false, '');

header('Content-type: application/json'); //definicao do conteúdo que sera retornado
echo json_encode($loginResult); //retorna o endereco em formato json

// 1- Após colocar a senha como 123 o status code é de 200 e o retorno é {"isAuthorized":false,"newLocation":""}
// 2 - Após colocar a senha como 123456 o status code é de 200 e o retorno é {"isAuthorized":true,"newLocation":"home.html"}