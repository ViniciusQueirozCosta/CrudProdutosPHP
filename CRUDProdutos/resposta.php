<?php
    include_once 'app/controle.php';
    $resposta = \controle\controle();
    if(is_string($resposta)){
        echo $resposta;
    }
    
?>
