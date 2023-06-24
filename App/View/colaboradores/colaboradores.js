import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// CALLBACK NavigateTo Colaborador
function navigateToColaborador(item) {
    httpClient.navigateTo('visualizar_perfil_colaborador', {id: item.id})
}


// LISTAR COLABORADORES
httpClient.makeRequest({action: 'listar_colaboradores'})
.then(response => {
    if(response.ok) {
        let colaboradores = response.colaboradores
        httpClient.createListData(colaboradores, navigateToColaborador, '#listagemColaboradores', ['id', 'nome'])
    }
})

// ADICIONAR COLABORADOR
document.querySelector('.add').addEventListener('click', e => {
    httpClient.navigateTo('criar_colaborador')
})