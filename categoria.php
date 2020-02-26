<?php
$categoria = new Categoria();
//Cadastro de Categoria
if (isset($_POST['cadastrar'])) :

    $descricao = $_POST['descricao'];
    $categoria->setDescricao($descricao);

    if ($categoria->insert()) {
?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Categoria Cadastrada com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Erro ao Cadastrar a Categoria! Entre em contato com o suporte!</h6>
            </div>
        </div>

    <?php }

endif;
// desativar categoria
if (isset($_POST['excluir'])) :

    $id = $_POST['id'];

    if ($categoria->desativar($id)) {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Categoria Excluida com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Erro ao Excluir a Categoria! Entre em contato com o suporte!</h6>
            </div>
        </div>

    <?php }

endif;
//Alerar de Categoria
if (isset($_POST['alterar'])) :

    $id = $_POST['text_id'];
    $descricao = $_POST['text_descricao'];
    $categoria->setDescricao($descricao);
    if ($categoria->update($id)) {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6 class="h6">Categoria alterada com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6 class="h6">Erro ao alterar Categoria! Entre em contato com o suporte!</h6>
            </div>
        </div>
<?php }

endif;
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categorias</h1>

    <div class="btn-toolbar mb-2 mb-md-0">

        <div class="btn-group mr-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cadastrar_categoria">Cadastrar Nova Categoria</button>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Categoria:</th>
                <th>Ação:</th>
            </tr>
        </thead>
        <?php
        $ordem = 'descricao';
        foreach ($categoria->findAll() as $key => $value) :
        ?>
            <tbody>
                <tr>
                    <td><?php echo $value->descricao; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_alterar_categoria" onclick="load_modal
                        ('<?php echo $value->descricao; ?>','<?php echo $value->id; ?>')">Alterar</button>
                        <form class="form_excluir" method="post" style="float: left; margin: 0 15px">
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                            <button name="excluir" type="submit"  class="btn btn-danger">Excluir</button>
                        </form>
                    </td>

                </tr>
            </tbody>
        <?php
        endforeach;
        ?>
    </table>
</div>
<!-- Modal Cadastrar Categoria -->
<div class="modal fade modal_cadastrar_categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-auto " method="post">
                    <div class="container">
                        <div class="row col-12">
                            <div class="col-2"></div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Descricao:</label>
                                    <input pattern="[a-zA-Z0-9]+" required="required" type="text" class="form-control" id="descricao" name="descricao">
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar">
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Alterar Categoria -->
<div class="modal fade modal_alterar_categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAlterar">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-auto " method="post">
                    <div class="container">
                        <div class="row col-12">
                            <div class="col-2"></div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Descricao:</label>
                                    <input type="text" class="form-control" id="text_descricao" name="text_descricao"  required="required">
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="hidden" name="text_id" id="text_id">
                                <input type="submit" name="alterar" class="btn btn-primary" value="Alterar">
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/categoria.js"></script>