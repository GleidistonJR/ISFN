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


/*JR*/

var cont = 0
var hamburguer = document.querySelector('#navbar-mobile')

function navbar(){
    cont++
    if(cont%2){
        hamburguer.style.height = '215px'
        
    }
    else{
        hamburguer.style.height = '0px'
    }
}

