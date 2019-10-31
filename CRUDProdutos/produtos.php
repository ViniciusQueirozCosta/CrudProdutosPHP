<!DOCTYPE html>
<?php
    include_once 'app/controle.php';
    $resposta = \controle\gerarLista();
?>
<script src="js/bootstrap.js"></script>
<script src="js/js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    function recarregar(){
        document.location.reload(true);
    }
    function editar(){
        $.ajax({
            type: "POST",
            url: "resposta.php",
            data: {
                inpNome: $("#inpNome").val(),
                inpDescricao: $("#inpDescricao").val(),
                inpPreco: $("#inpPreco").val(),
                inpId: $("#inpId").val(),
                actionType: "editar"
            },
            success: function(data) {
                Swal.fire({
                    type: 'warning',
                    title: 'Aviso:',
                    text: data,
                    onClose: recarregar
                });
            },
            failure: function(data){
                Swal.fire({
                    type: error,
                    type: 'Oops...',
                    title: 'Erro ao acessar o servidor',
                });
            }
        });
    }

    function formEditar(id){
         $.ajax({
            type: "POST",
            url: "resposta.php",
            dataType: "json",
            data: {
                inpId: id,
                actionType: "formEditar"
            },
            success: function(data) {
                produto = data;
                Swal.fire({
                title: 'Editar Produto',
                showCancelButton: false,
                showConfirmButton: false,
                html:
                '<label id="id">ID do Produto: '+produto.id+'</label>' +
                '<input id="inpNome" value="'+produto.nome+'" class="swal2-input" required>' +
                '<input id="inpDescricao" value="'+produto.descricao+'" class="swal2-input" required>'+
                '<input id="inpPreco" value="'+produto.preco+'" class="swal2-input" required>'+
                '<input id="inpId" value="'+produto.id+'" type="hidden">' +
                '<button onClick="editar()" class="btn btn-primary float-right" style="margin-top:15px;" name="editar">Editar</button>',
                
                onOpen: function () {
                $('#inpNome').focus()
                },
                onClose: recarregar
                });
            },
            error: function(){
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Erro ao adquirir os dados!'
                });
            }
        });
    }

    function excluir(id){
        $.ajax({
            type: "POST",
            url: "resposta.php",
            data: {
                inpId: id,
                actionType: "excluir"
            },
            success: function(data) {
                Swal.fire({
                    title: 'Aviso:',
                    text: data,
                    type: 'success',
                    onClose: recarregar
                });
            },
            failure: function(data){
                Swal.fire({
                    title: 'Oops...',
                    text: 'Ocorreu um erro ao deletar o Produto',
                    type: 'error'
                });
            }
        });
    }

    function confirmarExcluir(id){
        Swal.fire({
            title: 'Cuidado!',
            text: "Deseja realmente excluir esse produto?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Deletar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) 
            {
                excluir(id);
            }
        });
    }

</script>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="icon" href="img/logo.png" type="image/x-icon" />
        <title>
            CRUDProdutos
        </title>
    </head>
    <body class="bg-light" style="margin:0px; padding:0px">

        <!-- Barra de navegação-->
        <nav class="navbar navbar-expand-lg navbar-light bg-danger">
            <a class="navbar-brand text-white " >
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                CRUD
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="index.php">Cadastrar Produtos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-white "> listar Produtos </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Área de conteúdo -->
        <div class="container bg-white justify-content-center col-md-7" style="margin-top:2%; padding-top:2%; display:flex;">
            <div class="form-group justify-content-center col-md-12">
                <table id="resultados" class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin-top: 3%;">
                    <thead>
                        <tr>
                            <th class="th-sm">ID
                            </th>
                            <th class="th-sm">Nome
                            </th>
                            <th class="th-sm">Descrição
                            </th>
                            <th class="th-sm">Preço
                            </th>
                            <th class="th-sm">Editar
                            </th>
                            <th class="th-sm">Excluir
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <h2>Produtos</h2>
                        <?php
                            if(!is_string($resposta)){
                                foreach($resposta as $linha){
                                    echo "
                                    <tr>
                                        <th class=\"th-sm\">$linha->id
                                        </th>
                                        <th class=\"th-sm\">$linha->nome
                                        </th>
                                        <th class=\"th-sm\">$linha->descricao
                                        </th>
                                        <th class=\"th-sm\">R$ ".number_format($linha->preco,2)."
                                        </th>
                                        <th class=\"th-sm\">
                                            <button onClick=\"formEditar($linha->id)\" class=\"btn btn-primary\" name=\"btnEditar\">Editar</button>
                                        </th>
                                        <th class=\"th-sm\">
                                            <button onClick=\"confirmarExcluir('$linha->id')\" class=\"btn btn-primary bg-danger\" name=\"btnExcluir\">Excluir</button>
                                        </th>
                                    </tr>
                                    ";
                                }
                            }
                            else{
                                echo "<h2> $resposta</h2>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>