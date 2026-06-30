<?php
require_once '../config/conexao.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'create' || $action === 'update') {
    $nome = $_POST['nome'];
    $populacao = $_POST['populacao'] ?: null;
    $area_km2 = $_POST['area_km2'] ?: null;

    if ($action === 'create') {
        $stmt = $pdo->prepare("INSERT INTO continentes (nome, populacao, area_km2) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $populacao, $area_km2]);
    } else {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE continentes SET nome = ?, populacao = ?, area_km2 = ? WHERE id = ?");
        $stmt->execute([$nome, $populacao, $area_km2, $id]);
    }
} elseif ($action === 'delete') {
    try {
        $stmt = $pdo->prepare("DELETE FROM continentes WHERE id = ?");
        $stmt->execute([$_GET['id']]);
    } catch (PDOException $e) {
        echo "<script>alert('Erro: Não é possível deletar um continente que possua países associados.'); window.location.href='../views/continentes.php';</script>";
        exit;
    }
}
header("Location: ../views/continentes.php");