function dropdownMultiplicacoes() {
    if (document.getElementById("operacoesMultiplicacao").style.display === "flex") {
        document.getElementById("operacoesMultiplicacao").style.display = "none";
        document.getElementById("dropdownMultiplicacao").innerHTML = "<i class='bx bx-chevron-down'></i>";
    }
    else {
        document.getElementById("operacoesMultiplicacao").style.display = "flex";
        document.getElementById("dropdownMultiplicacao").innerHTML = "<i class='bx bx-chevron-up'></i>";
    }
}

function dropdownExponenciacoes() {
    if (document.getElementById("operacoesExponenciacoes").style.display === "flex") {
        document.getElementById("operacoesExponenciacoes").style.display = "none";
        document.getElementById("dropdownExpoente").innerHTML = "<i class='bx bx-chevron-down'></i>";
    }
    else {
        document.getElementById("operacoesExponenciacoes").style.display = "flex";
        document.getElementById("dropdownExpoente").innerHTML = "<i class='bx bx-chevron-up'></i>";
    }
}

function dropdownBhaskara() {
    if (document.getElementById("operacoesBhaskara").style.display === "flex") {
        document.getElementById("operacoesBhaskara").style.display = "none";
        document.getElementById("dropdownBhaskara").innerHTML = "<i class='bx bx-chevron-down'></i>";
    }
    else {
        document.getElementById("operacoesBhaskara").style.display = "flex";
        document.getElementById("dropdownBhaskara").innerHTML = "<i class='bx bx-chevron-up'></i>";
    }
}

function dropdownMediaAritmetica() {
    if (document.getElementById("operacoesMediaAritmetica").style.display === "flex") {
        document.getElementById("operacoesMediaAritmetica").style.display = "none";
        document.getElementById("dropdownMediaAritmetica").innerHTML = "<i class='bx bx-chevron-down'></i>";
    }
    else {
        document.getElementById("operacoesMediaAritmetica").style.display = "flex";
        document.getElementById("dropdownMediaAritmetica").innerHTML = "<i class='bx bx-chevron-up'></i>";
    }
}

function dropdownImparPar() {
    if (document.getElementById("operacoesImparPar").style.display === "flex") {
        document.getElementById("operacoesImparPar").style.display = "none";
        document.getElementById("dropdownImparPar").innerHTML = "<i class='bx bx-chevron-down'></i>";
    }
    else {
        document.getElementById("operacoesImparPar").style.display = "flex";
        document.getElementById("dropdownImparPar").innerHTML = "<i class='bx bx-chevron-up'></i>";
    }
}
