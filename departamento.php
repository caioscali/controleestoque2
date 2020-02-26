<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Departamentos</h1>

    <div class="btn-toolbar mb-2 mb-md-0">

        <div class="btn-group mr-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cadastrar_departamento">Cadastrar Novo Departamento</button>
        </div>
    </div>
</div>

<?php
$departamento = new Departamento();
//Cadastro de Departamento
if (isset($_POST['cadastrar'])) :

    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $departamento->setNome($nome);
    $departamento->setEmpresa($empresa);

    if ($departamento->insert()) {
?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Departamento Cadastrado com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Erro ao Cadastrar o Departamento! Entre em contato com o suporte!</h6>
            </div>
        </div>

    <?php }

endif;
// desativar Departamento
if (isset($_POST['excluir'])) :

    $id = $_POST['id'];

    if ($departamento->desativar($id)) {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Departamento Excluido com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Erro ao Excluir o Departamento! Entre em contato com o suporte!</h6>
            </div>
        </div>

    <?php }

endif;

//Alterar de Departamento
if (isset($_POST['alterar'])) :

    $id = $_POST['text_id'];
    $nome = $_POST['text_nome'];
    $empresa = $_POST['text_empresa'];
    $departamento->setNome($nome);
    $departamento->setEmpresa($empresa);

    if ($departamento->update($id)) {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-success col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Departamento Alterado com Sucesso!</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row col-12">
            <div class="col-3"></div>
            <div class="alert alert-danger col-4">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h6>Erro ao Alterar o Departamento! Entre em contato com o suporte!</h6>
            </div>
        </div>

<?php }
endif;
?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Departamento:</th>
                <th>Empresa:</th>
                <th>Ação:</th>
            </tr>
        </thead>
        <?php
        foreach ($departamento->findAll() as $key => $value) :
        ?>
            <tbody>
                <tr>
                    <td><?php echo $value->nome; ?></td>
                    <td><?php echo $value->empresa; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_alterar_departamento" onclick="load_modal('<?php echo $value->nome; ?>','<?php echo $value->empresa; ?>','<?php echo $value->id; ?>')">Alterar</button>
                        <form class="form_excluir" method="post" style="float: left; margin: 0 15px">
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                            <button name="excluir" type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>

                </tr>
            </tbody>
        <?php
        endforeach;
        ?>
    </table>
</div>
<!-- Modal Cadastrar Departamento-->
<div class="modal fade modal_cadastrar_departamento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro Departamento</h5>
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
                                    <label>Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome"  required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Empresa:</label>
                                    <input type="text" class="form-control" id="empresa" name="empresa"  required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-5"></div>
                        <div class="col-4">
                            <input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar">
                            <div class="col-4"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Alterar Departamento -->
<div class="modal fade modal_alterar_departamento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAlterar">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro Departamento</h5>
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
                                    <label>Nomeoi:</label>
                                    <input type="text" class="form-control" id="text_nome" name="text_nome">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Empresa:</label>
                                    <input type="text" class="form-control" id="text_empresa" name="text_empresa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-5"></div>
                        <div class="col-4">
                            <input type="hidden" name="text_id" id="text_id">
                            <input type="submit" name="alterar" class="btn btn-primary" value="Alterar">
                            <div class="col-4"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/departamento.js"></script>