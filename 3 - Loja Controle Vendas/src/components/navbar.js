const secProdutos = document.getElementById("secProdutos");
const secPagamento = document.getElementById("secPagamento");

secPagamento.style.display = "none";

function showPagamento() {
  secProdutos.style.display = "none";
  secPagamento.style.display = "flex";
}

function showProdutos() {
  secPagamento.style.display = "none";
  secProdutos.style.display = "flex";
}
