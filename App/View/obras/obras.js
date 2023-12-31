import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

httpClient.createStyleViews()

// CALLBACK NavigateTo Obra
function navigateToObra(item) {
    httpClient.navigateTo('visualizar_obra', {id: item.id})
}

// LISTAR OBRAS
httpClient.makeRequest({action: 'getObras'})
.then(response => {
    console.log(response)
    if(response.ok) {
        let obras = response.obras
        httpClient.createListData(obras, navigateToObra, 'body', ['id', 'titulo'])
    }
})


// ADICIONAR OBRA
document.querySelector('.add').addEventListener('click', e => {
    httpClient.navigateTo('criar_obra')
})