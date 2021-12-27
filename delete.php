<?php 
require_once './database/connection.php';

session_start();

if (empty($_SESSION['id_email'])) {
    header('location: login.php');
}

$id_apontamento = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $id_apontamento = $_POST['id'];

    $statement = $pdo->prepare("UPDATE apontamento SET ativo = 0 WHERE id = :id");

    $statement->bindValue(':id', $id_apontamento);

    $statement->execute();
    header('location: apontamentos.php');
    exit;
}
?>