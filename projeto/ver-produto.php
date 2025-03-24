<!-- REALIUZA A CONEXAO COM O BANCO DE DADOS -->
<?php
require('conexao.php');
?>

<!-- INICIO DA ESTRUTURA HTML -->
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- TITULO DA PAGINA -->
    <title>Visualizar Estoque</title>

  </head>

  <body>

    <!-- INCLUI O ARQUIVO 'navbar.php' NO CODIGO  -->
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
                //VERIFICA SE O 'id' FOI PASSADO
                if (isset($_GET['id'])) {
                    // GARANTE QUE O ID SEJA DO TIPO INTEIRO
                    $produto_id = (int) $_GET['id'];
                    // COMANDO PARA REALIZAR A CONSULTA NO BANCO DE DADOS, FILTRANDO PELO 'id'
                    $sql = "SELECT * FROM produtos WHERE idproduto = $produto_id";
                    $query = mysqli_query($conexao, $sql);
                    // VERIFICA SE TEM ALGUM RESULTADO
                    if (mysqli_num_rows($query) > 0) {
                        $produto = mysqli_fetch_array($query);
                ?>

                <!-- APRESENTA O CONTEUDO DO TIPO DO PRODUTO -->
                <div class="mb-3">
                  <label>Tipo</label>
                  <p class="form-control"><?= $produto['tipoProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DA MARACA DO PRODUTO -->
                <div class="mb-3">
                  <label>Marca</label>
                  <p class="form-control"><?= $produto['marcaProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DO MODELO DO PRODUTO -->
                <div class="mb-3">
                  <label>Modelo</label>
                  <p class="form-control"><?= $produto['modeloProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DO SERIAL DO PRODUTO -->
                <div class="mb-3">
                  <label>Serial</label>
                  <p class="form-control"><?= $produto['serialProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DO MAC DO PRODUTO -->
                <div class="mb-3">
                  <label>Mac</label>
                  <p class="form-control"><?= $produto['macProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DE OBSERVAÇÕES DO PRODUTO -->
                <div class="mb-3">
                  <label>Observações</label>
                  <p class="form-control"><?= $produto['obsProduto']; ?></p>
                </div>

                <!-- APRESENTA O CONTEUDO DA DATA DE ENTRADA DO PRODUTO -->
                <div class="mb-3">
                  <label>Data de Entrada</label>
                  <p class="form-control">
                  <?= date('d/m/Y', strtotime($produto['dataEntrada'])); ?> </p>
                </div>
                
                <!-- APRESENTA O CONTEUDO DA DATA DE SAIDA DO PRODUTO -->
                <div class="mb-3">
                  <label>Data de Saída</label>
                    <p class="form-control">
                        <?php 
                            //VERIFICA SE A DATA ESTA PREENCHIDA
                            if (!empty($produto['dataSaida'])) {
                                //CRIA UMA VARIAVEL TEMPARARIA E FORMATA A DATA PARA O PADRÃO BRASILEIRO
                                $data = DateTime::createFromFormat('Y-m-d', $produto['dataSaida']);
                                //IMPRIME A DATA
                                echo $data->format('d/m/Y');
                            } else { //CASO A DATA NÃO FOR INSERIDA, VAI APARARECER ESSA MENSAGEM
                                echo 'Não informada';
                            }
                        ?>
                    </p>
                </div>

                <!-- APRESENTA O CONTEUDO DO MOTIVO DA SAIDA DO PRODUTO -->
                <div class="mb-3">
                  <label>Motivo da Saída</label>
                  <p class="form-control"><?= $produto['motivoSaida']; ?></p>
                </div>

                <?php
                    } else {
                        // CASO O PRODUTO NAO SEJA ENCONTRADO, APARECER ESSA MENSAGEM
                        echo "<h5>Produto não encontrado</h5>";
                    }
                } else {
                    // CASO O 'id' NAO SEJA PASSADO, APARECER ESA MENSAGEM
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
