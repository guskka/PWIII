<?php
require_once 'includes/auth.php';

if (!estaLogado()) {
    header("Location: login.php");
    exit;
}

$primeiroAcesso = !empty($_SESSION['primeiro_acesso']);

$erro = $_GET['erro'] ?? '';
$mensagem = '';
if ($erro === 'atual') {
    $mensagem = 'A senha atual informada está incorreta.';
} elseif ($erro === 'nova') {
    $mensagem = 'A nova senha deve ter ao menos 6 caracteres e a confirmação precisa ser idêntica a ela.';
} elseif ($erro === 'igual') {
    $mensagem = 'A nova senha não pode ser igual à senha atual.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha - CRUD Mundo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">🌍 CRUD Mundo</div>
        <?php if (!$primeiroAcesso): ?>
        <nav class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="logout.php">Sair</a>
        </nav>
        <?php endif; ?>
    </header>

    <main class="main-content" style="max-width: 460px;">
        <div class="card">
            <h2 style="margin-bottom: 0.5rem;">Troca de Senha</h2>

            <?php if ($primeiroAcesso): ?>
                <p style="background:#fff8e1; color:#8a6d3b; padding:0.75rem 1rem; border-radius:4px; margin-bottom:1rem;">
                    Este é o seu primeiro acesso ao sistema. Por segurança, você precisa cadastrar uma nova senha antes de continuar.
                </p>
            <?php endif; ?>

            <?php if ($mensagem): ?>
                <p style="background:#fdecea; color:var(--danger); padding:0.75rem 1rem; border-radius:4px; margin-bottom:1rem; font-weight:600;">
                    <?= htmlspecialchars($mensagem) ?>
                </p>
            <?php endif; ?>

            <form action="actions/senha_action.php" method="POST">
                <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" name="senha_atual" required autofocus>
                </div>
                <div class="form-group">
                    <label>Nova Senha</label>
                    <input type="password" name="nova_senha" minlength="6" required>
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Senha</label>
                    <input type="password" name="confirmar_senha" minlength="6" required>
                </div>
                <button type="submit" class="btn btn-success" style="width:100%; margin-top: 0.5rem;">Salvar Nova Senha</button>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 - Etec São José dos Campos - Curso Técnico em Desenvolvimento de Sistemas</p>
    </footer>
</body>
</html>
