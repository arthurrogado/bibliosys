import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()


document.querySelector('#registrarLeitor').addEventListener('click', () => {
    
    if(httpClient.verifyObrigatoryFields() !== true) {
        httpClient.messageBox('Preencha todos os campos obrigatórios', 'error', 3000)
        return false
    }

    let form = document.querySelector('.form')
    let fd = new FormData(form)

    let data = {action: 'cadastrarLeitor'}
    data = httpClient.mergeObjectToFormData(data, fd)


    httpClient.makeRequest(data)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.messageBox('Leitor cadastrado com sucesso!', 'success', 3000)
            httpClient.navigateTo('leitores')
        }
    })
})

