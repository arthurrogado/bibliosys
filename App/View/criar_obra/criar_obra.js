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