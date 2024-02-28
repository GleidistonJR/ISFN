/*david*/


const menuDiv = document.getElementById('menu-mobile')
const btnAnimar = document.getElementById('hamburguer')
const btnAnimar2 = document.getElementById('icone2')


menuDiv.addEventListener('click', animarMenu)
btnAnimar2.addEventListener('click', animarMenu)
 
function animarMenu(){
    menuDiv.classList.toggle('abrir')
    btnAnimar.classList.toggle('ativo')
}