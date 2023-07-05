import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// CALLBACK Navigate To Leitor
function navigateToLeitor(item) {
    httpClient.navigateTo('visualizar_leitor', {id: item.id})
}

// LISTAR LEITORES
httpClient.makeRequest({action: 'getLeitores'})
.then(response => {
    if(response.ok) {
        let leitores = response.leitores
        httpClient.createListData(leitores, navigateToLeitor, '#listagemLeitores', ['id', 'nome'])
    }
})

// ADICIONAR LEITOR
document.querySelector('#adicionarLeitor').addEventListener('click', () => {
    httpClient.navigateTo('criar_leitor')
})