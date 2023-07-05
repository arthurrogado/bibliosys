import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()
httpClient.focusAllInputFields()

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

// CRIAR empréstimo
document.querySelector('#criarEmprestimo').addEventListener('click', () => {

    if(httpClient.verifyObrigatoryFields() == false) {
        httpClient.messageBox('Preencha todos os campos obrigatórios', 'error', 3000)
        return false
    }

    let formdata = new FormData(document.querySelector('.form'))
    let data = {action: 'createEmprestimo'}
    formdata.forEach((value, key) => {
        data[key] = value
    })

    httpClient.makeRequest(data)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.messageBox('Empréstimo criado com sucesso', 'success', 3000)
            httpClient.navigateTo('emprestimos')
        } else {
            httpClient.messageBox('Erro ao criar empréstimo: ' + response?.message, 'error', 3000)
        }
    })



})