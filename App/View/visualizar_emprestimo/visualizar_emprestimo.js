import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// Preencher os campos do formulário baseado no id
httpClient.makeRequest({action: 'getEmprestimo', id: httpClient.getParams().id})
.then(response => {
    let emprestimo = response.emprestimo
    // iterar o objeto e preencher os campos
    for(let key in emprestimo) {
        let input = document.getElementsByName(key)[0]
        if(input) {
            input.value = emprestimo[key]
        }
    }
})

// Criar botão de edição
httpClient.createEditButton('updateEmprestimo', 'visualizar_emprestimo', {id: httpClient.getParams().id}, '.botoesEdicao')

// Criar botão de exclusão
httpClient.createDeleteButton('deleteEmprestimo', 'emprestimos', {}, '.botoesEdicao')


// Get todos os leitores para preencher o select
httpClient.makeRequest({action: 'getLeitores'})
.then(response => {
    httpClient.fillSelect('id_leitor', response.leitores, ['nome', 'id'])
})

// Get todos os livros para preencher o select
httpClient.makeRequest({action: 'getObras'})
.then(response => {
    httpClient.fillSelect('id_obra', response.obras, ['titulo', 'id'])
})

// Seleciona o leitor certo quando a página do empréstimo é carregada
httpClient.makeRequest({action: 'getEmprestimo', id: httpClient.getParams().id})
.then(response => {
    let emprestimo = response.emprestimo
    httpClient.setSelectedOption('id_leitor', emprestimo.id_leitor)
    httpClient.setSelectedOption('id_obra', emprestimo.id_obra)
})