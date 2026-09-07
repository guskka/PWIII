<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mundo - Painel Geográfico</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">🌍 CRUD Mundo</div>
        <nav class="nav-links">
            <a href="../index.php">Dashboard</a>
            <a href="continentes.php">Continentes</a>
            <a href="paises.php">Países</a>
            <a href="cidades.php">Cidades</a>
            <a href="governantes.php">Governantes</a>
            <a href="logs.php">Logs</a>
            <a href="../trocar_senha.php">Alterar Senha</a>
            <span style="margin-left: 1.5rem; opacity: 0.85;">👤 <?= htmlspecialchars($_SESSION['usuario_nome'] ?? '') ?></span>
            <a href="../logout.php">Sair</a>
        </nav>
    </header>
    <main class="main-content">