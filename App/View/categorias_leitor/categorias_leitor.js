import HttpClient from "../../../public/js/HttpClient.js";

// categorias_leitor.js

const httpClient = new HttpClient()
httpClient.createStyleViews()

// CALLBACK Navigate To Categoria
function navigateToCategoria(item) {
    httpClient.navigateTo('visualizar_categoria_leitor', {id: item.id})
}

// LISTAR CATEGORIAS
httpClient.makeRequest({action: 'listarCategoriasLeitor'})
.then(response => {
    if(response.ok) {
        let categorias = response.categorias
        httpClient.createListData(categorias, navigateToCategoria, '#listagemCategoriasLeitor', ['id', 'nome'])
    } else {
        httpClient.messageBox('Erro ao listar categorias: ' + response?.message, 'error', 3000)
    }
})

// CRIAR CATEGORIA Button
document.querySelector('#criarCategoriaLeitor').addEventListener('click', () => {
    httpClient.navigateTo('criar_categoria_leitor')
})