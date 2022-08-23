<?php
    class Datas
    {
        function contarDias($dias){
            $situacao = "";
            if($dias == 0) $situacao = "Hoje";
            else if($dias == 1) $situacao = "Há $dias dia";
            else if($dias >= 2 && $dias <= 30){
                $situacao = "Há $dias dias";
            }
            else {
                $situacao = null;
            }
            return $situacao;
        }
        
        function dataParaString($data = ""){
            $tamanho = strlen($data);
            $string = "";
            $i = 0;
            for ($i; $i < $tamanho; $i++){
                if ($data[$i] != "-"){
                    $string = $string . $data[$i];
                }
            }
            return $string;
        }
        public function getDataeHora()
        {
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d/m/Y H:i:s');
            return $data;
        }
    }

?>