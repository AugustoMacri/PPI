<?php

class Endereco
{
  //atributos da classe endereco
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade) //construtor da classe endereco
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? ''; //Recebe o cep do index via get

//Condicao para determinar a cidade que vai aparecer dependendo do valor digitado
if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json'); //definicao do conteúdo que sera retornado
echo json_encode($endereco); //retorna o endereco em formato json
