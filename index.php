<?php
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';

    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>    
    <script src="lib/js/ui-bootstrap-tpls.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    </head>

<body>
<div class="container">


<!--
<?php
    //apenas testando a conexao
    if($con->connect() == true){
        echo 'Conectou';
    }else{
        echo 'Não conectou';
    }
?>
-->
<?php

function mask($val, $mask){
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++){
     if($mask[$i] == '#'){
     if(isset($val[$k]))
        $maskared .= $val[$k++];
     }else{
         if(isset($mask[$i]))
         $maskared .= $mask[$i];
     }
 }
 return $maskared;
}


?>


<script>
function teste() {
   // document.getElementById("demo").innerHTML = "Hello World"; //adiciona ao html
    var confirmacao;

    confirmacao=confirm("Você tem certeza que deseja Excluir?");
    if (confirmacao==true) {
        "<?php echo "ola"?>")
    } else{
        alert("deu errado")
    };
    
}
</script>

<h4>Pessoas Cadastradas:</h4>
<table class="table col-xs-12">
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Descrição</th>
            <th>Açoes</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
            $consulta = mysql_query("SELECT * FROM crudcliente"); // query que busca todos os dados da tabela crudcliente
            while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
        ?>
      
        <tr>
            <td><?php echo $campo['id']; // mostrando o campo NOME da tabela ?></td>
            <td><?php echo $campo['nome']; // mostrando o campo NOME da tabela ?></td>
            <td><?php echo mask($campo['cpf'],'###.###.###-##'); ?></td>
            <td><?php echo $campo['email']; ?></td>                      
            <td><?php echo $campo['descricao']; // mostrando o campo DESCRICAO da tabela  ?></td>       
           
            <td>
                <button class="btn btn-primary"onclick="window.location.href='formulario.php?id=<?php echo $campo['id']; ?>'" >
                    <i class="glyphicon glyphicon-edit"></i> Alterar
                </button>
                <button class="btn btn-danger" onclick="window.location.href='excluir.php?id=<?php echo $campo['id']; ?>'">
                    <i class="glyphicon glyphicon-trash"></i> Excluir
                </button>
            </td>
           
            
            
        </tr>

        <?php } ?>
    </tbody>

</table>
   
        <button onclick="window.location.href='formulario.php'"class="btn btn-success">
            <i href="formulario.php" class="glyphicon glyphicon-plus-sign"></i> Cadastrar
        </button>
        <br/>
        
        <a href="documentacao.txt" target="_blank" class="btn btn-default" style="margin-top: 30px;">Documentação</a>
        

</div>
</body>
</html>

<?php $con->disconnect(); // fecha conexao com o banco ?>