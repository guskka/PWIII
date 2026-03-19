const numA = document.getElementById("numA");
const numB = document.getElementById("numB");
const numC = document.getElementById("numC");
const resDelta = document.getElementById("resDelta");
const resX1 = document.getElementById("resX1");
const resX2 = document.getElementById("resX2");

resDelta.value = 0;
resX1.value = 0;
resX2.value = 0;

document.getElementById("operacoesBhaskara").style.display = "none";

numA.addEventListener("input", () => {
    if (numA.value === "") {
        document.getElementById("operacoesBhaskara").style.display = "none";
    }
});

numB.addEventListener("input", () => {
    if (numB.value === "") {
        document.getElementById("operacoesBhaskara").style.display = "none";
    }
});

numC.addEventListener("input", () => {
    if (numC.value === "") {
        document.getElementById("operacoesBhaskara").style.display = "none";
    }
});

function calcBhaskara() {
    if (numA.value != "" || numB.value != "" || numC.value != "") {
        document.getElementById("operacoesBhaskara").style.display = "flex";
    }

    const valorA = parseFloat(numA.value);
    const valorB = parseFloat(numB.value);
    const valorC = parseFloat(numC.value);

    resDelta.value = (valorB ** 2) - 4 * valorA * valorC;

    if (resDelta.value < 0) {
        resX1.value = "Não existe raiz real";
        resX2.value = "Não existe raiz real";
    }
    else {
        resX1.value = (-valorB + Math.sqrt(resDelta.value)) / (2 * valorA);
        resX2.value = (-valorB - Math.sqrt(resDelta.value)) / (2 * valorA);
    }
};
