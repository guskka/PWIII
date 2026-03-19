const numMultiplicacao = document.getElementById("numMultiplicacao");
const resDobro = document.getElementById("resDobro")
const resTriplo = document.getElementById("resTriplo")
const resQuadruplo = document.getElementById("resQuadruplo")
const resQuintuplo = document.getElementById("resQuintuplo")
const resSextuplo = document.getElementById("resSextuplo")

resDobro.value = 0;
resTriplo.value = 0;
resQuadruplo.value = 0;
resQuintuplo.value = 0;
resSextuplo.value = 0;

document.getElementById("operacoesMultiplicacao").style.display = "none";

numMultiplicacao.addEventListener("input", () => {
    if (numMultiplicacao.value != "") {
        document.getElementById("operacoesMultiplicacao").style.display = "flex";
    }

    const valor = numMultiplicacao.value;

    resDobro.value = valor * 2;
    resTriplo.value = valor * 3;
    resQuadruplo.value = valor * 4;
    resQuintuplo.value = valor * 5;
    resSextuplo.value = valor * 6;
});
