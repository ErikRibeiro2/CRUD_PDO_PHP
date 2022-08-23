document.querySelector("#botaoDeletar").addEventListener('click', function(){
    var content = document.getElementById('content-acoes')
    content.style.display = "block";
})

document.querySelector("#botaoCancelar").addEventListener('click', function(){
    var content = document.getElementById('content-acoes')
    content.style.display = "none";
})