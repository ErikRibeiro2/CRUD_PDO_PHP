<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/css/detalhes.css">
    <title>Detalhes Log</title>
    <style>
        header{
            text-align: center;
            padding: 20px 0px;
        }
        .content-log{
        max-width: max-content;
        background-color: rgb(238, 238, 238);
        padding: 10px 20px;
        margin: auto;
        border: 1px solid black;
        border-radius: 10px;
    }
    .ativo{
        display: block;
    }
    </style>
</head>
<body>
    <?php
        include_once('./connection/conexao.php');
        include_once('./header.php');

        try{
            if (!isset($_GET["idLog"])) header("Location: ./logs.php");
            else {
                $idLog = $_GET["idLog"];

                $query = "SELECT idLog as id, logsistema as lg, dt from logsistema where idLog = :id";
                $buscaLog = $connect->prepare($query);
                $buscaLog->bindValue(":id", $idLog);
                $buscaLog->execute();

                if ($buscaLog->rowCount()) $dadosLog = $buscaLog->fetch(PDO::FETCH_ASSOC);
                else echo "Registro não encontrado";
            }
        }
        catch (Exception $ex)
        {
            echo "MENSAGEM DE ERRO: " . $ex->getMessage();
        }

    ?>
    <header>
        <h1>Log | DETALHES</h1>
    </header>
    <main>
        <div class="content-log">
            <table>
                <tr>
                    <td><h5>id:</h3></td><td><h5><?= $dadosLog["id"]?></h5></td>
                </tr>
                <tr>
                    <td style="padding-right: 20px;"><h5>Data: </h5></td><td><h5><?= $dadosLog["dt"]?></h5></td>
                </tr>
                <tr>
                    <td><h5>Log:</h5></td><td><h5><?= substr($dadosLog["lg"], 21)?></h5></td>
                </tr>
            </table>
        </div>
        <div style="text-align: center;padding: 10px 0px;">
            <button onclick="javascript:history.back()">Retornar</button>
            <button style="margin-left: 30px;" id="botaoDeletar">Deletar log</button>
        </div>
        <div id="content-acoes" class="">
            <form action="./model/deletarLog.php" method="POST">
                <input type="number" name="idLog" id="idLog" min="0" value="<?= $dadosLog["id"]?>" style="display: none;">
                <input type="password" class="form-control" id="passHash" placeholder="Código de segurança" required name="passHash" maxlength="100" minlength="3">
                <div style="text-align: right;padding: 10px 0px;">
                    <button type="submit" class="btn btn-danger">Deletar</button>
                    <button type="submit" class="btn btn-warning" style="margin-left: 10px;" id="botaoCancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </main>

    <script src="./view/js/script.js"></script>
    <?php
        include_once('./footer.php');
    ?>
</body>
</html>