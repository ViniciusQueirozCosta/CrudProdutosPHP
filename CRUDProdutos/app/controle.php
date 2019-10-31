<?php
    namespace controle;
    include_once 'validacao.php';
    include_once 'produtoDAO.php';

    function cadastrarProduto($nome, $descricao, $preco)
    {
        //validacao dos dados
        $status = \validacao\validarDadosProduto($nome, $descricao, $preco);

        if(is_null($status)){
            //insercao
            return \DAO\cadastrarProduto($nome, $descricao,$preco);
        }
        else{
            return $status;
        }
    }

    function editarProduto($nome, $descricao, $preco, $id){

        //validacao dos dados
        $status = \validacao\validarDadosProduto($nome, $descricao, $preco, $id);

        if(is_null($status)){
            //edicao
            return \DAO\editarProduto($nome, $descricao, $preco, $id);
        }
        else{
            return $status;
        }
    }

    function getProduto($id){
        //validacao dos dados
        $status = \validacao\validarDadosProduto("placeholder", "placeholder", 1 , $id);
        if(is_null($status)){
            return \DAO\getProduto($id);
        }
        else{
            return "Id Inválido";
        }
    }

    function getAllProdutos(){
        return \DAO\getAllProdutos();
    }

    function excluirProduto($id){
        //validacao dos dados
        $status = \validacao\validarDadosProduto("placeholder", "placeholder", 1 , $id);
        if(is_null($status)){
            return \DAO\excluirProduto($id);
        }
        else{
            return "Id Inválido";
        }
    }

    function gerarLista(){
        $response = getAllProdutos();

        if(!is_null($response)){
            return $response;
        }
        else{
            return "Não há nenhum produto cadastrado ainda!";
        }
    }

    // Chamadas usando o código de actionType
    function controle(){
        $response = null;
        if(isset($_POST['actionType'])){
            if($_POST['actionType'] == "cadastrar"){
                
                $response = cadastrarProduto($_POST['inpNome'], $_POST['inpDescricao'], $_POST['inpPreco']);

                if(!is_null($response)){
                    return $response;
                }
                else{
                    return "Erro ao cadastrar o produto!";
                }
            }

            else if($_POST['actionType'] == 'formEditar'){

                $response = getProduto($_POST['inpId']);

                if(!is_null($response)){
                    echo json_encode($response);
                }
                else{
                    return "Erro ao adquirir as informações!";
                }
            }

            else if($_POST['actionType'] == 'editar'){
                $response = editarProduto($_POST['inpNome'], $_POST['inpDescricao'], $_POST['inpPreco'], $_POST['inpId']);

                if(!is_null($response)){
                    return $response;
                }
                else{
                    return "Erro ao editar o produto!";
                }
            }

            // Construção da página produtos.php
            else if($_POST['actionType'] == 'listar'){
                
                $response = getAllProdutos();

                if(!is_null($response)){
                    return $response;
                }
                else{
                    return "Não há nenhum produto cadastrado ainda!";
                }
            }
            else if($_POST['actionType'] == 'excluir'){

                $response = excluirProduto($_POST['inpId']);
                if(!is_null($response)){
                    return $response;
                }
                else{
                    return "Erro ao excluir o produto!";
                }
            }
            else{
                return "Erro 404 - Função Inválida.";
            }
        }
        else
            return "Erro 404 - Função Inválida.";
    }
    
?>