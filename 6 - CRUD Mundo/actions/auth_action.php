<?php
require_once '../includes/auth.php';
require_once '../config/conexao.php';

$login = trim($_POST['login'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($login === '' || $senha === '') {
    header("Location: ../login.php?erro=vazio");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = ?");
$stmt->execute([$login]);
$usuario = $stmt->fetch();

// Login inexistente: registra a tentativa sem vincular a um usuário.
if (!$usuario) {
    registrarLog($pdo, null, $login, 'LOGIN_FALHA');
    header("Location: ../login.php?erro=invalido");
    exit;
}

// Usuário já bloqueado: nem verifica a senha.
if ($usuario['bloqueado']) {
    registrarLog($pdo, $usuario['id'], $login, 'LOGIN_BLOQUEADO');
    header("Location: ../login.php?erro=bloqueado");
    exit;
}

if (password_verify($senha, $usuario['senha'])) {
    // Login correto: zera o contador de tentativas.
    $stmt = $pdo->prepare("UPDATE usuarios SET tentativas_falhas = 0 WHERE id = ?");
    $stmt->execute([$usuario['id']]);

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_login'] = $usuario['login'];
    $_SESSION['primeiro_acesso'] = (bool)$usuario['primeiro_acesso'];

    registrarLog($pdo, $usuario['id'], $login, 'LOGIN_SUCESSO');

    header("Location: ../index.php");
    exit;
}

// Senha incorreta: incrementa o contador de tentativas consecutivas.
$novasTentativas = $usuario['tentativas_falhas'] + 1;

if ($novasTentativas >= MAX_TENTATIVAS) {
    $stmt = $pdo->prepare("UPDATE usuarios SET tentativas_falhas = ?, bloqueado = 1 WHERE id = ?");
    $stmt->execute([$novasTentativas, $usuario['id']]);
    registrarLog($pdo, $usuario['id'], $login, 'BLOQUEIO_AUTOMATICO');
    header("Location: ../login.php?erro=bloqueado");
    exit;
}

$stmt = $pdo->prepare("UPDATE usuarios SET tentativas_falhas = ? WHERE id = ?");
$stmt->execute([$novasTentativas, $usuario['id']]);
registrarLog($pdo, $usuario['id'], $login, 'LOGIN_FALHA');
header("Location: ../login.php?erro=invalido&tentativas={$novasTentativas}");
