<?php
require_once 'includes/auth.php';

if (estaLogado()) {
    header("Location: index.php");
    exit;
}

$erro = $_GET['erro'] ?? '';
$tentativas = isset($_GET['tentativas']) ? (int)$_GET['tentativas'] : 0;

$mensagem = '';
if ($erro === 'invalido') {
    $mensagem = 'Login ou senha inválidos.';
    if ($tentativas > 0) {
        $restantes = MAX_TENTATIVAS - $tentativas;
        $mensagem .= " Você tem mais {$restantes} tentativa(s) antes do bloqueio.";
    }
} elseif ($erro === 'bloqueado') {
    $mensagem = 'Usuário bloqueado após 3 tentativas incorretas. Entre em contato com o administrador do sistema.';
} elseif ($erro === 'vazio') {
    $mensagem = 'Informe o login e a senha.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CRUD Mundo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">🌍 CRUD Mundo</div>
    </header>

    <main class="main-content" style="max-width: 420px;">
        <div class="card">
            <h2 style="margin-bottom: 1.5rem;">Acesso ao Sistema</h2>

            <?php if ($mensagem): ?>
                <p style="background:#fdecea; color:var(--danger); padding:0.75rem 1rem; border-radius:4px; margin-bottom:1rem; font-weight:600;">
                    <?= htmlspecialchars($mensagem) ?>
                </p>
            <?php endif; ?>

            <form action="actions/auth_action.php" method="POST">
                <div class="form-group">
                    <label>Login</label>
                    <input type="text" name="login" required autofocus>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" required>
                </div>
                <button type="submit" class="btn btn-success" style="width:100%; margin-top: 0.5rem;">Entrar</button>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 - Etec São José dos Campos - Curso Técnico em Desenvolvimento de Sistemas</p>
    </footer>
</body>
</html>
