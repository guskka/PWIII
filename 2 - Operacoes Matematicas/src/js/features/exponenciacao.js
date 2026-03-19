const numExponenciacao = document.getElementById("numExponenciacao");
const resQuadrado = document.getElementById("resQuadrado");
const resCubo = document.getElementById("resCubo");
const resQuarta = document.getElementById("resQuarta");
const resQuinta = document.getElementById("resQuinta");
const resSexta = document.getElementById("resSexta");

resQuadrado.value = 0;
resCubo.value = 0;
resQuarta.value = 0;
resQuinta.value = 0;
resSexta.value = 0;

document.getElementById("operacoesExponenciacoes").style.display = "none";

numExponenciacao.addEventListener("input", () => {
    if (numExponenciacao.value != "") {
        document.getElementById("operacoesExponenciacoes").style.display = "flex";
    }

    const valor = numExponenciacao.value;

    resQuadrado.value = valor ** 2;
    resCubo.value = valor ** 3;
    resQuarta.value = valor ** 4;
    resQuinta.value = valor ** 5;
    resSexta.value = valor ** 6;
});
