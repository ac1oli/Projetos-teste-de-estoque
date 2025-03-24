<?php
require('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Visualizar Estoque</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Produtos</h4>
              <a href="index.php" class="btn btn-dark">Voltar</a>
            </div>
            <div class="card-body">
                <?php
                // Verifique se o id foi passado pela URL
                if (isset($_GET['id'])) {
                    // Garanta que o id seja tratado como inteiro para evitar SQL Injection
                    $produto_id = (int) $_GET['id'];
                    
                    // Criação da consulta SQL
                    $sql = "SELECT * FROM produtos WHERE idproduto = $produto_id";
                    $query = mysqli_query($conexao, $sql);

                    // Verifique se há resultados
                    if (mysqli_num_rows($query) > 0) {
                        $produto = mysqli_fetch_array($query);
                ?>

                <div class="mb-3">
                  <label>Tipo</label>
                  <p class="form-control"><?= $produto['tipoProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Marca</label>
                  <p class="form-control"><?= $produto['marcaProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Modelo</label>
                  <p class="form-control"><?= $produto['modeloProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Serial</label>
                  <p class="form-control"><?= $produto['serialProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Mac</label>
                  <p class="form-control"><?= $produto['macProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Observações</label>
                  <p class="form-control"><?= $produto['obsProduto']; ?></p>
                </div>
                <div class="mb-3">
                  <label>Data de Entrada</label>
                  <p class="form-control">
                  <?= date('d/m/Y', strtotime($produto['dataEntrada'])); ?> </p>
                </div>
                <div class="mb-3">
                  <label>Data de Saída</label>
                    <p class="form-control">
                        <?php 
                            // Verificar se a data está preenchida e formatá-la
                            if (!empty($produto['dataSaida'])) {
                                $data = DateTime::createFromFormat('Y-m-d', $produto['dataSaida']);
                                echo $data->format('d/m/Y'); // Formato brasileiro
                            } else {
                                echo 'Não informada'; // Caso a data não tenha sido informada
                            }
                        ?>
                    </p>
                </div>
                <div class="mb-3">
                  <label>Motivo da Saída</label>
                  <p class="form-control"><?= $produto['motivoSaida']; ?></p>
                </div>

                <?php
                    } else {
                        // Caso o produto não seja encontrado
                        echo "<h5>Produto não encontrado</h5>";
                    }
                } else {
                    // Caso o id não seja passado pela URL
                    echo "<h5>ID do produto não especificado</h5>";
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript (Opcional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
