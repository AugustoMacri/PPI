<?php

//Aqui o objetivo é buscar todas as modelos presentes no bd

require "conexaoMysql.php";
$pdo = mysqlConnect();

$marca = $_GET['marca'] ?? ''; //Capturar a marca que foi passada pela url usando get

try{
    $sql = "SELECT DISTINCT modelo FROM veiculo WHERE marca = ?"; //Query para selecionar todos os modelos distintas, depende da marca
    //marca tem (?) porque será substituido pela marca que foi capturada
    $stmt = $pdo->prepare($sql); //previnir ataques xss
    $stmt->execute([$marca]); //executa a query substituindo o ? pela marca($marca)

    $modelos = $stmt->fetchAll(PDO::FETCH_COLUMN); //fetchAll para pegar todas as linhas e armazenar em modelos
    
    echo json_encode(($modelos)); //Converte o array modelos para json com json_encode
}
catch(Exception $e){
    echo json_encode(["error" => $e->getMessage()]);
}