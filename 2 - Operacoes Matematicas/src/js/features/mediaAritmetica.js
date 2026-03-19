const numX1 = document.getElementById("numX1");
const numX2 = document.getElementById("numX2");
const numX3 = document.getElementById("numX3");
const numX4 = document.getElementById("numX4");
const resMediaAritmetica = document.getElementById("resMediaAritmetica");

resMediaAritmetica.value = 0;

document.getElementById("operacoesMediaAritmetica").style.display = "none";

numX1.addEventListener("input", () => {
    if (numX1.value === "") {
        document.getElementById("operacoesMediaAritmetica").style.display = "none";
    }
});

numX2.addEventListener("input", () => {
    if (numX2.value === "") {
        document.getElementById("operacoesMediaAritmetica").style.display = "none";
    }
});

numX3.addEventListener("input", () => {
    if (numX3.value === "") {
        document.getElementById("operacoesMediaAritmetica").style.display = "none";
    }
});

numX4.addEventListener("input", () => {
    if (numX4.value === "") {
        document.getElementById("operacoesMediaAritmetica").style.display = "none";
    }
});

function calcMediaAritmetica() {
    if (numX1.value != "" || numX2.value != "" || numX3.value != "" || numX4.value != "") {
        document.getElementById("operacoesMediaAritmetica").style.display = "flex";
    }

    const valorX1 = parseFloat(numX1.value);
    const valorX2 = parseFloat(numX2.value);
    const valorX3 = parseFloat(numX3.value);
    const valorX4 = parseFloat(numX4.value);

    resMediaAritmetica.value = (valorX1 + valorX2 + valorX3 + valorX4) / 4;
}
