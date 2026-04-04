const secProdutos = document.getElementById("secProdutos");
const secSubValor = document.getElementById("secSubValor");
const secPagamento = document.getElementById("secPagamento");

secPagamento.style.display = "none";

function showPagamento() {
  secProdutos.style.display = "none";
  secSubValor.style.display = "none";
  secPagamento.style.display = "flex";
}

function showProdutos() {
  secPagamento.style.display = "none";
  secSubValor.style.display = "flex";
  secProdutos.style.display = "flex";
}
