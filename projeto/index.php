<!-- //REALIZA A CONEÇÃO COM O BANCO DE DADOS  -->
<?php
session_start();
require 'conexao.php';
?>

<!--INICIO DA ESTRUTURA HTML -->
<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- //TITULO DO SITE -->
    <title>Estoque</title>

  </head>

  <body class="bg-dark">

    <!-- //CHAMA O ARQUIVO 'navbar.php' PARA ESSE CODIGO -->
    <?php include('navbar.php') ?>

    <div class="container mt-4">

        <!-- //CHAMA O ARQUIVO 'mensagem.php' PARA ESSE CODIGO -->
        <?php include('mensagem.php'); ?>

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <!-- //TITULO DA PAGINA JUNTO COM O BOTÃO DE ADICIONAR UM PRODUTO -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Lista de Produtos</h4>
                        <a href="adicionar-produto.php" class="btn btn-dark">Adicionar Produto</a>
                    </div>

                    <div class="card-body">

                        <!-- //CRIAÇÃO DA TABELA -->
                        <table class="table table-bordered table-striped">

                            <!-- //TABELA ONDE VAI FICAR OS TITULOS DE CADA PARTE DA TABELA -->
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

                                <!-- //COMANDO EM SQL PARA VERIFICAR TODOS OS ITENS DA TEBALA 'produtos' NO BANCO DE DADOS -->
                                <?php 
                                $sql = 'SELECT * FROM produtos';
                                // FAZ UMA REQUESIÇÃO PARA O BANCO DE DADOS COM ESSE COMANDO ACIMA
                                $produtos = mysqli_query($conexao,$sql);
                                //LOOP PARA VERIFICAR SE NO BANCO DE DADOS EM ALGUMA LINHA COM PRODUTO, SE TIVER VAI SER ARMAZENADO NA VARIAVEL TEMPORARIA '$produto'
                                if(mysqli_num_rows($produtos) > 0){
                                    foreach($produtos as $produto){
                                ?>

                                <!-- //TABELA ONDE IRA APARECER TODOS OS PRODUTOS ARMAZENADOS -->
                                <tr>
                                    <td> <?= $produto['idproduto'] ?> </td>
                                    <td> <?= $produto['tipoProduto'] ?> </td>
                                    <td> <?= $produto['marcaProduto'] ?> </td>
                                    <td> <?= $produto['modeloProduto'] ?> </td>
                                    <td>
                                        <!-- //BOTÃO DE VIZUALIZAR -->
                                        <a href="ver-produto.php?id=<?= $produto['idproduto'] ?>" class="btn btn-primary btn-sm me-5">Vizualizar</a>
                                        <!-- //BOTÃO DE EDITAR -->
                                        <a href="editar-produto.php?idproduto=<?= $produto['idproduto'] ?>" class="btn btn-secondary btn-sm me-2">Editar</a>

                                        <!-- //BOTÃO PARA EXCLUIR -->
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
                                //SE NAO ESTIVER NENHUM PRODUTO ARMAZENADO, VAI APARECER ESSA MENSAGEM NA TELA    
                                }else{
                                    echo '<h5> nenhum produto adicionado</h5>';
                                }
                                ?>
                            </tbody>

                        </table> <!-- FECHAMENTO DA TABELA -->

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

</html> <!-- //FINAL DA ESTRUTURA HTML -->