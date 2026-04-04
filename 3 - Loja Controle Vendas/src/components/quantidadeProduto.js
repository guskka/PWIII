function toggleProduto(checkbox) {
  const slide = checkbox.closest(".slideItem");
  const input = slide.querySelector("input[type='number']");
  const botoes = slide.querySelectorAll(".btnAlterarQuantidade");

  if (checkbox.checked) {
    input.value = 1;
    input.classList.remove("opacity-50");
    botoes.forEach((btn) => {
      btn.disabled = false;
      btn.classList.remove("opacity-50", "cursor-not-allowed");
      btn.classList.add(
        "transition-colors",
        "ease-in-out",
        "duration-350",
        "active:bg-orange-h",
      );
    });
  } else {
    input.value = 0;
    input.classList.add("opacity-50");
    botoes.forEach((btn) => {
      btn.disabled = true;
      btn.classList.add("opacity-50", "cursor-not-allowed");
      btn.classList.remove(
        "transition-colors",
        "ease-in-out",
        "duration-350",
        "active:bg-orange-h",
      );
    });
  }
}

function alterarQuantidade(botao, valor) {
  const container = botao.parentElement;
  const input = container.querySelector(".quantidadeProduto");

  let valorAtual = parseInt(input.value) || 0;
  let novoValor = valorAtual + valor;

  if (novoValor >= 1) {
    input.value = novoValor;
  }

  calcularValorCompra();
}
