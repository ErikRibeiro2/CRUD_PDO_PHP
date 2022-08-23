<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/css/logs.css">
    <title>Logs</title>
    <?php
        include_once('./connection/conexao.php');

        $listar;
        if(!isset($_POST["valorPesquisa"]))
        {
            $listar = true;
            $query_busca_log = "SELECT idLog, logsistema from logsistema order by idLog desc limit 10";

            $buscarLog = $connect->prepare($query_busca_log);
            $buscarLog->execute();
        }
        else{
            $listar = false;
            $nome = $_POST["valorPesquisa"];
            $query_busca = "SELECT idLog, logsistema from logsistema where logsistema like '%$nome%' order by idLog desc";
            $buscaLogPesquisa = $connect->prepare($query_busca);
            $buscaLogPesquisa->execute();

        }


    ?>
</head>
<body>
    <nav>
        <?php
            include_once('./header.php');
            date_default_timezone_set('America/Sao_Paulo');


        ?>
    </nav>
    <header>
        <h1>Logs do sistema</h1>
    </header>
    <section id="content-pesquisa">
        <form action="./logs.php" method="POST">
            <div id="content-input">
            <input type="text" class="form-control" id="valorPesquisa" placeholder="Buscar log" required name="valorPesquisa" maxlength="100" minlength="3">
            </div>
            <div>
                <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Buscar</button>
            </div>
        </form>
    </section>
    <main>
        <div class="content-logs">
            <?php
                if($listar == true){
                    if($buscarLog->rowCount())
                    {
                        while($log = $buscarLog->fetch(PDO::FETCH_ASSOC))
                        {
                            ?>
                            <form action="./detalhesLog.php" method="GET">
                                <input type="number" name="idLog" id="idLog" min="0" value="<?= $log["idLog"]?>" style="display: none;">
                                <input type="submit" value="<?= $log["logsistema"]?>" class="log-item">
                            </form>
                            <?php
                        }
                    }
                    else {
                        echo "</h1> Não há logs no sistema</h1>";
                    }
                }
                else if($listar == false){
                    if($buscaLogPesquisa->rowCount())
                    {
                        while($log = $buscaLogPesquisa->fetch(PDO::FETCH_ASSOC))
                        {
                            ?>
                            <form action="">
                                <input type="submit" value="<?= $log["logsistema"]?>" class="log-item">
                            </form>
                            <?php
                        }
                    }
                    else {
                        echo "<h1> Nenhum resultado encontrado </h1>";
                    }
                }
            ?>
        </div>
    </main>

    <?php
        include_once('./footer.php');
    ?>
</body>
</html>