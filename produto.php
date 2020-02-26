<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Produtos</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cadastrar_produto">Cadastrar Novo Produto</button>
        </div>
    </div>
</div>

<?php
$produto = new Produto();
$departamento = new Departamento();
$categoria = new Categoria();
$departamentoproduto = new DepartamentoProduto();

//Cadastro de Departamento
if (isset($_POST['cadastrar'])) :

    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $numeroPatrimonio = $_POST['numeroPatrimonio'];
    $idCategoria = $_POST['categoriaSelecionada'];
    $idDeparteamento = $_POST['departamentoSelecionado'];
    $quantidade = $_POST['quantidade'];

    $produto->setDescricao($descricao);
    $produto->setMarca($marca);
    $produto->setNumeroPatrimonio($numeroPatrimonio);
    $produto->setIdCategoria($idCategoria);

    if ($idProduto = $produto->insert()) {
        $departamentoproduto->setQuantidade($quantidade);
        $departamentoproduto->setIdProduto($idProduto);
        $departamentoproduto->setIdDepartamento($idDeparteamento);

        if ($departamentoproduto->insert()) {
?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-success col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Produto Cadastrado com Sucesso!</h6>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-danger col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Erro ao Cadastrar o Produto! Entre em contato com o suporte!</h6>
                </div>
            </div>

        <?php }
    }

endif;
// desativar Departamento
if (isset($_POST['excluir'])) :

    $id = $_POST['id'];

    if ($produto->desativar($id)) {
        ?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-success col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Produto Excluido com Sucesso!</h6>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-danger col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Erro ao Excluir o Produto! Entre em contato com o suporte!</h6>
                </div>
            </div>
        <?php }

endif;

//Alterar de Departamento
if (isset($_POST['alterar'])) :
    $id = $_POST['text_id'];
    $descricao = $_POST['text_descricao'];
    $marca = $_POST['text_marca'];
    $numeroPatrimonio = $_POST['text_numeroPatrimonio'];
    $idCategoria = $_POST['text_categoriaSelecionada'];
    $idDeparteamento = $_POST['text_departamentoSelecionado'];
    $quantidade = $_POST['text_quantidade'];
    $idDepartamentoProduto = $_POST['text_idDepartamentoProduto'];
    $dataCadastro = $_POST['text_dataCadastro'];

    $produto->setDescricao($descricao);
    $produto->setMarca($marca);
    $produto->setNumeroPatrimonio($numeroPatrimonio);
    $produto->setIdCategoria($idCategoria);
    $produto->update($id);
    if ($produto->update($id)) {
        $departamentoproduto->setQuantidade($quantidade);
        $departamentoproduto->setIdProduto($id);
        $departamentoproduto->setIdDepartamento($idDeparteamento);
        $departamentoproduto->setDataCadastro($dataCadastro);

        if ($departamentoproduto->update($idDepartamentoProduto)) {
        ?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-success col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Produto Alterado com Sucesso!</h6>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row col-12">
                <div class="col-3"></div>
                <div class="alert alert-danger col-4">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h6>Erro ao Alterar o Produto! Entre em contato com o suporte!</h6>
                </div>
            </div>

<?php }
    }

endif;
?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Descricao:</th>
                <th>Marca:</th>
                <th>Número de Patrimônio:</th>
                <th>Categora:</th>
                <th>Quantidade:</th>
                <th>Data Cadastro:</th>
                <th>Departamento:</th>
                <th>Empresa:</th>
                <th>Ação:</th>
            </tr>
        </thead>
        <?php
        foreach ($produto->findAllProdutos() as $key => $value) :
        ?>
            <tbody>
                <tr>
                    <td><?php echo $value->descricao; ?></td>
                    <td><?php echo $value->marca; ?></td>
                    <td><?php echo $value->numeroPatrimonio; ?></td>
                    <td><?php echo $value->categoria; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_alterar_produto" onclick="load_modal('<?php echo $value->descricao; ?>','<?php echo $value->marca; ?>',
                         '<?php echo $value->numeroPatrimonio; ?>',
                         '<?php echo $value->idCategoria; ?>',
                         '<?php echo $value->quantidade; ?>',
                         '<?php echo $value->dataCadastro; ?>',
                         '<?php echo $value->idDepartamento; ?>',
                         '<?php echo $value->id; ?>',
                         '<?php echo $value->idDepartamentoProduto; ?>')">Alterar</button>
                        <form class="form_excluir" method="post" style="float: left; margin: 0 15px">
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                            <button name="excluir" type="submit"  class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php
        endforeach; ?>
    </table>
