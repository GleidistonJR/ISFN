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

