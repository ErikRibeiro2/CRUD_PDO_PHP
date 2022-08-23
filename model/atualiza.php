<?php
    include_once('../connection/conexao.php');
    include_once('../model/functionsDates.php');
    include_once('./log.php');

    if (isset($_POST["nomePessoa"]) && isset($_POST["emailPessoa"]))
    {
        $id = $_POST["idPessoa"];
        $nome = $_POST["nomePessoa"];
        $email = $_POST["emailPessoa"];

        $query = "UPDATE pessoas set nome = '$nome', email = '$email' where id = $id";

        $atualizar = $connect->prepare($query);
        $atualizar->execute();
        session_start();
        if ($atualizar->rowCount())
        {
            $log = new Log();
            $log->newLog("[MODIFICAÇÃO] ", "Registro '$id': Nome: $nome - Email: $email");

            $_SESSION["id"] = $id;
            if (isset($_SESSION["avisoErroAtualizar"])) {
                session_unset($_SESSION["avisoErroAtualizar"]);
            }
            
            if (isset($_SESSION["liberado"])) {
                $_SESSION["avisoSucesso"] = "Registro alterado com sucesso!";
                if (isset($_SESSION["avisoErroAtualizar"])) unset($_SESSION["avisoErroAtualizar"]);
                header("Location: ../pessoa.php");
            }
            else {
                $_SESSION["liberado"] = true;
                $_SESSION["avisoSucesso"] = "Registro alterado com sucesso!";
                header("Location: ../pessoa.php");
            }
            
        }
        else {
            if (!isset($_SESSION["avisoErroAtualizar"]))
            {
                $_SESSION["avisoErroAtualizar"] = "Não atualizado na base de dados!";
                header("Location: ../pessoa.php");
            }
            else {
                header("Location: ../pessoa.php");
            }
            
        }
    }
?>