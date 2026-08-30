<?php
require_once '../includes/auth.php';
exigirLogin('../');
require_once '../config/conexao.php';
include_once '../includes/header.php';

$logs = $pdo->query("
    SELECT l.*, u.nome AS usuario_nome
    FROM logs l
    LEFT JOIN usuarios u ON l.usuario_id = u.id
    ORDER BY l.data_hora DESC
    LIMIT 200
")->fetchAll();

$rotulos = [
    'LOGIN_SUCESSO'      => 'Login realizado',
    'LOGIN_FALHA'        => 'Falha de login',
    'LOGIN_BLOQUEADO'    => 'Tentativa em usuário bloqueado',
    'BLOQUEIO_AUTOMATICO'=> 'Usuário bloqueado (3 falhas)',
    'TROCA_SENHA'        => 'Senha alterada',
    'LOGOUT'             => 'Logout',
];
?>
<div class="card">
    <h2>Logs de Acesso ao Sistema</h2>
    <p style="color:#666; margin-top:0.5rem;">Últimos 200 eventos registrados de login, falhas, bloqueios e trocas de senha.</p>
</div>
<input type="text" id="inputBusca" class="search-box" onkeyup="buscarTabela()" placeholder="🔍 Pesquisar nos logs...">
<table>
    <thead><tr><th>Data/Hora</th><th>Usuário</th><th>Login Tentado</th><th>Ação</th><th>IP</th></tr></thead>
    <tbody>
        <?php foreach($logs as $l): ?>
        <tr>
            <td><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($l['data_hora']))) ?></td>
            <td><?= htmlspecialchars($l['usuario_nome'] ?? '—') ?></td>
            <td><?= htmlspecialchars($l['login_tentado'] ?? '—') ?></td>
            <td><?= htmlspecialchars($rotulos[$l['acao']] ?? $l['acao']) ?></td>
            <td><?= htmlspecialchars($l['ip_address'] ?? '—') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>
