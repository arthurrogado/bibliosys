import HttpClient from "../../../public/js/HttpClient.js";

const httpClient = new HttpClient()


// função para atualizar o intervalo de datas dos botões
const atualizarIntervalo = (date) => {

    // pegar os dias a partir de domingo do dia selecionado
    let domingo = new Date(date.setDate(date.getDate() - date.getDay() - 1))

    console.log(domingo.getDate())
    
    // calcula os outros dias
    let segunda = new Date(domingo)
    segunda.setDate(domingo.getDate() + 1)

    let terca = new Date(domingo)
    terca.setDate(domingo.getDate() + 2)
    
    let quarta = new Date(domingo)
    quarta.setDate(domingo.getDate() + 3)
    
    let quinta = new Date(domingo)
    quinta.setDate(domingo.getDate() + 4)
    
    let sexta = new Date(domingo)
    sexta.setDate(domingo.getDate() + 5)
    
    let sabado = new Date(domingo)
    sabado.setDate(domingo.getDate() + 6)

    // Atualiza seleção de data
    document.querySelector('#dataInicial').value = domingo.toISOString().slice(0, 10)
    document.querySelector('#dataFinal').value = sabado.toISOString().slice(0, 10)

    // setando valores das datas para os botões
    document.querySelector('#segunda').setAttribute('value', segunda.toISOString().slice(0, 10))
    document.querySelector('#terca').setAttribute('value', terca.toISOString().slice(0, 10))
    document.querySelector('#quarta').setAttribute('value', quarta.toISOString().slice(0, 10))
    document.querySelector('#quinta').setAttribute('value', quinta.toISOString().slice(0, 10))
    document.querySelector('#sexta').setAttribute('value', sexta.toISOString().slice(0, 10))
}

const novoatualizarIntervalo = (date) => {
    // Pegar a data selecionada
    const selectedDate = new Date(date);
    
    // Pegar o dia da semana (0 - Domingo, 1 - Segunda, ..., 6 - Sábado)
    const dayOfWeek = selectedDate.getDay();
    
    // Calcular o dia inicial (domingo) da semana
    const domingo = new Date(selectedDate);
    domingo.setDate(selectedDate.getDate() - dayOfWeek);
    
    // Calcular os outros dias da semana
    const segunda = new Date(domingo);
    segunda.setDate(domingo.getDate() + 1);
    
    const terca = new Date(domingo);
    terca.setDate(domingo.getDate() + 2);
    
    const quarta = new Date(domingo);
    quarta.setDate(domingo.getDate() + 3);
    
    const quinta = new Date(domingo);
    quinta.setDate(domingo.getDate() + 4);
    
    const sexta = new Date(domingo);
    sexta.setDate(domingo.getDate() + 5);
    
    const sabado = new Date(domingo);
    sabado.setDate(domingo.getDate() + 6);
    
    // Atualizar os valores dos campos e botões
    document.querySelector('#dataInicial').value = domingo.toISOString().slice(0, 10);
    document.querySelector('#dataFinal').value = sabado.toISOString().slice(0, 10);
    
    document.querySelector('#segunda').setAttribute('value', segunda.toISOString().slice(0, 10));
    document.querySelector('#terca').setAttribute('value', terca.toISOString().slice(0, 10));
    document.querySelector('#quarta').setAttribute('value', quarta.toISOString().slice(0, 10));
    document.querySelector('#quinta').setAttribute('value', quinta.toISOString().slice(0, 10));
    document.querySelector('#sexta').setAttribute('value', sexta.toISOString().slice(0, 10));
  }
  


httpClient.createStyleViews()

// setar data atual no input de dataInicial
atualizarIntervalo(new Date())


// Toggle botão DIA SEMANA
document.querySelectorAll('.dias-semana > button').forEach(button => {
    button.addEventListener('click', e => {
        // clear the active one
        document.querySelector('.dias-semana > button.active')?.classList.remove('active')
        button.classList.add('active')

        // setar #dataSelecionada
        let dataSelecionada = new Date(button.value)
        dataSelecionada.setDate(dataSelecionada.getDate() + 1) // ajuste para o dia correto
        dataSelecionada = dataSelecionada.toLocaleDateString('pt-BR', { year: 'numeric', month: 'long', day: 'numeric'})
        document.querySelector('#dataSelecionada').innerHTML = dataSelecionada
    })
})

// Toggle o estado de ativo de botão MATUTINO e VESPERTINO
document.querySelectorAll('.circulo > button').forEach(button => {
    button.addEventListener('click', e => {
        button.classList.toggle('active')
    })
})



// Pegar dataInicial para setar intervalo nos botões de dia da semana | selecionador de data
document.querySelector('#dataInicial').addEventListener('change', e => {
    let date = new Date(e.target.value)
    atualizarIntervalo(date)
    // limpar seleção de dia da semana
    document.querySelector('.dias-semana > button.active')?.classList.remove('active')
    document.querySelector('#dataSelecionada').innerHTML = '__ de __ de ____'
})

