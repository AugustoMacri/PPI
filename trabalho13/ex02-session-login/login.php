<?php

require "conexaoMysql.php";

class LoginResult //Declaração de uma classe LoginResult
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation) //Construtor da classe
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}

function checkUserCredentials($pdo, $email, $senha) //Funcao que vai fazer a requisição para o banco de dados de acordo com os valores digitados no formulário
{
  //Consulta SQL para pegar o hash da senha no bd
  $sql = <<<SQL
    SELECT senhaHash
    FROM cliente
    WHERE email = ?
    SQL;

  try {
    // É necessário utilizar prepared statements por incluir (Evita SQL injection)
    // parâmetros informados pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash)
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    if (!password_verify($senha, $senhaHash))
      return false; // email e/ou senha incorreta

    // email e senha corretos
    return true;
  } catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

//Obtenção dos dados do formulario
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect(); //Conecta com o banco

//Varificação das credenciais do user
if (checkUserCredentials($pdo, $email, $senha)) {
  // Define o parâmetro 'httponly' para o cookie de sessão, para que o cookie
  // possa ser acessado apenas pelo navegador nas requisições http (e não por código JavaScript).
  // Aumenta a segurança evitando que o cookie de sessão seja roubado por eventual
  // código JavaScript proveniente de ataq. X S S.
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams);

  session_start(); //Inicia a sessao
  //Criação das variáveis vinculadas a sessão
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $email;
  $response = new LoginResult(true, 'home.php'); //Cria um novo objeto do tipo LoginResult(sucesso, localização)
} else
  $response = new LoginResult(false, '');  //Cria também um novo objetido mas com falha

header('Content-Type: application/json; charset=utf-8'); //Cabeçalho do JSON
echo json_encode($response); //Envia o JSON