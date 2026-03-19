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

function calcBhaskara() {
    if (numA.value != "" || numB.value != "" || numC.value != "") {
        document.getElementById("operacoesBhaskara").style.display = "flex";
    }
    else {
        resDelta.value = 0;
        resX1.value = 0;
        resX2.value = 0;
        document.getElementById("operacoesBhaskara").style.display = "none";
    }

    const valorA = numA.value;
    const valorB = numB.value;
    const valorC = numC.value;

    resDelta.value = (valorB ** 2) - 4 * valorA * valorC;
};
