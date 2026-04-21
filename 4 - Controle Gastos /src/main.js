const form = document.getElementById("formGastos");
const inputDescricao = document.getElementById("descricao");
const inputValor = document.getElementById("valor");
const selectCategoria = document.getElementById("categoria");
const selectFiltro = document.getElementById("categoriaFiltro");
const listaUl = document.getElementById("listaGastos");
const spanValorTotal = document.getElementById("valorTotal");

// array principal (carrega do LocalStorage ou inicia vazio)
let gastos = JSON.parse(localStorage.getItem("gastos")) || [];

// função para atualizar o valor total na tela
const atualizarTotal = () => {
  const total = gastos.reduce((acc, gasto) => acc + gasto.valor, 0); // reduce
  // exibindo o valor de forma simples com duas casas decimais
  spanValorTotal.textContent = `R$ ${total.toFixed(2)}`;
};

// função para renderizar a lista com filtro
const renderizarLista = (categoriaFiltrada = "Todos") => {
  listaUl.innerHTML = "";

  const gastosExibidos =
    categoriaFiltrada === "Todos"
      ? gastos
      : gastos.filter((g) => g.categoria === categoriaFiltrada);

  gastosExibidos.forEach((gasto, index) => {
    const li = document.createElement("li");
    li.className =
      "flex justify-between items-center p-3 w-full bg-bg-1 rounded-lg border-2 border-bg-3";

    li.innerHTML = `
            <div class="flex flex-col">
                <span class="font-bold text-fg-1">${gasto.descricao}</span>
                <span class="text-xs text-orange">${gasto.categoria}</span>
            </div>
            <div class="flex items-center justify-center gap-4">
                <span class="font-semibold">R$ ${gasto.valor.toFixed(2)}</span>
                <button onclick="removerGasto(${index})" class="flex items-center text-red hover:text-red-h transition-all ease-in-out cursor-pointer">
                    <i class='bx bx-trash text-xl'></i>
                </button>
            </div>
        `;
    listaUl.appendChild(li);
  });

  atualizarTotal();
  localStorage.setItem("gastos", JSON.stringify(gastos));
};

// submit do formulário
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const descricao = inputDescricao.value.trim();
  const valorNum = parseFloat(inputValor.value);
  const categoria = selectCategoria.value;

  if (!descricao || isNaN(valorNum) || !categoria) {
    alert("Preencha todos os campos corretamente!");
    return;
  }

  // primeira letra maiúscula
  const descTratada =
    descricao.charAt(0).toUpperCase() + descricao.slice(1).toLowerCase();

  const novoGasto = {
    descricao: descTratada,
    valor: valorNum,
    categoria: categoria,
  };

  gastos.push(novoGasto);

  // reseta o formulário e foca no primeiro campo
  form.reset();
  inputDescricao.focus();

  renderizarLista(selectFiltro.value);
});

// função para remover gasto
window.removerGasto = (index) => {
  gastos.splice(index, 1);
  renderizarLista(selectFiltro.value);
};

// mudança de filtro
selectFiltro.addEventListener("change", (e) => {
  renderizarLista(e.target.value);
});

renderizarLista();
