<?php
session_start();
require 'conexao.php';


//FUNÇÂO PARA ADICIONAR UM PRODUTO
if (isset($_POST['criar-produto'])) {

    //PEGANDO TODOS OS CONTEUDOS DO FORMULARIO E VALIDA SE OS CAMPOS ESTÃO COM ALGUM DADO OU NÃO
    $tipoProduto = isset($_POST['tipoProduto']) && !empty($_POST['tipoProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['tipoProduto'])) : NULL;
    $marcaProduto = isset($_POST['marcaProduto']) && !empty($_POST['marcaProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['marcaProduto'])) : NULL;
    $modeloProduto = isset($_POST['modeloProduto']) && !empty($_POST['modeloProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['modeloProduto'])) : NULL;
    $serialProduto = isset($_POST['serialProduto']) && !empty($_POST['serialProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['serialProduto'])) : NULL;
    $macProduto = isset($_POST['macProduto']) && !empty($_POST['macProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['macProduto'])) : NULL;
    $obsProduto = isset($_POST['obsProduto']) && !empty($_POST['obsProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['obsProduto'])) : NULL;
    $dataEntrada = mysqli_real_escape_string($conexao, trim($_POST['dataEntrada']));
    $dataSaida = empty($_POST['dataSaida']) ? $dataSaida = "NULL" : mysqli_real_escape_string($conexao, trim($_POST['dataSaida']));
    $motivoSaida = isset($_POST['motivoSaida']) && !empty($_POST['motivoSaida']) ? mysqli_real_escape_string($conexao, trim($_POST['motivoSaida'])) : NULL;

    // COMANDO EM SQL PARA ADICIONAR UM PRODUTO
    $sql = 
    "INSERT INTO produtos (tipoProduto, marcaProduto, modeloProduto, serialProduto, macProduto, obsProduto, dataEntrada, dataSaida, motivoSaida)

    VALUES ('$tipoProduto', '$marcaProduto', '$modeloProduto', '$serialProduto', '$macProduto', '$obsProduto', '$dataEntrada', $dataSaida, '$motivoSaida')";

    //ADICIONA O PRODUTO NO BANCO DE DADOS
    mysqli_query($conexao, $sql);

    //FAZ A VERIFICAÇÃO PARA VER SE O PRODUTO FOI ADICIONADO OU NÃO
    if (mysqli_affected_rows($conexao) > 0 ) {
        $_SESSION['mensagem'] = 'Produto adicionado com sucesso!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Produto não adicionado!';
        header('Location: index.php');
        exit;
    }
}

//FUNÇÃO PARA ATUALIZAR UM PRODUTO
if (isset($_POST['atualizar-produto'])) {

    //VERIFICA SE O ID DO PRODUTO ESTA CORRESPONDENDO
    $produto_id = mysqli_real_escape_string($conexao,$_POST['produto_id']);
    
    //PEGA TODOS OS DADOS DO PRODUTO E VERIFICA SE ESTÃO PREENCHIDOS OU NÃO
    $tipoProduto = isset($_POST['tipoProduto']) && !empty($_POST['tipoProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['tipoProduto'])) : NULL;
    $marcaProduto = isset($_POST['marcaProduto']) && !empty($_POST['marcaProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['marcaProduto'])) : NULL;
    $modeloProduto = isset($_POST['modeloProduto']) && !empty($_POST['modeloProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['modeloProduto'])) : NULL;
    $serialProduto = isset($_POST['serialProduto']) && !empty($_POST['serialProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['serialProduto'])) : NULL;
    $macProduto = isset($_POST['macProduto']) && !empty($_POST['macProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['macProduto'])) : NULL;
    $obsProduto = isset($_POST['obsProduto']) && !empty($_POST['obsProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['obsProduto'])) : NULL;
    $dataEntrada = mysqli_real_escape_string($conexao, trim($_POST['dataEntrada']));
    $dataSaida = isset($_POST['dataSaida']) && !empty($_POST['dataSaida']) ? "'". mysqli_real_escape_string($conexao, trim($_POST['dataSaida'])) ."'" : "NULL";
    $motivoSaida = isset($_POST['motivoSaida']) && !empty($_POST['motivoSaida']) ? mysqli_real_escape_string($conexao, trim($_POST['motivoSaida'])) : NULL;

    // COMANDO EM SQL PARA ATUALIZAR O PRODUTO
    $sql = 
        "UPDATE produtos 
        SET tipoProduto = '$tipoProduto', 
        marcaProduto = '$marcaProduto', 
        modeloProduto = '$modeloProduto', 
        serialProduto = '$serialProduto', 
        macProduto = '$macProduto', 
        obsProduto = '$obsProduto', 
        dataEntrada = '$dataEntrada', 
        dataSaida = $dataSaida, 
        motivoSaida = '$motivoSaida'";

    //FILTRA PELO 'produto_id' PARA VER SE ESTA TUDO CERTO PARA REALIZAR A ATUALIZAÇÃO
    $sql .= "WHERE idproduto = '$produto_id'";
    
    //REALIZA A ATUALIZAÇÃO NO BANCO DE DADOS
    mysqli_query($conexao, $sql);

    //VERIFICA SE O PRODUTO FOI ALTERADO
    if (mysqli_affected_rows($conexao) > 0 ) {
        $_SESSION['mensagem'] = 'Produto atualizado com sucesso!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Produto não atualizado!';
        header('Location: index.php');
        exit;
    }
}

//FUNÇÃO PARA EXCLUIR UM PRODUTO
if (isset($_POST['deletar-produto'])){

    // VERIFICA O ID PASSADO PARA A EXCLUSÃO DO PRODUTO
    $produto_id = mysqli_real_escape_string($conexao,$_POST['deletar-produto']);
    
    //COMANDO EM SQL PARA REALIZAR A EXCLUSÃO DO PRODUTO
    $sql = "DELETE FROM produtos WHERE idproduto = '$produto_id'";
    //REALIZAÇÃO DO COMANDO COM O BANCO DE DADOS
    mysqli_query($conexao, $sql);

    //VERIFICA SE O PRODUTO FOI EXCLUIDO, SE SIM, VAI APARECER ESSA MENSAGEM, SE NAO, VAI APARECER A OUTRA
    if(mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem'] = 'Produto deletado com sucesso!';
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['mensagem'] = 'Produto não deletado';
        header('Location: index.php');
        exit;
    }
}
?>
