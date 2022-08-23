<title>Cadastrando...</title>
<p>Cadastrando, aguarde...</p>
<?php
    include_once('../connection/conexao.php'); //importação da variavel de conexão
    include_once('../model/functionsDates.php');
    include_once('../model/log.php');

    try
    {
        //recebimento e armazenamento dos dados
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $dataHoje = date('Y-m-d');
 
        //verificação se o email informado ja se encontra cadastrado
        $queryBuscaEmail = "SELECT id from pessoas where email = :email"; 
        $busca = $connect->prepare($queryBuscaEmail);
        $busca->bindValue(":email", $email);
        $busca->execute();

        //insert caso email nao seja encontrado
        if(!$busca->rowCount()) {
            $query = "INSERT INTO pessoas (id, nome, email, cadastro) values(default, :nome, :email, :dt)";
            $cadastro = $connect->prepare($query);
            $cadastro->bindParam(":nome", $nome, PDO::PARAM_STR);
            $cadastro->bindParam(":email", $email, PDO::PARAM_STR);
            $cadastro->bindParam(":dt", $dataHoje, PDO::PARAM_STR);
            $cadastro->execute();
            //verificação se o registro foi feito
            if($cadastro->rowCount()) {
                echo "Cadastro realizado com sucesso!";

                $log = new Log();
                $log->newLog("[CADASTRO] ", "Cadastro de $nome");

                //destruindo SESSION
                session_start();
                if (isset($_SESSION["avisoEmail"]) == true) {
                    session_unset();
                    session_destroy();
                }
                header("Location: ../index.php");

            }
            else {
                echo "Não cadastrado.";
            }
        }
        //retorna a pagina de cadastro caso ja exista esse email
        else {
            session_start();
            if (isset($_SESSION["avisoEmail"])) {
                header("Location: ../index.php");
            }
            else {
                $_SESSION["avisoEmail"] = "Este email já está cadastrado. Insira outro!";
                header("Location: ../index.php");
            }
        }

        
    }
    catch(Exception $ex) 
    {
        echo "ERRO DETECTADO: " . $ex->getMessage();
    }
?>