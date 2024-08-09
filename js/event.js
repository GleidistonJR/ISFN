window.addEventListener("scroll", function(){
    let div = document.querySelector('#menu')
    div.classList.toggle('rolagem',window.scrollY > 0)
})
