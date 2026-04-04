const aVista = document.getElementById("aVista");
const aPrazo = document.getElementById("aPrazo");
const divParcelas = document.getElementById("divParcelas");
const parcelas = document.getElementById("parcelas");

divParcelas.classList.remove(
  "hover:bg-orange-h/15",
  "hover:border-orange-h",
  "cursor-pointer",
  "border-orange-h",
);
divParcelas.classList.add("opacity-50", "border-bg-3");
parcelas.classList.add("cursor-not-allowed");

aVista.addEventListener("change", () => {
  parcelas.disabled = true;
  parcelas.selectedIndex = 0;
  divParcelas.classList.remove(
    "hover:bg-orange-h/15",
    "hover:border-orange-h",
    "cursor-pointer",
    "border-orange-h",
  );
  divParcelas.classList.add("opacity-50", "border-bg-3");
});

aPrazo.addEventListener("change", () => {
  parcelas.disabled = false;
  parcelas.selectedIndex = 1;
  divParcelas.classList.remove("opacity-50", "border-bg-3");
  divParcelas.classList.add(
    "hover:bg-orange-h/15",
    "hover:border-orange-h",
    "cursor-pointer",
    "border-bg-3",
  );
});
