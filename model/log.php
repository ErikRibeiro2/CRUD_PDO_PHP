<?php
    
    include_once('./functionsDates.php');

    class Log
    {
        public function newLog($acao, $log)
        {
            $connect = new PDO(
                "mysql:host=localhost;dbname=crud_pdo", 
                "root", 
                "",
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                )
            );

            $datas = new Datas();
            $data_atual = $datas->getDataeHora();
            $log_final = "[$data_atual] ". $acao . $log;
            $query_new_log = "INSERT INTO logSistema(idLog, logSistema, dt) values(default, :lg , :dt)";
            $novo_log = $connect->prepare($query_new_log);
            $novo_log->bindParam(":lg", $log_final, PDO::PARAM_STR);
            $novo_log->bindParam(':dt', $data_atual, PDO::PARAM_STR);
            $novo_log->execute();
        }
    }
?>