<?php
    include_once('../connection/conexao.php');

    if(!isset($_POST["passHash"]) || !isset($_POST["idLog"])) header("Location: ../detalhesLog.php");
    else {
        $id = $_POST["idLog"];
        $passHash = $_POST["passHash"];

        if($passHash == "erikribeiro2003"){
            $deletaLog = $connect->prepare("DELETE FROM logsistema where idLog = $id");
            $deletaLog->execute();
    
            if($deletaLog->rowCount()){
                header("Location: ../logs.php");
            }
            else {
                header("Location: ../buscar.php");
            }
        }
        else {
            header("Location: ../logs.php");
        }
    }

?>