var cont = 0
var hamburguer = document.querySelector('#navbar-mobile')

function navbar(){
    cont++
    if(cont%2){
        hamburguer.style.display = 'block'
    }
    else{
        hamburguer.style.display = 'none'
    }
}

