import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()
httpClient.createStyleViews()

// CALLBACK delete Leitor
function deleteLeitor() {
    let id = httpClient.getParams.id
    httpClient.makeRequest({action: 'deletarLeitor', id: id})
    .then(response => {
        if(response.ok) {
            httpClient.messageBox('Leitor deletado com sucesso!', 'success', 3000)
            httpClient.navigateTo('leitores')
        }
    })
}

// preencher os campos do formulário baseado no id
httpClient.makeRequest({action: 'getLeitor', id: httpClient.getParams().id})
.then(response => {
    let leitor = response.leitor
    // iterar o objeto e preencher os campos
    for(let key in leitor) {
        let input = document.getElementsByName(key)[0]
        if(input) {
            input.value = leitor[key]
        }
    }
})

/* document.querySelector('#editButton').addEventListener('click', (e) => {
    document.querySelector('#editButton').classList.remove('circleButton')

    let inputs = document.querySelectorAll('.form input')
    inputs.forEach(input => {
        input.removeAttribute('disabled')
    })

    // remover o evento para editar
    document.querySelector('#editButton').removeEventListener('click', (e) => {
        document.querySelector('#editButton').classList.remove('circleButton')
        e.target.innerHTML += ' Editar'
    })
    // remover o evento de adicionar

    // FUNÇÃO PARA EDITAR
    document.querySelector('#editButton').addEventListener('click', (e) => {
        let data = {action: 'editarLeitor'}
        data = httpClient.mergeObjectToFormData(data, new FormData(document.querySelector('.form')))
        
        httpClient.makeRequest(data)
        .then(response => {
            console.log(response)
            if(response.ok) {
                httpClient.messageBox('Leitor editado com sucesso!', 'success', 3000)
                httpClient.navigateTo('visualizar_leitor', {id: httpClient.getParams().id})
            } else {
                httpClient.messageBox('Erro ao editar leitor: ' + response?.message, 'error', 3000)
            }
        })
    })

}) */

httpClient.createEditButton('editarLeitor', 'visualizar_leitor', {id: httpClient.getParams().id}, '.botoesEdicao')
httpClient.createDeleteButton('deletarLeitor', 'leitores', {}, '.botoesEdicao')