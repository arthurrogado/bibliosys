import { navigateTo, createStyleViews } from "./functions.js"

// app.js

// Código para adicionar o script do Font Awesome dinamicamente
const fontAwesomeScript = document.getElementById('fontawesome-script');

if (!fontAwesomeScript) {
  const script = document.createElement('script');
  script.src = 'https://kit.fontawesome.com/c8519f6a68.js';
  script.crossOrigin = 'anonymous';
  script.id = 'fontawesome-script';
  document.head.appendChild(script);
}


class HttpClient {

    params = {}

    constructor() {
        this.navigateTo = navigateTo
        this.createStyleViews = createStyleViews
        //this.apiUrl = 'http://localhost/pontocivil/api.php'
        this.apiUrl = 'http://192.168.1.100/pontocivil/api.php'
    }

    getParams() {
        location.href
            .split('?')[1] // get the part after the '?' in url
            .split('&') // split the params divided by '&'
            .map(param => {
                let [key, value] = param.split('=')
                this.params[key] = value
            })
        return this.params
    }

    verifyLogin() {return {ok: true} }


    makeRequest(data) {
        // data example: {action: 'login', username: 'username', password: 'password'}
        let formdata = new FormData()
        formdata.append('data', JSON.stringify(data))

        return fetch(this.apiUrl, {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())
        .then(data => {
            return data
        })
    }

    // ESTRUTURAS PRONTAS HTML

    messageBox(message, type, time) {

        // verificar se está no toplevel ou não a execução do script
        if (window.top === window.self) {
            
            // se tiver .html no nome, usar alert()
            if(window.location.href.includes('.html')) {
                alert(message)
            }

            // está no toplevel
            let messageBox = document.createElement('div')
            messageBox.classList.add('message-box')
            messageBox.classList.add(type)
            messageBox.innerHTML = `
                <div class="messageBox">
                    <p>${message}</p>
                    <button class="close">X</button>
                </div>
            `
            document.body.appendChild(messageBox)
            document.querySelector('.message-box .close').addEventListener('click', e => {
                document.querySelector('.message-box').remove()
            })
            // timer para fechar a mensagem
            setTimeout(() => {
                document.querySelector('.message-box').remove()
            }, time) // From time provided by the user

        }
        else {
            // está dentro de um iframe
            let messagePost = {
                action: 'messageBox',
                message: message
            }
            window.parent.postMessage(messagePost, '*')
        }
        
    }

    createListData(data, callback = null, parent = 'body', whatToShow = ['id', 'name'], search = false) {

        let listData = document.createElement('ul')
        listData.classList.add('listData')
        
        // Se tiver search, colocar uma input acima das LIs
        if(search){
            let searchInput = document.createElement('input')
            searchInput.classList.add('search-input')
            searchInput.setAttribute('placeholder', 'Pesquisar')
            searchInput.addEventListener('keyup', e => {
                let value = e.target.value
                let listItems = listData.querySelectorAll('li')
                listItems.forEach(item => {
                    if(item.innerHTML.toLowerCase().includes(value.toLowerCase())) {
                        item.style.display = 'block'
                    }
                    else {
                        item.style.display = 'none'
                    }
                })
            })
            listData.appendChild(searchInput)
        }

        // Criar as LIs
        data.forEach(item => {
            let listItem = document.createElement('li')
            item.id ? listItem.setAttribute('dataId', item.id) : null // set the dataId attribute if the item has an id
            
            whatToShow.forEach(what => {
                listItem.innerHTML += item[what] + ' - '
            })
            listItem.innerHTML = listItem.innerHTML.slice(0, -3) // remove the last ' - '

            listData.appendChild(listItem)
            listItem.addEventListener('click', e => {
                callback(item)
            })
        })
        document.querySelector(parent).appendChild(listData)
    }

    createTitle(title, parent = 'body') {
        let titleElement = document.createElement('h1')
        titleElement.innerHTML = title
        titleElement.style = {
            'text-align': 'center'
        }
        document.querySelector(parent).appendChild(titleElement)
    }

}

export default HttpClient