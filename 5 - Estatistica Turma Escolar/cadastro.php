<?php
$turma = $_POST["turma"];
$qtd_alunos = intval($_POST["qtd_alunos"]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Notas</title>
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
  <main class="flex flex-col gap-12 items-center justify-center mt-20 rounded-lg font-geist">
    <div class="text-center">
      <h1 class="mb-1 font-junicode font-medium tracking-wide text-center text-7xl">cadastro notas <br><span class="text-orange italic"><?php echo htmlspecialchars($turma); ?></span></h1>
    </div>

    <div>
      <form id="formCadastro" class="flex flex-col gap-4 h-65 overflow-y-auto scrollbar-thin [scrollbar-color:var(--color-orange)_var(--color-bg-0-h)]" method="POST" action="relatorio.php">
        <input type="hidden" name="turma" value="<?php echo $turma; ?>">
        <input type="hidden" name="qtd_alunos" value="<?php echo $qtd_alunos; ?>">

        <?php for ($i = 0; $i < $qtd_alunos; $i++) { ?>
          <h3>Aluno <?php echo $i + 1; ?></h3>
          <div class="flex gap-4 items-center justify-between">
            <input class="py-2 px-5 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="text" name="alunos[<?php echo $i; ?>][nome]" placeholder="Nome..." required>
            <input class="py-2 px-5 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="number" name="alunos[<?php echo $i; ?>][nota1]" step="0.1" min="0" max="10" placeholder="Nota P1..." required>
            <input class="py-2 px-5 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="number" name="alunos[<?php echo $i; ?>][nota2]" step="0.1" min="0" max="10" placeholder="Nota P2..." required>
            <input class="py-2 px-5 mr-2 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="number" name="alunos[<?php echo $i; ?>][trabalho]" step="0.1" min="0" max="10" placeholder="Trabalho..." required>
          </div>
          <hr>
        <?php } ?>
      </form>
    </div>

    <div class="flex flex-col gap-2 items-center">
      <button class="flex items-center justify-center gap-1 py-2 px-5 rounded-lg bg-fg-1 text-bg-0-h cursor-pointer" type="submit" form="formCadastro">
        Gerar relatório
        <i class="bx bx-arrow-right-stroke"></i>
      </button>
      <a class="flex items-center justify-center gap-1 w-full py-2 px-5 rounded-lg bg-bg-0 text-fg-1 cursor-pointer" href="index.php">Voltar ao início</a>
    </div>
  </main>
</body>

</html>