<?php
session_start();
require 'conexao.php';


//FUNÇÂO PARA ADICIONAR UM PRODUTO
if (isset($_POST['criar-produto'])) {

    //PEGANDO TODOS OS CONTEUDOS DO FORMULARIO
    $tipoProduto = mysqli_real_escape_string($conexao, trim($_POST['tipoProduto']));
    $marcaProduto = mysqli_real_escape_string($conexao, trim($_POST['marcaProduto']));
    $modeloProduto = mysqli_real_escape_string($conexao, trim($_POST['modeloProduto']));
    $serialProduto = isset($_POST['serialProduto']) && !empty($_POST['serialProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['serialProduto'])) : NULL;
    $macProduto = isset($_POST['macProduto']) && !empty($_POST['macProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['macProduto'])) : NULL;
    $obsProduto = mysqli_real_escape_string($conexao, trim($_POST['obsProduto']));
    $dataEntrada = mysqli_real_escape_string($conexao, trim($_POST['dataEntrada']));
    $dataSaida = mysqli_real_escape_string($conexao, trim($_POST['dataSaida']));
    $motivoSaida = mysqli_real_escape_string($conexao, trim($_POST['motivoSaida']));

    //VALIDA DE A VARIAVEL 'dataSaida' ESTA COM VALOR, SE NÃO ESTIVER, É PSOTO O VALOR 'NULL'
    if (empty($dataSaida)) {
        $dataSaida = "NULL"; 
    } else {
        $dataSaida = "'$dataSaida'"; 
    }

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
    
    //PEGA TODOS OS DADOS DO PRODUTO
    $tipoProduto = mysqli_real_escape_string($conexao, trim($_POST['tipoProduto']));
    $marcaProduto = mysqli_real_escape_string($conexao, trim($_POST['marcaProduto']));
    $modeloProduto = mysqli_real_escape_string($conexao, trim($_POST['modeloProduto']));
    $serialProduto = isset($_POST['serialProduto']) && !empty($_POST['serialProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['serialProduto'])) : NULL;
    $macProduto = isset($_POST['macProduto']) && !empty($_POST['macProduto']) ? mysqli_real_escape_string($conexao, trim($_POST['macProduto'])) : NULL;
    $obsProduto = mysqli_real_escape_string($conexao, trim($_POST['obsProduto']));
    $dataEntrada = mysqli_real_escape_string($conexao, trim($_POST['dataEntrada']));
    $dataSaida = mysqli_real_escape_string($conexao, trim($_POST['dataSaida']));
    $motivoSaida = mysqli_real_escape_string($conexao, trim($_POST['motivoSaida']));

    //VALIDA DE A VARIAVEL 'dataSaida' ESTA COM VALOR, SE NÃO ESTIVER, É PSOTO O VALOR 'NULL'
    if (empty($dataSaida)) {
        $dataSaida = "NULL"; 
    } else {
        $dataSaida = "'$dataSaida'"; 
    }

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

if (isset($_POST['deletar-produto'])){
    $produto_id = mysqli_real_escape_string($conexao,$_POST['deletar-produto']);
    
    $sql = "DELETE FROM produtos WHERE idproduto = '$produto_id'";

    mysqli_query($conexao, $sql);

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
