const subValorCompraElement = document.getElementById("subValorCompra");
const valorCompraElement = document.getElementById("valorCompra");

function calcularValorCompra() {
  let subValorCompra = 0;
  const produtos = document.querySelectorAll(".slideItem");

  produtos.forEach((produto) => {
    const checkbox = produto.querySelector(".checkboxProduto");
    const quantidade =
      parseFloat(produto.querySelector(".quantidadeProduto").value) || 0;
    const preco = parseFloat(checkbox.dataset.preco);

    if (checkbox.checked) {
      subValorCompra += preco * quantidade;
    }
  });

  subValorCompraElement.textContent = subValorCompra.toFixed(2);

  let valorCompra = subValorCompra;
  const metodoPagamento = document.querySelector(".radioPagamento:checked");
  const parcelas = document.getElementById("parcelas").value;

  if (metodoPagamento.id === "aVista") {
    valorCompra = subValorCompra - subValorCompra * 0.085;
    valorCompraElement.textContent = valorCompra.toFixed(2);
  } else if (metodoPagamento.id === "aPrazo") {
    const valorDaParcela = subValorCompra / parcelas;

    if (valorDaParcela < 10) {
      const radioAVista = document.getElementById("aVista");

      radioAVista.checked = true;
      alert(
        "O valor da parcela não pode ser inferior a R$10,00. O pagamento foi alterado para À Vista",
      );

      return calcularValorCompra();
    }

    const taxaAdicional = 6.9;
    valorCompra =
      subValorCompra + subValorCompra * 0.06 + taxaAdicional * parcelas;
    valorCompraElement.textContent = valorCompra.toFixed(2);

    console.log("valorDaParcela:", valorDaParcela.toFixed(2));
  }
  console.log("subValorCompra:", subValorCompra.toFixed(2));
  console.log("valorCompra:", valorCompra.toFixed(2));
  console.log("------------------------------");
}

document
  .querySelectorAll(".checkboxProduto, .radioPagamento, #parcelas")
  .forEach((item) => {
    item.addEventListener("change", calcularValorCompra);
  });
