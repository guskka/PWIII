<?php 
require_once '../config/conexao.php';
include_once '../includes/header.php';

$cidades = $pdo->query("SELECT c.*, p.nome AS pais_nome, g.nome AS gov_nome FROM cidades c JOIN paises p ON c.pais_id = p.id LEFT JOIN governantes g ON c.governante_id = g.id ORDER BY c.nome ASC")->fetchAll();
$paises = $pdo->query("SELECT id, nome FROM paises ORDER BY nome ASC")->fetchAll();
$governantes = $pdo->query("SELECT id, nome FROM governantes ORDER BY nome ASC")->fetchAll();
?>
<div class="card">
    <h2>Cadastrar / Editar Cidade</h2>
    <form action="../actions/cidade_action.php" method="POST">
        <input type="hidden" name="action" id="action_cidade" value="create">
        <input type="hidden" name="id" id="id_cidade">
        <div class="form-grid">
            <div class="form-group"><label>Nome</label><input type="text" name="nome" id="nome" required></div>
            <div class="form-group"><label>País Correspondente</label>
                <select name="pais_id" id="pais_id" required>
                    <option value="">Selecione...</option>
                    <?php foreach($paises as $p): ?><option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"><label>População</label><input type="number" name="populacao" id="populacao"></div>
            <div class="form-group"><label>Área (km²)</label><input type="number" step="0.01" name="area_km2" id="area_km2"></div>
            <div class="form-group"><label>Clima</label><input type="text" name="clima" id="clima"></div>
            <div class="form-group"><label>Governante Local (Prefeito)</label>
                <select name="governante_id" id="governante_id">
                    <option value="">Nenhum</option>
                    <?php foreach($governantes as $g): ?><option value="<?= $g['id'] ?>"><?= $g['nome'] ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"><label>Data de Fundação</label><input type="date" name="data_fundacao" id="data_fundacao"></div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<input type="text" id="inputBusca" class="search-box" onkeyup="buscarTabela()" placeholder="🔍 Pesquisar cidades...">
<table>
    <thead><tr><th>Cidade</th><th>País</th><th>População</th><th>Governante</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach($cidades as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= htmlspecialchars($c['pais_nome']) ?></td>
            <td><?= number_format($c['populacao'] ?? 0, 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($c['gov_nome'] ?? 'Sem Registro') ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick='editCidade(<?= json_encode($c) ?>)'>Editar</button>
                <a href="../actions/cidade_action.php?action=delete&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>