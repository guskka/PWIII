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
  // percorre o array e compacta os valores em um só, acc começa com 0 e soma com o valor obtido do array
  const total = gastos.reduce((acc, gasto) => acc + gasto.valor, 0);
  // exibindo o valor de forma simples com duas casas decimais
  spanValorTotal.textContent = `R$ ${total.toFixed(2)}`;
};

// função para renderizar a lista com filtro
const renderizarLista = (categoriaFiltrada = "Todos") => {
  listaUl.innerHTML = "";

  // condicao if else
  const gastosExibidos =
    categoriaFiltrada === "Todos"
      ? gastos
      // item sendo analisado, depois atribuido a categoria do item, compara a categoria que usuário escolheu
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
  // transforma objetos do array em strings
  localStorage.setItem("gastos", JSON.stringify(gastos));
};

// submit do formulário
form.addEventListener("submit", (e) => {
  // cancela o refresh após clicar no botão submit do form
  e.preventDefault();

  const descricao = inputDescricao.value.trim();
  const valorNum = parseFloat(inputValor.value);
  const categoria = selectCategoria.value;

  // se não conter nada em descrição ou nan em valor ou nada em categoria 
  if (!descricao || isNaN(valorNum) || !categoria) {
    alert("Preencha todos os campos corretamente!");
    return;
  }

  // transforma a primeira letra em maiúscula
  const descTratada =
    descricao.charAt(0).toUpperCase() + descricao.slice(1).toLowerCase();

  // cria um objeto
  const novoGasto = {
    descricao: descTratada,
    valor: valorNum,
    categoria: categoria,
  };

  // salva o objeto na memória volátil para entrar no localstorage na função renderizarlista()
  gastos.push(novoGasto);

  // reseta o formulário e foca no primeiro campo
  form.reset();
  inputDescricao.focus();

  // renderiza a lista com a categoria selecionada para filtro
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
