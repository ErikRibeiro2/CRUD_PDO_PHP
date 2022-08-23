<title>Deletando</title>
<p>Deletando...</p>
<?php
    include_once('../connection/conexao.php');
    include_once('../model/log.php');

    if (isset($_POST["input-id"]) == false) {
        header("Location: ../buscar.php");
    }
    else {
        $id = $_POST["input-id"];
        $query = "DELETE FROM pessoas where id = $id";
        $deleta = $connect->prepare($query);
        $deleta->execute();
        if($deleta->rowCount())
        {
            $log = new Log();
            $log->newLog("[DELETE]", "Registro '$id' excluido da base de dados.");
            header("Location: ../buscar.php");
        }
        else {
            header("Location: ../buscar.php");
        }

    }
?>