function makeUrlParams(params) {
    // this function receives an object and returns a string with the url params

    // if params is already a string, return it
    if(typeof params == 'string') { return params }

    let urlParams = params ? '?' : '' // if params is not null, add '?' to the url
    for (let param in params) {
        urlParams += `${param}=${params[param]}&`
    }
    return urlParams.slice(0, -1) // remove the last '&' from the string
}

function makeObjectParams(params) {
    // this function receives a string params and returns an object
    let objectParams = {}
    params.split('&').forEach(param => {
        let [key, value] = param.split('=')
        objectParams[key] = value
    })
    return objectParams
}

function updateRoute(route, params = null) {
    params = makeUrlParams(params)
    let origin = window.location.origin
    let originalPathname = window.location.pathname
    let pathname = originalPathname.endsWith('/') ? originalPathname.slice(0, -1) : originalPathname // if the pathname ends with '/', remove it

    window.history.pushState({}, route, origin + pathname + '#' + route + params)
}


// alterar navigateTo() para verificar se está no toplevel, se estiver, alterar o src do iframe e dar update na url do index.html, 
// se não, mandar um postMessage para o parent executar o navigateTo(), alterando o src do iframe e dando update na url do index.html
// se não tiver o parent, executar alterar o href da página



function navigateTo(route, params = null) {

    // Verify if it is in the toplevel
    if (window.self === window.top) {

        let pageToLoad

        let origin = window.location.origin
        let pathname = window.location.pathname
        params = params ? makeUrlParams(params) : ''


        // if toplevel, verify if it is a INDEPENDENT page or index with # pattern
        if(window.location.href.includes('.html')) {
            pageToLoad = origin + '/pontocivil' + '/App/View/' + route + "/" + route + '.html' + params
            window.location.href = pageToLoad
        }

        // if it is the INDEX.html, change the iframe src and update the url
        else {
            pageToLoad = origin + pathname + '/App/View/' + route + "/" + route + '.html' + params // route + route because of the folder structure

            let contentIframe = document.querySelector('#contentData') // iframe
            contentIframe.src = pageToLoad  
            updateRoute(route, params)
        }
    
    }

    // If it is not in the toplevel, send a message to the parent to execute the navigateTo()
    else {
        let message = {
            action: 'navigateTo',
            route: route,
            params: params
        }
        window.parent.postMessage(message, '*')
    }

}


function createStyleViews() {
    let link = document.createElement('link')
    link.rel = 'stylesheet'
    link.href = '../../../public/css/style.css'
    document.head.append(link)
}

export { navigateTo, makeUrlParams, makeObjectParams, createStyleViews }