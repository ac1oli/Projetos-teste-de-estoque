<?php
session_start();
include "conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE</title>

    

</head>
<body>

    <form action="salvar.php" method="POST">
        <input type="text" name="tipo_rb" placeholder="Tipo">
        <input type="text" name="marca_rb" placeholder="Marca">
        <input type="text" name="modelo_rb" placeholder="Modelo">
        <input type="text" name="serial_rb" placeholder="Serial">
        <input type="text" name="mac_rb" placeholder="MAC">
        <input type="text" name="obs_rb" placeholder="Observação">
        <input type="date" name="data_entrada_rb" placeholder="Data de Entrada" required>
        <input type="date" name="data_saida_rb" placeholder="Data de Saida">
        <input type="text" name="motivo_saida_rb" placeholder="Motivo da Saida">

        <button type="submit">Adicionar Produto</button>
    </form>

    <?php

        $sql = "SELECT * FROM rb";
        $result = mysqli_query($conexao, $sql);
     ?>

        <table border="1px solid black">
            <tr>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serial</th>
                <th>MAC</th>
                <th>OBS</th>
                <th>Data de Entrada</th>
                <th>Data de Saída</th>
                <th>Motivo de Saída</th>
            </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        
            <tr>
                <td><?= $row['tipo_rb'] ?></td>
                <td><?= $row['marca_rb'] ?></td>
                <td><?= $row['modelo_rb'] ?></td>
                <td><?= $row['serial_rb'] ?></td>
                <td><?= $row['mac_rb'] ?></td>
                <td><?= $row['obs_rb'] ?></td>
                <td><?= date("d/m/Y", strtotime($row['data_entrada_rb'])) ?></td>
                <td><?= date("d/m/Y", strtotime($row['data_saida_rb'])) ?></td>
                <td><?= $row['motivo_saida_rb'] ?></td>
            </tr>

            <?php endwhile; ?>
       </table>
    

    <?php mysqli_close($conexao);?>

</body>
</html>
