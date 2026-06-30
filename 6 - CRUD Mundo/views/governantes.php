<?php 
require_once '../config/conexao.php';
include_once '../includes/header.php';
$govs = $pdo->query("SELECT * FROM governantes ORDER BY nome ASC")->fetchAll();
?>
<div class="card">
    <h2>Cadastrar / Editar Governante</h2>
    <form action="../actions/governante_action.php" method="POST">
        <input type="hidden" name="action" id="action_governante" value="create">
        <input type="hidden" name="id" id="id_governante">
        <div class="form-grid">
            <div class="form-group"><label>Nome</label><input type="text" name="nome" id="nome" required></div>
            <div class="form-group"><label>Partido Político</label><input type="text" name="partido_politico" id="partido_politico"></div>
            <div class="form-group"><label>Data Nascimento</label><input type="date" name="data_nascimento" id="data_nascimento"></div>
            <div class="form-group"><label>Idade</label><input type="number" name="idade" id="idade"></div>
            <div class="form-group"><label>Início Mandato</label><input type="date" name="data_inicio_mandato" id="data_inicio_mandato"></div>
            <div class="form-group"><label>Fim Mandato</label><input type="date" name="data_fim_mandato" id="data_fim_mandato"></div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<input type="text" id="inputBusca" class="search-box" onkeyup="buscarTabela()" placeholder="🔍 Pesquisar governantes...">
<table>
    <thead><tr><th>Nome</th><th>Partido</th><th>Idade</th><th>Mandato</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach($govs as $g): ?>
        <tr>
            <td><?= htmlspecialchars($g['nome']) ?></td>
            <td><?= htmlspecialchars($g['partido_politico'] ?? '-') ?></td>
            <td><?= $g['idade'] ?? '-' ?></td>
            <td><?= ($g['data_inicio_mandato'] && $g['data_fim_mandato']) ? date('d/m/Y', strtotime($g['data_inicio_mandato'])).' até '.date('d/m/Y', strtotime($g['data_fim_mandato'])) : '-' ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick='editGovernante(<?= json_encode($g) ?>)'>Editar</button>
                <a href="../actions/governante_action.php?action=delete&id=<?= $g['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>