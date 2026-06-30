<?php 
require_once '../config/conexao.php';
include_once '../includes/header.php';
$continentes = $pdo->query("SELECT * FROM continentes ORDER BY nome ASC")->fetchAll();
?>
<div class="card">
    <h2>Cadastrar / Editar Continente</h2>
    <form action="../actions/continente_action.php" method="POST">
        <input type="hidden" name="action" id="action_continente" value="create">
        <input type="hidden" name="id" id="id_continente">
        <div class="form-grid">
            <div class="form-group"><label>Nome</label><input type="text" name="nome" id="nome" required></div>
            <div class="form-group"><label>População</label><input type="number" name="populacao" id="populacao"></div>
            <div class="form-group"><label>Área (km²)</label><input type="number" step="0.01" name="area_km2" id="area_km2"></div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<input type="text" id="inputBusca" class="search-box" onkeyup="buscarTabela()" placeholder="🔍 Pesquisar continentes...">
<table>
    <thead><tr><th>Nome</th><th>População</th><th>Área (km²)</th><th>Países</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach($continentes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= number_format($c['populacao'] ?? 0, 0, ',', '.') ?></td>
            <td><?= number_format($c['area_km2'] ?? 0, 2, ',', '.') ?></td>
            <td><?= $c['total_paises'] ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick='editContinente(<?= json_encode($c) ?>)'>Editar</button>
                <a href="../actions/continente_action.php?action=delete&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>