<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco
@$getId = $_GET['id'];  //pega id para ediçao caso exista
if(@$getId){ //se existir recupera os dados e tras os campos preenchidos
    $consulta = mysql_query("SELECT * FROM crudcliente WHERE id = + $getId");
    $campo = mysql_fetch_array($consulta);
}

if(isset ($_POST['cadastrar'])){  // caso nao seja passado o id via GET cadastra 
    $nome = $_POST['nome'];  //pega o elemento com o pelo NAME
    $cpf = $_POST['cpf']; 
    $email = $_POST['email'];
    $descricao = $_POST['descricao']; //pega o elemento com o pelo NAME 
    $crud = new crud('crudcliente');  // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->inserir("nome,cpf,email,descricao", "'$nome','$cpf','$email','$descricao'"); // utiliza a funçao INSERIR da classe crud
    header("Location: index.php"); // redireciona para a listagem
}

if(isset ($_POST['editar'])){ // caso  seja passado o id via GET edita 
    $nome = $_POST['nome'];  //pega o elemento com o pelo NAME
    $cpf = $_POST['cpf']; 
    $email = $_POST['email'];
    $descricao = $_POST['descricao']; //pega o elemento com o pelo NAME 
    $crud = new crud('crudcliente');  // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome', cpf ='$cpf', email='$email',descricao='$descricao'", "id='$getId'"); // utiliza a funçao ATUALIZAR da classe crud
    header("Location: index.php"); // redireciona para a listagem
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <script src="lib/js/ui-bootstrap-tpls.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <script type="text/javascript">
        function SomenteNumero(e){
            var expressao;
            expressao = /[0-9]/;
            if(expressao.test(String.fromCharCode(e.keyCode))){
                return true;
            }
            else{
                return false;
            }
        }
        function SomenteLetras(e){
            var expressao;
            expressao = /[a-zA-Z]/;
            if(expressao.test(String.fromCharCode(e.keyCode))){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h3 style="text-align: center;">Cadastro de Clientes</h3>
        <form action="" method="post"><!--   formulario carrega a si mesmo com o action vazio  -->
            <div class="col-md-12">
                <div class="form-group col-md-3 required">
                    <label>Nome:</label>
                    <input type="text" placeholder="João Paulo" class="form-control" name="nome" required onKeypress="return SomenteLetras(event)" value="<?php echo @$campo['nome']; // trazendo campo preenchido caso esteja no modo de ediçao ?>" />
                </div>
                <div class="form-group col-md-3 required">
                    <label>CPF</label>
                    <input  type="text" placeholder="000.000.000-00" class="form-control" name="cpf" required maxlength="14" onkeypress='return SomenteNumero(event)' value="<?php echo @$campo['cpf']; ?>" />
                </div>
                <div class="form-group col-md-3 required">
                    <label>E-mail</label>
                    <input type="email" placeholder="email@dominio.com.br" class="form-control" name="email" required value="<?php echo @$campo['email']; ?>" />
                </div>
                <div class="form-group col-md-3 required">
                    <label>Descri&ccedil;&atilde;o:</label>
                    <input type="text" placeholder="Descrição do Funcionário..." class="form-control" name="descricao" required value="<?php echo @$campo['descricao']; // trazendo campo preenchido caso esteja no modo de ediçao ?>" />
                </div>
            </div>

            <div class="col-md-12">        
                <?php
                    if(@!$campo['id']){ // se nao passar o id via GET nao está editando, mostra o botao de cadastro
                ?>
             
                <button type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success "><i href="formulario.php" class="glyphicon glyphicon-plus-sign"></i> Cadastrar</button>
                <?php }else{ // se  passar o id via GET  está editando, mostra o botao de ediçao ?>
                <button type="submit" name="editar" value="Alterar" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Alterar</button>
                
                


                <?php } ?>
                <a href="index.php" class="btn btn-danger">Cancela</a>

            </div>
        </form>

    </div>
</body>
</html>
<?php $con->disconnect(); // fecha conexao com o banco ?>