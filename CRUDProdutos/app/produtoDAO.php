<?php 
    namespace DAO;
    include_once "connection.php";

    function cadastrarProduto($nome, $descricao, $preco){
        $connection = \connection\conectar();

        $tsql = "INSERT INTO Produtos(Nome, Descricao, Preco) VALUES (?,?,?)";
        $parameters = array($nome, $descricao, $preco);
        $stmt = sqlsrv_query($connection, $tsql, $parameters);

        if($stmt){
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($connection);
            return "Produto cadastrado com sucesso!";
        }
        else{
            sqlsrv_close($connection);
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            return null;
        }
    }

    function editarProduto($nome, $descricao, $preco, $id){
        $connection = \connection\conectar();

        $tsql = "update Produtos set nome = ?,descricao=?,preco= ? where id=?";
        $parameters = array($nome, $descricao, $preco, $id);
        $stmt = sqlsrv_query($connection, $tsql, $parameters);

        if($stmt){
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($connection);
            return "Produto atualizado com sucesso!";
        }
        else{
            sqlsrv_close($connection);
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            return null;
        }
    }

    function excluirProduto($id){
        $connection = \connection\conectar();

        $tsql = "delete from Produtos where id=?";
        $parameters = array( $id);
        $stmt = sqlsrv_query($connection, $tsql, $parameters);

        if($stmt){
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($connection);
            return "Produto removido com sucesso!";
        }
        else{
            sqlsrv_close($connection);
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            return null;
        }
    }

    function getProduto($id){
        $connection = \connection\conectar();

        $tsql = "Select * from Produtos where id=?";
        $parameters = array($id);
        $stmt = sqlsrv_query($connection, $tsql, $parameters);

        if($stmt){

            $linha=sqlsrv_fetch_object($stmt);

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($connection);

            return $linha;
        }
        else{
                sqlsrv_close($connection);
                if( ($errors = sqlsrv_errors() ) != null) {
                    foreach( $errors as $error ) {
                        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        echo "code: ".$error[ 'code']."<br />";
                        echo "message: ".$error[ 'message']."<br />";
                    }
                }
            return null;
        }
    }
    function getAllProdutos(){
        $connection = \connection\conectar();

        $tsql = "Select * from Produtos";
        $stmt = sqlsrv_query($connection, $tsql);
        
        if($stmt){

            $array = array();
            while($linha=sqlsrv_fetch_object($stmt)){
                $array[] = $linha;
            }

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($connection);

            if(sizeof($array) <= 0 ){
                return null;
            }

            return $array;
        }
        else{
            return null;
        }

        

        
    }
?>