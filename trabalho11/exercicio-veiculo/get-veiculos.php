<?php

//Aqui o objetivo é buscar todas as modelos presentes no bd

require "conexaoMysql.php";
$pdo = mysqlConnect();

$modelo = $_GET['modelo'] ?? ''; //Capturar o modelo passado

try {
    $sql = "SELECT marca, modelo, ano, cor, quilometragem FROM veiculo WHERE modelo = ?"; //Query para selecionar todos os modelos distintas, depende do modelo

    $stmt = $pdo->prepare($sql); //previnir ataques xss
    $stmt->execute([$modelo]); //executa a query substituindo o ? por $modelo

    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll para pegar todas as linhas e armazenar em modelos

    echo json_encode(($veiculos)); //Converte o array veiculos para json com json_encode
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
