<?php 
    namespace validacao;
    function validarDadosProduto($nome,$descricao, $preco, $id=0){
        $errorMessage=null;
        if(is_numeric($id)){
            if($id < 0){
                $errorMessage += "Erro: ID menor que zero!\n";
            }
        }
        else{
            $errorMessage += "Erro: ID inválido!\n";
        }

        if(is_numeric($preco)){
            if($id < 0){
                $errorMessage += "Erro: Preço menor que zero!\n";
            }
        }
        else{
            $errorMessage += "Erro: Preço inválido!\n";
        }

        if(is_null($nome)){
            $errorMessage += "Erro: Nome nulo!\n";
        }

        if(is_null($descricao)){
            $errorMessage += "Erro: Descrição nula!\n";
        }

        return $errorMessage;
    }
?>