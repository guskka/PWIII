<?php
require_once '../config/conexao.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'create' || $action === 'update') {
    $nome = $_POST['nome'];
    $continente_id = $_POST['continente_id'];
    $populacao = $_POST['populacao'] ?: null;
    $area_km2 = $_POST['area_km2'] ?: null;
    $idioma = $_POST['idioma'] ?: null;
    $governante_id = $_POST['governante_id'] ?: null;
    $clima = $_POST['clima'] ?: null;
    $regime = $_POST['regime_politico'] ?: null;
    $moeda = $_POST['moeda'] ?: null;

    if ($action === 'create') {
        $stmt = $pdo->prepare("INSERT INTO paises (nome, continente_id, populacao, area_km2, idioma, governante_id, clima, regime_politico, moeda) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $continente_id, $populacao, $area_km2, $idioma, $governante_id, $clima, $regime, $moeda]);
        
        $pdo->prepare("UPDATE continentes SET total_paises = total_paises + 1 WHERE id = ?")->execute([$continente_id]);
    } else {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE paises SET nome = ?, continente_id = ?, populacao = ?, area_km2 = ?, idioma = ?, governante_id = ?, clima = ?, regime_politico = ?, moeda = ? WHERE id = ?");
        $stmt->execute([$nome, $continente_id, $populacao, $area_km2, $idioma, $governante_id, $clima, $regime, $moeda, $id]);
    }
} elseif ($action === 'delete') {
    $stmtPais = $pdo->prepare("SELECT continente_id FROM paises WHERE id = ?");
    $stmtPais->execute([$_GET['id']]);
    $p = $stmtPais->fetch();
    
    if ($p) {
        $pdo->prepare("DELETE FROM paises WHERE id = ?")->execute([$_GET['id']]);
        $pdo->prepare("UPDATE continentes SET total_paises = GREATEST(0, total_paises - 1) WHERE id = ?")->execute([$p['continente_id']]);
    }
}
header("Location: ../views/paises.php");