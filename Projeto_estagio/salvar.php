<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_rb = !empty($_POST["tipo_rb"]) ? $_POST["tipo_rb"] : NULL;
    $marca_rb = !empty($_POST["marca_rb"]) ? $_POST["marca_rb"] : NULL;
    $modelo_rb = !empty($_POST["modelo_rb"]) ? $_POST["modelo_rb"] : NULL;
    $serial_rb = !empty($_POST["serial_rb"]) ? $_POST["serial_rb"] : NULL;
    $mac_rb = !empty($_POST["mac_rb"]) ? $_POST["mac_rb"] : NULL;
    $obs_rb = !empty($_POST["obs_rb"]) ? $_POST["obs_rb"] : NULL;
    $data_entrada_rb = !empty($_POST["data_entrada_rb"]) ? $_POST["data_entrada_rb"] : NULL;
    $data_saida_rb = !empty($_POST["data_saida_rb"]) ? $_POST["data_saida_rb"] : NULL;
    $motivo_saida_rb = !empty($_POST["motivo_saida_rb"]) ? $_POST["motivo_saida_rb"] : NULL;

    $sql = 
    "INSERT INTO rb (tipo_rb, marca_rb, modelo_rb, serial_rb, mac_rb, obs_rb, data_entrada_rb, data_saida_rb, motivo_saida_rb) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparando o statement
    if ($stmt = mysqli_prepare($conexao, $sql)) {

        mysqli_stmt_bind_param($stmt, "sssssssss", $tipo_rb, $marca_rb, $modelo_rb, $serial_rb, $mac_rb, $obs_rb, $data_entrada_rb, $data_saida_rb, $motivo_saida_rb);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Erro ao executar a consulta: " . mysqli_error($conexao);
        }
        mysqli_stmt_close($stmt);
    }

    
    mysqli_close($conexao);
}
?>
