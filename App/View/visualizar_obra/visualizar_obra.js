import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

// menu open
document.querySelector('#addColaborador').addEventListener('click', e => {
    document.querySelector('.panel').classList.toggle('open')
})


// get nome da obra
httpClient.makeRequest({action: 'get_obra', id_obra: httpClient.getParams().id})
.then(response => {
    console.log(response)
    console.log(document.querySelector('#title'))
    if(response.ok) {
        //httpClient.createTitle(response.obra.nome, 'title')
        document.querySelector('h1').innerHTML = response.obra.nome
    }
})


// VINCULADOS
httpClient.makeRequest({action: 'get_colaboradores_vinculados', id_obra: httpClient.getParams().id})
.then(response => {
    console.log(response)
    if(response.ok) {
        let colaboradores = response.colaboradores
        httpClient.createListData(colaboradores, null, '#vinculados', ['id', 'nome'], true)
    }
})


// Callback para vincular colaborador
const cbVincularColaborador = (item) => {
    httpClient.makeRequest({action: 'vincular_colaborador_a_obra', id_obra: httpClient.getParams().id, id_colaborador: item.id})
    .then(response => {
        console.log(response)
        if(response.ok) {
            location.reload()
        }
    })
}


// Get colaboradores não linkados com a obra
httpClient.makeRequest({action: 'get_colaboradores_nao_linkados', id_obra: httpClient.getParams().id})
.then(response => {
    console.log(response)
    if(response.ok) {
        let colaboradores = response.colaboradores
        httpClient.createListData(colaboradores, cbVincularColaborador, '#nao_vinculados', ['id', 'nome'], true)
    }
})