<?php
require_once 'views/layout/header.php';

if(isset($_SESSION['delete'])){
    if($_SESSION['delete']==="complete"){
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 mt-3">
                    <div class="alert alert-success" role="alert">
                        Menú eliminado
                    </div>
                </div>
            </div>
        </div>
<?php
    }else{
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 mt-3">
                    <div class="alert alert-danger" role="alert">
                        Error al eliminar el menú
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
Utils::deleteSession('delete');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="row bg-blue p-2">
                <div class="col-12 d-flex justify-content-between">
                    <div>
                        <h5 class="p-1 text-white">Menú</h5>
                    </div>
                    <div>
                    <form action="<?=base_url?>Menu/create" method="post">
                        <button type="submit" class="btn btn-success mx-3">+ Nuevo</button>
                    </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Menú Padre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($menus as $menu){ ?>
                            <tr>
                                <th scope="row"><?=$menu['id']?></th>
                                <td><?=$menu['nombre']?></td>
                                <td><?=$menu['menu']?></td>
                                <td><?=$menu['descripcion']?></td>
                                <td>
                                    <a type="button" class="btn btn-light" href="<?=base_url?>Menu/editar&id=<?=$menu['id']?>">
                                        <img src="<?=base_url?>assets/img/pen-solid.svg" alt="" width="15">
                                        Editar
                                    </a>
                                    <a type="button" class="btn btn-light" href="<?=base_url?>Menu/eliminar&id=<?=$menu['id']?>">
                                        <img src="<?=base_url?>assets/img/trash-solid.svg" alt="" width="12">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-6 my-5">
                    <a type="button" class="btn btn-dark" href="<?=base_url?>Menu/visualizar">Visualización de menús</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'views/layout/footer.php';
?>