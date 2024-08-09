/*david*/
window.addEventListener("scroll", function(){
    let div = document.querySelector('#menu')
    div.classList.toggle('rolagem',window.scrollY > 0)
})

const menuDiv = document.getElementById('menu-mobile')
const btnAnimar = document.getElementById('hamburguer')
const btnAnimar2 = document.getElementById('icone2')


menuDiv.addEventListener('click', animarMenu)
btnAnimar2.addEventListener('click', animarMenu)

function animarMenu(){
    menuDiv.classList.toggle('abrir')
    btnAnimar.classList.toggle('ativo')
    
}


/*Ler Mais*/

const LerMais = document.getElementById('LerMais')
const LerMenos = document.getElementById('LerMenos')

const texto = document.getElementById('Mais')

LerMais.addEventListener("click", function(){
    texto.style = "display: block;"
    LerMais.style = "display:none;"
})

LerMenos.addEventListener("click", function(){
    texto.style = "display: none;"
    LerMais.style = "display:block;"
})

/*Carrousel*/

const carousel = new bootstrap.Carousel('#carouselExampleCaptions', {
    interval: 3000,
    ride: true,
    touch: true,
})