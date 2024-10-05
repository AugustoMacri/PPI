<?php

class Usuario
{
  public $email;
  public $senha;

  function __construct($email, $senha)
  {
    $this->email = $email;
    $this->senha = $senha;
  }

  public function SalvaEmArquivo()
  {
    // Abre o arquivo de texto para escrita de conteúdo no final
    $arq = fopen("usuarios.txt", "a");

    // Neste exemplo os dados são armazenados de maneira simplificada,
    // no formato textual com campos separados por ponto-e-vírgula.
    fwrite($arq, "\n{$this->email};{$this->senha}");

    // Fecha o arquivo de texto.
    fclose($arq);
  }
}

// Carrega as informações dos Usuarios do arquivo de texto
// e retorna um array de objetos correspondente
function carregaUsuariosDeArquivo()
{
  $arrayUsuarios = [];

  // Abre o arquivo clientes.txt para leitura
  $arq = fopen("usuarios.txt", "r");
  if (!$arq)
    return $arrayUsuarios;

  // Le os dados do arquivo, linha por linha, e armazena no vetor $Usuarios
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $contato = fgets($arq);

    // Separa dados na linha utilizando o ';' como separador
    list($email, $senha) = array_pad(explode(';', $contato), 2, null);

    // Cria novo objeto representado o contato e adiciona no final do array
    $novoContato = new Usuario($email, $senha);
    $arrayUsuarios[] = $novoContato;
  }

  // Fecha o arquivo
  fclose($arq);
  return $arrayUsuarios;
}

//Funcao para pegar a senha hash do usuario
function resgataSenhaHashDoBD($email)
{
  $arrayUsuarios = carregaUsuariosDeArquivo();

  foreach($arrayUsuarios as $user){
    if($user->email === $email){
      return $user->senha; //Retorna o hash da senha do user que esta vindulada no email
    }
  }

  return null;
}
