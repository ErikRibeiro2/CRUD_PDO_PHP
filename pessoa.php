<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/css/pessoa.css">
    <title>Pessoa</title> 
</head>
<body>
    <?php
        include_once('./header.php');
        include_once('./connection/conexao.php');
        include_once('./footer.php');

        session_start();
        
        if (!isset($_POST["idPessoa"]))
        {
            if ($_SESSION["liberado"] != true)
            {
                header("Location: ./buscar.php");
            }
            else {
                $id = $_SESSION["id"];
            }
            
        }
        else $id = $_POST["idPessoa"];
        try{
                
            $query = "SELECT * FROM pessoas where id = $id";
            $busca_pessoa = $connect->prepare($query);
            $busca_pessoa->execute();
            if ($busca_pessoa->rowCount())
            {
                $dados = $busca_pessoa->fetch(PDO::FETCH_ASSOC);
            }
            else {
                echo "Nenhum registro retornado";
            }
        }
        catch(Exception $ex) {
            echo "FALHA: " . $ex->getMessage();
        }
    ?>
    <main>
        <div id="content-global">
            <h1>Dados de <?= $dados["nome"]?></h1>
            <form action="./model/atualiza.php" method="POST">
                <input type="number" name="idPessoa" id="idPessoa" value="<?= $id?>">
                <table>
                        <tr style="margin-bottom: 10px;">
                            <td>Nome: </td>
                            <td>
                                <input type="text" name="nomePessoa" id="nomePessoa" value="<?= $dados["nome"]?>" class="campo">
                            </td>
                        </tr>
                        <tr style="margin-bottom: 10px;">
                            <td>Email: </td>
                            <td>
                                <input type="text" name="emailPessoa" id="emailPessoa" value="<?= $dados["email"]?>" class="campo">
                            </td>
                        </tr>
                </table>
                <button type="submit" style="margin-bottom: 10px;border: 1px solid;">Atualizar dados</button>
            </form>
            <form action="./model/deleta.php" method="POST">
                <input type="number" name="input-id" id="idPessoa" value="<?= $dados["id"]?>" readonly="false" >
                <input type="submit" value="Deletar" style="border: 1px solid;">
            </form>
            <div id="content-aviso">
                <?php
                    if (isset($_SESSION["avisoErroAtualizar"])) {
                        echo $_SESSION["avisoErroAtualizar"];
                    }
                    else if (isset($_SESSION["avisoSucesso"])) echo $_SESSION["avisoSucesso"];

                    unset($_SESSION["avisoSucesso"]);
                ?>
            </div>
        </div>
    </main>
</body>
</html>