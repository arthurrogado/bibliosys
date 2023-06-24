import { navigateTo, makeUrlParams } from "./functions.js";
import HttpClient from "./HttpClient.js";


const projetcName = 'pontocivil'
const httpClient = new HttpClient()

const menuItems = document.querySelector('#menuItems')
const menus = menuItems?.children
for (let menu of menus) {
    
    // verify if the item is an <li> tag
    if(menu.tagName != 'LI'){ continue }

    menu.addEventListener('click', (e) => {
        navigateTo(menu.id)
        document.querySelector('#sidebar').classList.remove('active');
    })
}


document.querySelector('#sidebarButton').addEventListener('click', e => {
    document.querySelector('#sidebar').classList.toggle('active');
    document.querySelector('#sidebarButton').classList.toggle('active');
})





// check the url typed by the user and load the page
if(location.pathname.startsWith('/pontocivil')){
    let routeAndParams = location.hash
    let [route, params] = routeAndParams.split('?')

    console.log('====== STRING PARAMS')
    console.log(params)

    
    route == '' ? route = '#home' : null // if the route is '/', change to 'home'
    route.startsWith('#') ? route = route.slice(1) : null // remove the first '#'
    
    //params?.startsWith('?') ? params = params.slice(1) : null // remove the first '?'
    
    //params = params ? makeUrlParams( params.split('&') ) : null // convert the string params to an object
    
    params = '?' + params

    console.log('=-=-=-=-= params')
    console.log(params)
    
    navigateTo(route, params)

}


// MESSAGES FROM CHILDREN

// listen to messages from the parent
window.addEventListener('message', e => {
    if(e.origin != location.origin){return} // verify if the message is from the same origin

    switch (e.data.action) {
        case 'navigateTo':
            let [route, params] = [e.data.route, e.data.params]
            navigateTo(route, params)
            break;

        case 'messageBox':
            let messageText = e.data.message
            httpClient.messageBox(messageText)
            break;
    
        default:
            break;
    }

})
