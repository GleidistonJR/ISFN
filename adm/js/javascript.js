/*david*/
window.addEventListener("scroll", function(){
    let div = document.querySelector('#menu')
    div.classList.toggle('rolagem',window.scrollY > 0)
})

const menuDiv = document.getElementById('menu-mobile')



function animarMenu(){
    menuDiv.classList.toggle('abrir')
}
function fecharMenu(){
    menuDiv.classList.remove('abrir')
}

