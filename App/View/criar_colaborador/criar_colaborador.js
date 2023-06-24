import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// Cadastrar Colaborador
document.querySelector('.form').addEventListener('submit', e => {
    e.preventDefault()
    let form = e.target
    let fd = new FormData(form)

    let data = {action: 'criar_colaborador'}
    fd.forEach((value, key) => {
        data[key] = value
    })
    
    httpClient.makeRequest(data)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.messageBox('Colaborador criado com sucesso!')
            httpClient.navigateTo('colaboradores')
        }
    })
})