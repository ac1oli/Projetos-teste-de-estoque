<?php
    session_start();
    require ('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Editar Estoque</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Editar Produto</h4>
              <a href="index.php" class="btn btn-dark">Voltar</a>
            </div>
            <div class="card-body">

            <?php
            if(isset($_GET['idproduto'])){
                $produto_id = (int) $_GET['idproduto'];
                $sql = "SELECT * FROM produtos WHERE idproduto = $produto_id";
                $query = mysqli_query($conexao, $sql);

                // Verifique se há resultados
                if (mysqli_num_rows($query) > 0) {
                    $produto = mysqli_fetch_array($query);
            ?>
              <form action="acoes.php" method="POST">
                <input type="hidden" name="produto_id" value="<?= $produto['idproduto'] ?>">
                <div class="mb-3">
                  <label>Tipo</label>
                  <input type="text" name="tipoProduto" value="<?= $produto['tipoProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Marca</label>
                  <input type="text" name="marcaProduto" value="<?= $produto['marcaProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Modelo</label>
                  <input type="text" name="modeloProduto" value="<?= $produto['modeloProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Serial</label>
                  <input type="text" name="serialProduto" value="<?= $produto['serialProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Mac</label>
                  <input type="text" name="macProduto" value="<?= $produto['macProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Observações</label>
                  <input type="text" name="obsProduto" value="<?= $produto['obsProduto'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Data de Entrada</label>
                  <input type="date" name="dataEntrada" value="<?= $produto['dataEntrada'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Data de Saida</label>
                  <input type="date" name="dataSaida" value="<?= $produto['dataSaida'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label>Motivo da Saida</label>
                  <input type="text" name="motivoSaida" value="<?= $produto['motivoSaida'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <button type="submit" name="atualizar-produto" class="btn btn-dark">Salvar</button>
                </div>
              </form>
              <?php
            }else{
                echo"<h5> Produto não encontrado</h5>";
            }
        }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>









    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>