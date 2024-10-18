<?php

$cep = $_GET['cep'] ?? ''; //Recebe o cep do index via get

//Condicao para determinar a cidade que vai aparecer dependendo do valor digitado
if ($cep == '38400-100')
  echo 'Uberlândia';
else if ($cep == '38700-000')
  echo 'Patos de Minas';
else {
  http_response_code(404); //caso nao for nenhuma, retorna erro 404 (Not Found)
  echo "$cep is not available";
}
