<!DOCTYPE html>
<script src="js/bootstrap.js"></script>
<script src="js/js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    function cadastrarProduto(){
        $.ajax({
            type: "POST",
            url: "resposta.php",
            data: {
                inpNome: $("#inpNome").val(),
                inpDescricao: $("#inpDescricao").val(),
                inpPreco: $("#inpPreco").val(),
                actionType: $("#actionType").val()
            },
            success: function(data) {
                Swal.fire({
                    type: 'warning',
                    title: 'Aviso:',
                    text: data
                });
            },
            failure: function(data){
                Swal.fire({
                    type: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao acessar o servidor!'
                });
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

    <body class="bg-light"style="margin:0px; padding:0px;  height=100%">

    <!-- Barra de navegação-->
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <a class="navbar-brand text-white ">
            <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            CRUD
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white">Cadastrar Produtos</a>
                </li>
                <li class="nav-item active">
                    <a href="produtos.php" class="nav-link text-white "> listar Produtos </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Área de conteúdo -->

    <div class="container bg-white justify-content-center col-md-7" style="margin-top:2%; padding-top:2%; display:flex;">
        <div class="form-group justify-content-center col-md-10">
            <h2>Cadastro de Produto</h2>
            <label for="Nome">Nome </label>
            <input type="text" class="form-control" id="inpNome" name="inpNome" placeholder="Nome do Produto" required>

            <label for="Descrição">Descrição:</label>
            <textarea class="form-control" id="inpDescricao" placeholder="Descrição do produto" ></textarea>
            <label for="Preço">Preço:</label>
            <input type="text" class="form-control" id="inpPreco" name="inpPreco" placeholder="Preço do produto"  required>

            <input type="hidden" id="actionType" name="actionType" value="cadastrar">

            <button onClick="cadastrarProduto()" class="btn btn-primary float-right" style="margin-top:15px;" name="btnCadastrar">Cadastrar Produto</button>
        </div>
    </div>
    </body>
</html>