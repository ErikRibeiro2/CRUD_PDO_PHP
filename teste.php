<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE</title>
    <style>
        .bloco{
            width: 300px;
            height: 100px;
            background-color: yellow;
            transition: all 1s ease;
            display: none;
        }
        .open{
            width: 600px;
            margin-top: 20px;
            background-color: green;
            display: block;
            transition: display 0.4 ease;
        }
    </style>
</head>
<body>
    <button id="botao">Clique</button>
    <div class="bloco" id="bloco">

    </div>
    <script>
        document.querySelector("#botao").addEventListener('click', function(){
            var bloco = document.querySelector("#bloco");
            if(bloco.classList.contains('open')){
                bloco.classList.remove('open')
            }
            else {
                bloco.classList.add('open');
            }
        })
    </script>
</body>
</html>