// emprestimos.js

import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// CALLBACK Navigate To empréstimo
function navigateToEmprestimo(item) {
    httpClient.navigateTo('visualizar_emprestimo', {id: item.id})
}

// LISTAR empréstimos
httpClient.makeRequest({action: 'getEmprestimos'})
.then(response => {
    if(response.ok) {
        let emprestimos = response.emprestimos
        httpClient.createListData(emprestimos, navigateToEmprestimo, '#listagemEmprestimos', ['id_leitor', 'id_obra', 'data_emprestimo'])
    } else {
        httpClient.messageBox('Erro ao listar empréstimos: ' + response?.message, 'error', 3000)
    }
})

// CRIAR empréstimo Button
document.querySelector('#criarEmprestimo').addEventListener('click', () => {
    httpClient.navigateTo('criar_emprestimo')
})