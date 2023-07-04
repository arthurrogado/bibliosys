import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// CRIAR CATEGORIA
document.querySelector('#criarCategoriaLiteraria').addEventListener('click', () => {
    // EXIGIR CAMPOS OBRIGATÓRIOS
    if(!httpClient.verifyObrigatoryFields()) {
        httpClient.messageBox('Preencha todos os campos obrigatórios!', 'error', 3000)
        return
    }
    
    let form = document.querySelector('.form')
    let fd = new FormData(form)

    let data = {action: 'createCategoriaLiteraria'}
    data = httpClient.mergeObjectToFormData(data, fd)

    httpClient.makeRequest(data)
    .then(response => {
        if(response.ok) {
            httpClient.messageBox('Categoria cadastrada com sucesso!', 'success', 3000)
            httpClient.navigateTo('categorias_literarias')
        } else {
            httpClient.messageBox('Erro ao cadastrar categoria: ' + response?.message, 'error', 3000)
        }
    })

})