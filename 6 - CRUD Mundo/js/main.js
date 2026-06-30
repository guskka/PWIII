function confirmDelete(event) {
    if (!confirm("Tem certeza de que deseja excluir este registro? Todas as regras de integridade serão aplicadas.")) {
        event.preventDefault();
        return false;
    }
    return true;
}

function buscarTabela() {
    let input = document.getElementById("inputBusca").value.toUpperCase();
    let rows = document.querySelectorAll("table tbody tr");
    
    rows.forEach(row => {
        let match = false;
        for (let i = 0; i < row.cells.length - 1; i++) {
            if (row.cells[i].textContent.toUpperCase().includes(input)) {
                match = true;
                break;
            }
        }
        row.style.display = match ? "" : "none";
    });
}

function editContinente(d) {
    document.getElementById('action_continente').value = 'update';
    document.getElementById('id_continente').value = d.id;
    document.getElementById('nome').value = d.nome;
    document.getElementById('populacao').value = d.populacao;
    document.getElementById('area_km2').value = d.area_km2;
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function editGovernante(d) {
    document.getElementById('action_governante').value = 'update';
    document.getElementById('id_governante').value = d.id;
    document.getElementById('nome').value = d.nome;
    document.getElementById('partido_politico').value = d.partido_politico;
    document.getElementById('data_nascimento').value = d.data_nascimento;
    document.getElementById('idade').value = d.idade;
    document.getElementById('data_inicio_mandato').value = d.data_inicio_mandato;
    document.getElementById('data_fim_mandato').value = d.data_fim_mandato;
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function editPais(d) {
    document.getElementById('action_pais').value = 'update';
    document.getElementById('id_pais').value = d.id;
    document.getElementById('nome').value = d.nome;
    document.getElementById('continente_id').value = d.continente_id;
    document.getElementById('populacao').value = d.populacao;
    document.getElementById('area_km2').value = d.area_km2;
    document.getElementById('idioma').value = d.idioma;
    document.getElementById('governante_id').value = d.governante_id || '';
    document.getElementById('clima').value = d.clima;
    document.getElementById('regime_politico').value = d.regime_politico;
    document.getElementById('moeda').value = d.moeda;
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function editCidade(d) {
    document.getElementById('action_cidade').value = 'update';
    document.getElementById('id_cidade').value = d.id;
    document.getElementById('nome').value = d.nome;
    document.getElementById('pais_id').value = d.pais_id;
    document.getElementById('populacao').value = d.populacao;
    document.getElementById('area_km2').value = d.area_km2;
    document.getElementById('clima').value = d.clima;
    document.getElementById('governante_id').value = d.governante_id || '';
    document.getElementById('data_fundacao').value = d.data_fundacao;
    window.scrollTo({top: 0, behavior: 'smooth'});
}