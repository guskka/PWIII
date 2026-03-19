const numImparPar = document.getElementById("numImparPar");
const resImparPar = document.getElementById("resImparPar");

resImparPar.value = "";

document.getElementById("operacoesImparPar").style.display = "none";

numImparPar.addEventListener("input", () => {
    if (numImparPar.value === "") {
        document.getElementById("operacoesImparPar").style.display = "none";
    }
    else {
        document.getElementById("operacoesImparPar").style.display = "flex";
    }

    const valor = parseInt(numImparPar.value);

    if (valor % 2 === 0) {
        resImparPar.value = "Par";
    }
    else if (valor % 2 !== 0) {
        resImparPar.value = "Ímpar";
    }
    else if (isNaN(valor)) {
        resImparPar.value = "";
    }
    else {
        resImparPar.value = "";
    }
});
