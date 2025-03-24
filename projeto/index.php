<?php
session_start();
require 'conexao.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Estoque</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Lista de Produtos</h4>
                        <a href="adicionar-produto.php" class="btn btn-dark">Adicionar Produto</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>OPÇÔES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = 'SELECT * FROM produtos';
                                $produtos = mysqli_query($conexao,$sql);
                                if(mysqli_num_rows($produtos) > 0){
                                    foreach($produtos as $produto){
                                ?>
                                <tr>
                                    <td> <?= $produto['idproduto'] ?> </td>
                                    <td> <?= $produto['tipoProduto'] ?> </td>
                                    <td> <?= $produto['marcaProduto'] ?> </td>
                                    <td> <?= $produto['modeloProduto'] ?> </td>
                                    <td>
                                        <a href="ver-produto.php?id=<?= $produto['idproduto'] ?>" class="btn btn-primary btn-sm me-5">Vizualizar</a>
                                        <a href="editar-produto.php?idproduto=<?= $produto['idproduto'] ?>" class="btn btn-secondary btn-sm me-2">Editar</a>

                                        <button type="button" class="btn btn-danger btn-sm me-2" data-toggle="modal" data-target="#confirmModal<?= $produto['idproduto'] ?>">
                                            Excluir
                                        </button>

                                        <div class="modal fade" id="confirmModal<?= $produto['idproduto'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel<?= $produto['idproduto'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel<?= $produto['idproduto'] ?>">Confirmar Exclusão</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Quer mesmo deletar o produto <strong><?= $produto['modeloProduto'] ?></strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="acoes.php" method="POST" class="d-inline">
                                                            <button type="submit" name="deletar-produto" value="<?= $produto['idproduto'] ?>" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }else{
                                    echo '<h5> nenhum produto adicionado</h5>';
                                }
                                ?>
                            </tbody>
                        </table>
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