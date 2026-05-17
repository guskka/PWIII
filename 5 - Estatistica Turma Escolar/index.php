<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estatística Turma Escolar</title>
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

<body class="flex flex-col items-center h-screen bg-bg-0-h text-fg-1">
  <main class="flex flex-col gap-12 items-center justify-center py-20 px-35 rounded-lg font-geist">
    <div class="text-center">
      <h1 class="mb-1 font-junicode font-medium tracking-wide text-center text-7xl">análise estatística de <br><span class="text-orange italic">turma escolar</span></h1>
      <p>Preencha os dados iniciais para começar a análise.</p>
    </div>

    <div>
      <form class="flex flex-col gap-3" method="POST" action="cadastro.php">
        <input class="py-2 px-5 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="text" id="turma" name="turma" placeholder="Nome da turma..." required>
        <input class="py-2 px-5 bg-none border-2 border-fg-3 rounded-4xl placeholder:text-fg-1 placeholder:opacity-50" type="number" id="qtd_alunos" name="qtd_alunos" placeholder="Quantidade de alunos..." min="1" required>
        <button class="flex items-center justify-center gap-1 py-2 px-5 rounded-lg bg-fg-1 text-bg-0-h cursor-pointer" type="submit">
          Avançar
          <i class="bx bx-arrow-right-stroke"></i>
        </button>
      </form>
    </div>
  </main>
</body>

</html>