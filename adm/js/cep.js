function BuscaCep(){
    let cep = document.getElementById('cep').value;

    if(cep !== ""){
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep;

        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        //Tratar a resposta da requisição
        req.onload = function(){
            if(req.status === 200){
                let endereco = JSON.parse(req.response);
                document.getElementById("rua").value = endereco.street
                document.getElementById("setor").value = endereco.neighborhood
                document.getElementById("cidade").value = endereco.city
                document.getElementById("estado").value = endereco.state
            }
            else if(req.status === 404){
                alert('CEP invalido');
            }
            else{
                alert('Erro ao fazer requisição do cep');
            }
        }
    }

}

window.onload = function(){
    let cep = document.getElementById('cep');
    cep.addEventListener("blur", BuscaCep)
}