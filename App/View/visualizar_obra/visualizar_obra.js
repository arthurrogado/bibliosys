import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()
httpClient.focusAllInputFields()


// preencher os campos do formulário baseado no id
httpClient.makeRequest({action: 'getObra', id: httpClient.getParams().id})
.then(response => {
    let obra = response.obra
    // iterar o objeto e preencher os campos
    for(let key in obra) {
        let input = document.getElementsByName(key)[0]
        if(input) {
            input.value = obra[key]
        }
    }
})

httpClient.createEditButton('updateObra', 'visualizar_obra', {id: httpClient.getParams().id}, '.botoesEdicao')
httpClient.createDeleteButton('deleteObra', 'obras', {}, '.botoesEdicao')