import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()
httpClient.focusAllInputFields()

// preencher os campos do formulário baseado no id
httpClient.makeRequest({action: 'getCategoriaLiteraria', id: httpClient.getParams().id})
.then(response => {
    let categoria_literaria = response.categoria_literaria
    // iterar o objeto e preencher os campos
    for(let key in categoria_literaria) {
        let input = document.getElementsByName(key)[0]
        if(input) {
            input.value = categoria_literaria[key]
        }
    }
})

httpClient.createEditButton('editarCategoriaLiteraria', 'visualizar_categoria_literaria', {id: httpClient.getParams().id}, '.botoesEdicao')
httpClient.createDeleteButton('deletarCategoriaLiteraria', 'categorias_literarias', {}, '.botoesEdicao')