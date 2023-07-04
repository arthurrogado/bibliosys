import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

document.querySelector('.form').addEventListener('submit', e => {
    e.preventDefault()
    let form = e.target
    let fd = new FormData(form)

    let data = {
        action: 'criar_obra',
        nome: fd.get('nome'),
        descricao: fd.get('descricao'),
    }
    
    httpClient.makeRequest(data)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.messageBox('Obra criada com sucesso!', 'success', 10000)
            httpClient.navigateTo('obras')
        }
    })
})

document.querySelector('#criarObra').addEventListener('click', () => {
    // Require obrigatory fields
    if(!httpClient.verifyObrigatoryFields()) {
        httpClient.messageBox('Preencha todos os campos obrigatórios!', 'error', 3000)
        return
    }

    let fd = new FormData(document.querySelector('.form'))
    let data = {action: 'criarObra'}
    httpClient.mergeObjectToFormData(data, fd)

    if(data.categoria_literaria == '') {
        data.categoria_literaria = null
    }

    httpClient.makeRequest(data)
    .then(response => {
        if(response.ok) {
            httpClient.messageBox('Obra cadastrada com sucesso!', 'success', 3000)
            httpClient.navigateTo('obras')
        } else {
            httpClient.messageBox('Erro ao cadastrar obra: ' + response?.message, 'error', 3000)
        }
    })
})