</div>
<!-- Modal Cadastro Produto -->
<div class="modal fade modal_cadastrar_produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-auto " method="post">
                    <div class="container">
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Departamento:</label>
                                    <select class="form-control" name="departamentoSelecionado" required="required">
                                        <?php
                                        foreach ($departamento->findAll() as $key => $val) : ?>
                                            <option value="<?php echo ($val->id); ?>"> <?php echo $val->nome . ' - ', $val->empresa; ?> </option>
                                        <?php
                                        endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Categoria:</label>
                                    <select class="form-control" name="categoriaSelecionada" required="required">
                                        <?php
                                        foreach ($categoria->findAll() as $key => $val) : ?>
                                            <option value="<?php echo ($val->id); ?>"> <?php echo $val->descricao; ?> </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label></label>
                                    <a type="submit" class="btn btn-primary" href="departamentos">Cadastrar Departamento</a>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label></label>
                                    <a type="submit" class="btn btn-primary" href="categorias">Cadastrar Categoria</a>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Descricao:</label>
                                    <input type="text" class="form-control" name="descricao" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Marca:</label>
                                    <input type="text" class="form-control" name="marca" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Número de Patrimonio:</label>
                                    <input type="text" class="form-control" name="numeroPatrimonio" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Quantidade:</label>
                                    <input type="text" class="form-control" name="quantidade"  pattern="[0-9]+" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-5"></div>
                            <div class="col-4">
                                <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Alterar Produto -->
<div class="modal fade modal_alterar_produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-auto " method="post">
                    <div class="container">
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Departamento:</label>
                                    <select class="form-control" id="text_departamentoSelecionado" name="text_departamentoSelecionado" required="required">
                                        <option>Selecione o Departamento</option>
                                        <?php
                                        foreach ($departamento->findAll() as $key => $val) : ?>
                                            <option value="<?php echo ($val->id); ?>"> <?php echo $val->nome . ' - ', $val->empresa; ?> </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Categoria:</label>
                                    <select class="form-control" id="text_categoriaSelecionada" name="text_categoriaSelecionada" required="required">
                                        <option>Selecione a Categoria</option>
                                        <?php
                                        foreach ($categoria->findAll() as $key => $val) : ?>
                                            <option value="<?php echo ($val->id); ?>"> <?php echo $val->descricao; ?> </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label></label>
                                    <a type="submit" class="btn btn-primary" href="departamentos">Cadastrar Departamento</a>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label></label>
                                    <a type="submit" class="btn btn-primary" href="categorias">Cadastrar Categoria</a>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Descricao:</label>
                                    <input type="text" class="form-control" id="text_descricao" name="text_descricao" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Marca:</label>
                                    <input type="text" class="form-control" id="text_marca" name="text_marca" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Número de Patrimonio:</label>
                                    <input type="text" class="form-control" id="text_numeroPatrimonio" name="text_numeroPatrimonio" required="required">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Quantidade:</label>
                                    <input type="text" class="form-control" id="text_quantidade" name="text_quantidade" pattern="[0-9]+" required="required">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Data Cadastro:</label>
                                    <input type="text" class="form-control" id="text_dataCadastro" name="text_dataCadastro" pattern="\d{2}/\d{2}/\d{4}$" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-5"></div>
                            <div class="col-4">
                                <input type="hidden" name="text_id" id="text_id">
                                <input type="hidden" name="text_idDepartamentoProduto" id="text_idDepartamentoProduto">
                                <input type="submit" name="alterar" class="btn btn-primary" value="Alterar">
                            </div>
                            <div class="col-4"></div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/produto.js"></script>