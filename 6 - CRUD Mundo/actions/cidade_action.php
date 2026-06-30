<?php
require_once '../config/conexao.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'create' || $action === 'update') {
    $nome = $_POST['nome'];
    $pais_id = $_POST['pais_id'];
    $populacao = $_POST['populacao'] ?: null;
    $area_km2 = $_POST['area_km2'] ?: null;
    $clima = $_POST['clima'] ?: null;
    $governante_id = $_POST['governante_id'] ?: null;
    $fundacao = $_POST['data_fundacao'] ?: null;

    if ($action === 'create') {
        $stmt = $pdo->prepare("INSERT INTO cidades (nome, pais_id, populacao, area_km2, clima, governante_id, data_fundacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $pais_id, $populacao, $area_km2, $clima, $governante_id, $fundacao]);
    } else {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE cidades SET nome = ?, pais_id = ?, populacao = ?, area_km2 = ?, clima = ?, governante_id = ?, data_fundacao = ? WHERE id = ?");
        $stmt->execute([$nome, $pais_id, $populacao, $area_km2, $clima, $governante_id, $fundacao, $id]);
    }
} elseif ($action === 'delete') {
    $stmt = $pdo->prepare("DELETE FROM cidades WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: ../views/cidades.php");