<?php 
require_once '../config/conexao.php';
include_once '../includes/header.php';

$paises = $pdo->query("SELECT p.*, c.nome AS continente_nome, g.nome AS gov_nome FROM paises p JOIN continentes c ON p.continente_id = c.id LEFT JOIN governantes g ON p.governante_id = g.id ORDER BY p.nome ASC")->fetchAll();
$continentes = $pdo->query("SELECT id, nome FROM continentes ORDER BY nome ASC")->fetchAll();
$governantes = $pdo->query("SELECT id, nome FROM governantes ORDER BY nome ASC")->fetchAll();
?>
<div class="card">
    <h2>Cadastrar / Editar País</h2>
    <form action="../actions/pais_action.php" method="POST">
        <input type="hidden" name="action" id="action_pais" value="create">
        <input type="hidden" name="id" id="id_pais">
        <div class="form-grid">
            <div class="form-group"><label>Nome</label><input type="text" name="nome" id="nome" required></div>
            <div class="form-group"><label>Continente</label>
                <select name="continente_id" id="continente_id" required>
                    <option value="">Selecione...</option>
                    <?php foreach($continentes as $c): ?><option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"><label>População</label><input type="number" name="populacao" id="populacao"></div>
            <div class="form-group"><label>Área (km²)</label><input type="number" step="0.01" name="area_km2" id="area_km2"></div>
            <div class="form-group"><label>Idioma</label><input type="text" name="idioma" id="idioma"></div>
            <div class="form-group"><label>Governante</label>
                <select name="governante_id" id="governante_id">
                    <option value="">Nenhum</option>
                    <?php foreach($governantes as $g): ?><option value="<?= $g['id'] ?>"><?= $g['nome'] ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"><label>Clima</label><input type="text" name="clima" id="clima"></div>
            <div class="form-group"><label>Regime Político</label><input type="text" name="regime_politico" id="regime_politico"></div>
            <div class="form-group"><label>Moeda</label><input type="text" name="moeda" id="moeda"></div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<input type="text" id="inputBusca" class="search-box" onkeyup="buscarTabela()" placeholder="🔍 Pesquisar países...">
<table>
    <thead><tr><th>Nome</th><th>Continente</th><th>População</th><th>Idioma</th><th>Governante</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach($paises as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['continente_nome']) ?></td>
            <td><?= number_format($p['populacao'] ?? 0, 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['idioma'] ?? '-') ?></td>
            <td><?= htmlspecialchars($p['gov_nome'] ?? 'Sem registro') ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick='editPais(<?= json_encode($p) ?>)'>Editar</button>
                <a href="../actions/pais_action.php?action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>