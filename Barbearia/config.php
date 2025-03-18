<?php

//Arquivo de configuracao do banco de dados
const DB_HOST = 'localhost'; //Alterar se necessario
const DB_NAME = 'barbearia';
const DB_USER = 'root'; // Alterar se necessario
const DB_PASS = ''; // Alterar se necessario

// Funcao para conectar ao banco de dados
function conectarBanco() {
  try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset-utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
   } catch (PDOException $e) {
    die("Erro na conexao: " . $e->getMessage());
    }
}
?>