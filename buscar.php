<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/css//buscar.css">
    <title>Buscar</title>
</head>

<body>
    <?php
    //inclusao de codigos
    include_once('./header.php');
    include_once('./connection/conexao.php');
    include_once('./footer.php');
    include_once('./model/functionsDates.php');

    $listar; //indicador de listagem

    $datas = new Datas();
    $hoje = date('Y-m-d');

    if (isset($_POST["valorPesquisa"]) == true) //verifica se um valor foi digitado no campo
    {
        $listar = false; //impede que todos os registros sejam listados
        try {
            $valor = $_POST["valorPesquisa"]; //armazena o valor digitado
            unset($_POST["valorPesquisa"]); //destroi o POST do valor do campo
            //busca pelo registro
            $query_busca_registro = "SELECT *, date_format(cadastro, '%d/%m/%Y') as dt from pessoas where nome like '%$valor%' or email like '%$valor%'";
            $resultado_busca = $connect->prepare($query_busca_registro);
            $resultado_busca->execute();

            $quant_resultados = $resultado_busca->rowCount(); //guarda a quantidade de retornos
        }
        catch(Exception $ex)
        {
            $erro = $ex->getMessage();
        }
    }
    else  //caso não tenha sido passado nenhum valor do campo
    {

        $listar = true; //permite a listagem de todos os registros
        //busca por todos os registros
        $select_all_datas = "SELECT *, date_format(cadastro, '%d/%m/%Y') as dt, datediff($hoje, cadastro) as quant_dias from pessoas ORDER BY id";
        $result_select = $connect->prepare($select_all_datas);
        $result_select->execute();
    }
    
    ?>
    <!--Campo de busca-->
    <section id="content-pesquisa">
        <form action="./buscar.php" method="POST">
            <div id="content-input">
            <input type="text" class="form-control" id="valorPesquisa" placeholder="Buscar por" required name="valorPesquisa" maxlength="100" minlength="3">
            </div>
            <div>
                <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Buscar</button>
            </div>
        </form>
    </section>
    <main>  
        <!-- Lista todos os registros ao carregar-->
                <?php
                //listagem de todos os registros
                if ($listar)
                {
                    if($result_select->rowCount()){        
                ?>
                    <div class="content-global">
                        <table>
                            <th class="col-header">ID</th>
                            <th class="col-header">NOME</th>
                            <th class="col-header">EMAIL</th>
                            <th class="col-header">DATA DE CADASTRO</th>
                        <?php
                            while ($row_result = $result_select->fetch(PDO::FETCH_ASSOC)) {
                        
                        ?>
                        <tr>
                            <form action="./pessoa.php" method="POST">
                                <td class="col-celula">
                                    <input type="number" name="idPessoa" id="idPessoa" value="<?= $row_result['id'] ?>" class="input-id" readonly="false"></td>
                                <td class="col-celula">
                                    <button class="botao-registro"><?= $row_result['nome'] ?></button>
                                </td>
                                <td class="col-celula">
                                    <?= $row_result['email'] ?>
                                </td>
                                <td class="col-celula">
                                    <?= $row_result['dt']?>
                                </td>
                            </form>
                        </tr>
                    </div>

                <?php
                        }
                    }
                    else {
                ?>
                        <section style="text-align: center;margin-top: 100px;">
                            <h1>Nenhum registro na base de dados!</h1>
                        </section>
                <?php
                    }
                }
                //listagem dos registos buscados pelo valor do campo
                else if($listar == false){
                    if ($quant_resultados > 0) {
                ?>
                <!-- Lista os registros pesquisados-->
                <div class="content-global">
                    <table>
                        <th class="col-header">ID</th>
                        <th class="col-header">NOME</th>
                        <th class="col-header">EMAIL</th>
                        <th class="col-header">DATA DE CADASTRO</th>
                    <?php
                        while ($linha = $resultado_busca->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <form action="./pessoa.php" method="POST">
                                <td class="col-celula">
                                    <input type="number" name="idPessoa" id="idPessoa" value="<?= $linha['id'] ?>" class="input-id" readonly="false">
                                </td>
                                <td class="col-celula">
                                    <button class="botao-registro"><?= $linha['nome'] ?></button>
                                </td>
                                <td class="col-celula">
                                    <?= $linha['email'] ?>
                                </td>
                                <td class="col-celula">
                                    <?= $linha['dt']?>
                                </td>
                            </form>
                        </tr>
                    <?php 
                        }                
                        
                    ?>
                    </table>
                </div>
            </div>
        <?php
            }
            else {
        ?>
            <div id="nenhum-registro">
                <h1>Nenhum registro encontrado</h1>
            </div>
        <?php
            }
        }
        ?>
    </main>
</body>

</html>