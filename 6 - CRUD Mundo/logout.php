<?php
require_once 'includes/auth.php';

if (estaLogado()) {
    require_once 'config/conexao.php';
    registrarLog($pdo, $_SESSION['usuario_id'], $_SESSION['usuario_login'], 'LOGOUT');
}

$_SESSION = [];
session_destroy();

header("Location: login.php");
