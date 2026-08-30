<?php
require_once '../includes/auth.php';
require_once '../config/conexao.php';

if (!estaLogado()) {
    header("Location: ../login.php");
    exit;
}

$senhaAtual = $_POST['senha_atual'] ?? '';
$novaSenha = $_POST['nova_senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch();

if (!$usuario || !password_verify($senhaAtual, $usuario['senha'])) {
    header("Location: ../trocar_senha.php?erro=atual");
    exit;
}

if (strlen($novaSenha) < 6 || $novaSenha !== $confirmarSenha) {
    header("Location: ../trocar_senha.php?erro=nova");
    exit;
}

if (password_verify($novaSenha, $usuario['senha'])) {
    header("Location: ../trocar_senha.php?erro=igual");
    exit;
}

$novoHash = password_hash($novaSenha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE usuarios SET senha = ?, primeiro_acesso = 0 WHERE id = ?");
$stmt->execute([$novoHash, $usuario['id']]);

$_SESSION['primeiro_acesso'] = false;

registrarLog($pdo, $usuario['id'], $usuario['login'], 'TROCA_SENHA');

header("Location: ../index.php");
