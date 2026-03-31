const qtd = document.getElementById("quantidadeProduto");

function aumentarQuantidade() {
  qtd.value = parseInt(qtd.value) + 1;
}

function diminuirQuantidade() {
  if (qtd.value > 1) {
    qtd.value = parseInt(qtd.value) - 1;
  }
}
