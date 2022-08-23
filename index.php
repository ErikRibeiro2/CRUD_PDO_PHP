<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view//css//index.css">
    <title>CRUD PDO</title>
</head>

<body>
    <?php include_once('./header.php')?>
    <div class="content-form-cadastro">
        <h1>Cadastro</h1>
        <form action="./model/inserePessoa.php" method="POST">
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome" required name="nome" maxlength="100" minlength="3"><br>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required name="email" maxlength="150" minlength="13"><br>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        <div id="avisoEmail">
            <?php
                session_start();
                if (isset($_SESSION["avisoEmail"]) == true)
                {
                    echo $_SESSION["avisoEmail"];
                }
            ?>
        </div>
    </div>
    <?php include_once('./footer.php') ?>
</body>
</html>