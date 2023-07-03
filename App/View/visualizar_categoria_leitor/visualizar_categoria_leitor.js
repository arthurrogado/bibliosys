import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()
httpClient.focusAllInputFields()

// preencher os campos do formulário baseado no id
httpClient.makeRequest({action: 'getCategoriaLeitor', id: httpClient.getParams().id})
.then(response => {
    let categoria_leitor = response.categoria_leitor
    // iterar o objeto e preencher os campos
    for(let key in categoria_leitor) {
        let input = document.getElementsByName(key)[0]
        if(input) {
            input.value = categoria_leitor[key]
        }
    }
})

httpClient.createEditButton('editarCategoriaLeitor', 'visualizar_categoria_leitor', {id: httpClient.getParams().id}, '.botoesEdicao')
httpClient.createDeleteButton('deletarCategoriaLeitor', 'categorias_leitor', {}, '.botoesEdicao')