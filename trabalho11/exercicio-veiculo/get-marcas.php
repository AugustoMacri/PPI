<?php

//Aqui o objetivo é buscar todas as marcas presentes no bd

require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = "SELECT DISTINCT marca FROM veiculo"; //Query para selecionar todas as marcas distintas
    $stmt = $pdo->query($sql); //Executa a query "$sql" com o método query do pdo

    $marcas = $stmt->fetchAll(PDO::FETCH_COLUMN); //fetchAll para pegar todas as linhas e armazenar em marcas
    
    echo json_encode(($marcas)); //Converte o array marcas para json com json_encode
}
catch(Exception $e){
    echo json_encode(["error" => $e->getMessage()]);
}