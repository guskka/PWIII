<?php
$turma = $_POST['turma'];
$qtd_alunos = intval($_POST['qtd_alunos']);
$dados_alunos = $_POST['alunos'];

$soma_medias_turma = 0;
$maior_media = -1;
$menor_media = 11;
$aprovados = 0;
$recuperacao = 0;
$reprovados = 0;
$soma_todas_notas = 0;

$relatorio_alunos = [];

foreach ($dados_alunos as $aluno) {
  $nome = $aluno['nome'];
  $n1 = floatval($aluno['nota1']);
  $n2 = floatval($aluno['nota2']);
  $nt = floatval($aluno['trabalho']);

  $media = ($n1 + $n2 + $nt) / 3;
  $raiz_soma = sqrt($n1 + $n2 + $nt);
  $maior_nota_aluno = max($n1, $n2, $nt);
  $menor_nota_aluno = min($n1, $n2, $nt);
  $dif_absoluta = abs($maior_nota_aluno - $menor_nota_aluno);

  if ($media >= 7.0) {
    $situacao = "Aprovado";
    $aprovados++;
  } elseif ($media >= 5.0 && $media < 7.0) {
    $situacao = "Recuperação";
    $recuperacao++;
  } else {
    $situacao = "Reprovado";
    $reprovados++;
  }

  $soma_medias_turma += $media;
  $soma_todas_notas += ($n1 + $n2 + $nt);

  if ($media > $maior_media) {
    $maior_media = $media;
  }
  if ($media < $menor_media) {
    $menor_media = $media;
  }

  $relatorio_alunos[] = [
    'nome' => $nome,
    'n1' => $n1,
    'n2' => $n2,
    'nt' => $nt,
    'media' => $media,
    'raiz' => $raiz_soma,
    'dif' => $dif_absoluta,
    'situacao' => $situacao
  ];
}

$media_geral_turma = $soma_medias_turma / $qtd_alunos;
$percentual_aprovacao = ($aprovados / $qtd_alunos) * 100;

if ($percentual_aprovacao >= 70) {
  $mensagem_desempenho = "Excelente desempenho geral da turma. A grande maioria está aprovada.";
} elseif ($percentual_aprovacao >= 50) {
  $mensagem_desempenho = "Desempenho moderado. É importante focar nos alunos em recuperação.";
} else {
  $mensagem_desempenho = "O índice de aprovação ficou abaixo de 50%. A turma necessita de atenção pedagógica.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório Final</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style type="text/tailwindcss">
    @import "tailwindcss";

    @theme {
      --color-bg-0-h: #1d2021;
      --color-bg-0: #282828;
      --color-bg-1: #3c3836;
      --color-bg-2: #504945;
      --color-bg-3: #665c54;
      --color-bg-4: #7c6f64;

      --color-fg-0: #fbf1c7;
      --color-fg-1: #ebdbb2;
      --color-fg-2: #d5c4a1;
      --color-fg-3: #bdae93;
      --color-fg-4: #a89984;

      --color-red: #fb4934;
      --color-red-h: #cc241d;
      --color-green: #b8bb26;
      --color-green-h: #98971a;
      --color-yellow: #fabd2f;
      --color-yellow-h: #d79921;
      --color-blue: #83a598;
      --color-blue-h: #458588;
      --color-purple: #d3869b;
      --color-purple-h: #b16286;
      --color-aqua: #8ec07c;
      --color-aqua-h: #689d6a;
      --color-orange: #fe8019;
      --color-orange-h: #d65d0e;

      --font-geist: "Geist", sans-serif;
      --font-junicode: "Junicode", sans-serif;
    }
  </style>
  <link rel="stylesheet" href="./src/styles/style.css">
</head>

<body class="flex flex-col items-center max-h-screen bg-bg-0-h text-fg-1">
  <main class="flex flex-col gap-12 items-center justify-center py-20 px-35 rounded-lg font-geist">
    <div class="text-center">
      <h1 class="mb-1 font-junicode font-medium tracking-wide text-center text-7xl">relatório final<br><span class="text-orange italic"><?php echo $turma; ?></span></h1>
      <p>Resultados individuais por aluno.</p>
    </div>

    <table class="border-2 border-fg-1" border="1">
      <thead class="p-4 border-2">
        <tr class="">
          <th class="p-4">Nome</th>
          <th class="p-4">Nota 1</th>
          <th class="p-4">Nota 2</th>
          <th class="p-4">Trabalho</th>
          <th class="p-4">Média</th>
          <th class="p-4">Raiz Soma Notas</th>
          <th class="p-4">Diferença Absoluta</th>
          <th class="p-4">Situação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($relatorio_alunos as $ra) { ?>
          <tr>
            <td class="p-4"><?php echo htmlspecialchars($ra['nome']); ?></td>
            <td class="p-4"><?php echo number_format($ra['n1'], 1, ',', '.'); ?></td>
            <td class="p-4"><?php echo number_format($ra['n2'], 1, ',', '.'); ?></td>
            <td class="p-4"><?php echo number_format($ra['nt'], 1, ',', '.'); ?></td>
            <td class="p-4"><?php echo number_format($ra['media'], 2, ',', '.'); ?></td>
            <td class="p-4"><?php echo number_format($ra['raiz'], 2, ',', '.'); ?></td>
            <td class="p-4"><?php echo number_format($ra['dif'], 2, ',', '.'); ?></td>
            <td class="p-4"><?php echo $ra['situacao']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <h3>Relatório Estatístico da Turma</h3>
    <ul>
      <li>Média geral da turma: <?php echo number_format($media_geral_turma, 2, ',', '.'); ?></li>
      <li>Maior média encontrada: <?php echo number_format($maior_media, 2, ',', '.'); ?></li>
      <li>Menor média encontrada: <?php echo number_format($menor_media, 2, ',', '.'); ?></li>
      <li>Quantidade de aprovados: <?php echo $aprovados; ?></li>
      <li>Quantidade em recuperação: <?php echo $recuperacao; ?></li>
      <li>Quantidade de reprovados: <?php echo $reprovados; ?></li>
      <li>Percentual de aprovação: <?php echo number_format($percentual_aprovacao, 1, ',', '.'); ?>%</li>
      <li>Soma total de todas as notas lançadas: <?php echo number_format($soma_todas_notas, 1, ',', '.'); ?></li>
    </ul>

    <p><strong>Aviso do Sistema:</strong> <?php echo $mensagem_desempenho; ?></p>

    <br>
    <a class="flex items-center justify-center gap-1 py-2 px-5 rounded-lg bg-fg-1 text-bg-0-h cursor-pointer" href="index.php">Nova Análise</a>
  </main>
</body>

</html>