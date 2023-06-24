import { navigateTo, makeUrlParams } from "./functions.js"
import HttpClient from "./HttpClient.js"

const projetcName = 'bibliosys'
const httpClient = new HttpClient()

function changeActive(targetId) {
    let target = document.querySelector(`#${targetId}`)
    // Verify if the menu is not active yet. It it is, ignore
    if(target?.classList.contains('active')){return}

    // If already exists any .active item, if not, make the new one.
    try {
        let activeItem = document.querySelector('.active')
        activeItem.classList.remove('active')
    } catch (error) {
    }
    target?.classList.add('active')
}

const menuItems = document.querySelector('#menuItems')
const menus = menuItems?.children
for (let menu of menus) {
    menu.addEventListener('click', (e) => {
        let target = e.target

        // verify if the item is an <li> tag
        if(target.tagName != 'LI'){ return }

        // if the user is logged in, navigate to the page, else, redirect to login page
        let loginSatus = httpClient.verifyLogin()
        if(loginSatus.ok){
            // THE ID OF THE ITEM IS THE SAME OF THE PAGE TO LOAD ACCORDING TO THE ROUTES
            changeActive(target.id)
            navigateTo(target.id)
        } else {
            alert('Você precisa estar logado para acessar esta página.')
            navigateTo('login')
        }
    })
}

// check the url typed by the user and load the page
if(location.pathname.startsWith('/'+projetcName)){
    let routeAndParams = location.hash
    let [route, params] = routeAndParams.split('?')
    
    route == '' ? route = '#home' : null // if the route is '/', change to 'home'
    route.startsWith('#') ? route = route.slice(1) : null // remove the first '#'

    params?.startsWith('?') ? params = params.slice(1) : null // remove the first '?'

    params = params ? makeUrlParams( params.split('&') ) : null
    
    navigateTo(route, params)

}
