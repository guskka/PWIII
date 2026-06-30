<?php
require_once 'config/conexao.php';

$totalPaises = $pdo->query("SELECT COUNT(*) FROM paises")->fetchColumn();
$totalCidades = $pdo->query("SELECT COUNT(*) FROM cidades")->fetchColumn();

$cidadeMaisPopulosa = $pdo->query("
    SELECT c.nome AS cidade, p.nome AS pais, c.populacao 
    FROM cidades c 
    JOIN paises p ON c.pais_id = p.id 
    ORDER BY c.populacao DESC LIMIT 1
")->fetch();

$cidadesPorCont = $pdo->query("
    SELECT cont.nome AS continente, COUNT(cid.id) AS total 
    FROM continentes cont
    LEFT JOIN paises p ON p.continente_id = cont.id
    LEFT JOIN cidades cid ON cid.pais_id = p.id
    GROUP BY cont.id
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MUNDO CRUD</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">🌍 CRUD Mundo</div>
        <nav class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="views/continentes.php">Continentes</a>
            <a href="views/paises.php">Países</a>
            <a href="views/cidades.php">Cidades</a>
            <a href="views/governantes.php">Governantes</a>
        </nav>
    </header>
    
    <main class="main-content">
        <h2 style="margin-bottom: 1.5rem;">Painel de Estatísticas Globais</h2>
        
        <div class="card-grid">
            <div class="card" style="border-left: 5px solid var(--success);">
                <h3>Total de Países</h3>
                <p style="font-size: 2rem; font-weight: bold; color: var(--success);"><?= $totalPaises ?></p>
            </div>
            <div class="card" style="border-left: 5px solid #9b59b6;">
                <h3>Total de Cidades</h3>
                <p style="font-size: 2rem; font-weight: bold; color: #9b59b6;"><?= $totalCidades ?></p>
            </div>
            <div class="card" style="border-left: 5px solid var(--warning);">
                <h3>Cidade Mais Populosa</h3>
                <p style="font-weight: bold;"><?= $cidadeMaisPopulosa ? htmlspecialchars($cidadeMaisPopulosa['cidade'] . " (" . $cidadeMaisPopulosa['pais'] . ")") : 'Nenhuma' ?></p>
                <small><?= $cidadeMaisPopulosa ? number_format($cidadeMaisPopulosa['populacao'], 0, ',', '.') . " habitantes" : '' ?></small>
            </div>
        </div>

        <div class="card">
            <h3>Cidades Cadastradas por Continente</h3>
            <table>
                <thead><tr><th>Continente</th><th>Quantidade de Cidades</th></tr></thead>
                <tbody>
                    <?php foreach($cidadesPorCont as $cc): ?>
                    <tr>
                        <td><?= htmlspecialchars($cc['continente']) ?></td>
                        <td><strong><?= $cc['total'] ?></strong> cidades</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 - Etec São José dos Campos - Curso Técnico em Desenvolvimento de Sistemas</p>
    </footer>
</body>
</html>