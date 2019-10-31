<?php
    namespace connection;
    function conectar(){

        $serverName = 'VINÍCIUS\\VINICIUS_DB, 1433';
        $uid = 'sa';
        $pwd = '1234';
        $database = 'dbProdutos';
        $connectionInfo = array('Database' => $database, 'UID' => $uid, 'PWD' => $pwd);
        $connection = sqlsrv_connect($serverName, $connectionInfo);

        if($connection === false)
        {
            echo "A conexão com o SQL não foi bem sucedida";
            die(print_r($sqlsrv_errors, true));
        }
        return $connection;
    }

?>