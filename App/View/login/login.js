import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()

const loginForm = document.querySelector('.form')

loginForm.addEventListener('submit', (e) => {
    e.preventDefault()
    let formdata = new FormData(loginForm)

    let data = {
        action: 'login',
        username: formdata.get('username'),
        password: formdata.get('password')
    }

    httpClient.makeRequest(data)
    .then(response => {
        if(response.ok){
            alert('Login realizado com sucesso!')
            httpClient.navigateTo('home')
        } else {
            alert(response.status)
        }
    })


})