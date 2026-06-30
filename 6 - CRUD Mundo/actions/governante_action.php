<?php
require_once '../config/conexao.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'create' || $action === 'update') {
    $nome = $_POST['nome'];
    $partido = $_POST['partido_politico'] ?: null;
    $nascimento = $_POST['data_nascimento'] ?: null;
    $idade = $_POST['idade'] ?: null;
    $inicio = $_POST['data_inicio_mandato'] ?: null;
    $fim = $_POST['data_fim_mandato'] ?: null;

    if ($action === 'create') {
        $stmt = $pdo->prepare("INSERT INTO governantes (nome, partido_politico, data_nascimento, idade, data_inicio_mandato, data_fim_mandato) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $partido, $nascimento, $idade, $inicio, $fim]);
    } else {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE governantes SET nome = ?, partido_politico = ?, data_nascimento = ?, idade = ?, data_inicio_mandato = ?, data_fim_mandato = ? WHERE id = ?");
        $stmt->execute([$nome, $partido, $nascimento, $idade, $inicio, $fim, $id]);
    }
} elseif ($action === 'delete') {
    $stmt = $pdo->prepare("DELETE FROM governantes WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: ../views/governantes.php");