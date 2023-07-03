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
        this.apiUrl = 'http://localhost/bibliosys/api.php'
        //this.apiUrl = 'http://192.168.1.100/bibliosys/api.php'

        // aplica o focused nos campos preenchidos, não precisando do :valid no css
        document.querySelectorAll('.input-field input').forEach(input => {
            input.addEventListener('change', e => {
                if(e.target.value != '') {
                    e.target.parentNode.classList.add('focused')
                } else {
                    e.target.parentNode.classList.remove('focused')
                }
            })
        })
    
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
            if(data.message) {console.log(data)}
            return data
        })
    }

    // Função para agregar chave valor ao formdata
    mergeObjectToFormData(object, formdata) {
        formdata.forEach((value, key) => {
            object[key] = value
        })
        return object
    }



    // ESTRUTURAS PRONTAS HTML

    messageBox(message, type, time) {

        // verificar se está no toplevel ou não a execução do script
        if (window.top === window.self) {
            
            /* // se tiver .html no nome, usar alert()
            if(window.location.href.includes('.html')) {
                alert(message)
            } */

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
                document.querySelector('.message-box')?.remove()
            }, time) // From time provided by the user

        }
        else {
            // está dentro de um iframe
            let messagePost = {
                action: 'messageBox',
                message: message,
                type: type,
                time: time
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

    createEditButton(editAction, onOkNavigateTo, params = {}, parent = 'body') {
        let editButton = document.createElement('button')
        editButton.innerHTML += '<i class="fas fa-edit"></i>'
        editButton.innerHTML += '<span>Editar</span>'
        
        editButton.classList.add('circleButton')
        editButton.classList.add('btn')
        editButton.classList.add('btn-primary')

        editButton.addEventListener('click', e => {
            editButton.classList.remove('circleButton')

            // reativar os inputs
            let inputs = document.querySelectorAll('.form input')
            inputs.forEach(input => {
                input.removeAttribute('disabled')
            })

            // remover o evento para editar
            editButton.removeEventListener('click', (e) => {
                editButton.classList.remove('circleButton')
                e.target.innerHTML += ' Editar'
            })

            // FUNÇÃO PARA EDITAR
            editButton.addEventListener('click', (e) => {
                let data = {action: editAction}
                data = this.mergeObjectToFormData(data, new FormData(document.querySelector('.form')))
                
                this.makeRequest(data)
                .then(response => {
                    console.log(response)
                    if(response.ok) {
                        this.messageBox('Editado com sucesso!', 'success', 3000)
                        this.navigateTo(onOkNavigateTo, params)
                    } else {
                        this.messageBox('Erro ao editar: ' + response?.message, 'error', 3000)
                    }
                })

            })
        })


        document.querySelector(parent).appendChild(editButton)

    }

    createDeleteButton(deleteAction, onOkNavigateTo, params, parent = 'body') {
        let deleteButton = document.createElement('button')
        deleteButton.innerHTML += '<i class="fas fa-trash"></i>'
        deleteButton.innerHTML += '<span>Certeza que deseja excluir?</span>'
        
        deleteButton.classList.add('circleButton')
        deleteButton.classList.add('btn')
        deleteButton.classList.add('btn-danger')

        deleteButton.addEventListener('click', e => {
            deleteButton.classList.remove('circleButton')

            // remover o evento para deletar
            deleteButton.removeEventListener('click', (e) => {
                deleteButton.classList.remove('circleButton')
                e.target.innerHTML += ' Excluir'
            })

            // FUNÇÃO PARA DELETAR
            deleteButton.addEventListener('click', (e) => {
                let data = {action: deleteAction, id: this.getParams().id}
                
                this.makeRequest(data)
                .then(response => {
                    console.log(response)
                    if(response.ok) {
                        this.messageBox('Excluído com sucesso!', 'success', 3000)
                        this.navigateTo(onOkNavigateTo, params)
                    } else {
                        this.messageBox('Erro ao excluir: ' + response?.message, 'error', 3000)
                    }
                })

            })
        })

        document.querySelector(parent).appendChild(deleteButton)
    }

    // FUNÇÕES PRONTAS PARA USO
    
    // Verificar os input-fields com * e retornar false se algum estiver vazio
    verifyObrigatoryFields() {
        let result = true
        document.querySelectorAll('.input-field label')
        .forEach(label => {
            if(label.innerHTML.includes('*')) {
                let ehVazio = label.parentElement.querySelector('input').value == ''
                if(ehVazio) {
                    label.parentNode.classList.add('error')
                    result = false
                }
            }
        })
        console.log('passou')
        return result
    }

    focusAllInputFields() {
        document.querySelectorAll('.input-field').forEach(inputField => {
            inputField.classList.add('focused')
        })
    }

}

export default HttpClient