<?php
function mysqlConnect()
{
    $host = "sql213.infinityfree.com";
    $username = "if0_37068805";
    $password = "3OjZdvjyAQ";
    $dbname = "if0_37068805_ppi"; // Corrigido o nome do banco de dados
    $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
        echo "Conexão bem-sucedida!";
        return $pdo;
    } catch (Exception $e) {
        exit('Falha na conexão com o MySQL: ' . $e->getMessage());
    }
}

mysqlConnect();
?>
