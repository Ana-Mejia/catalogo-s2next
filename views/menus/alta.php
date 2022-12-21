<?php
require_once 'views/layout/header.php';

if(isset($_SESSION['register'])){
    if($_SESSION['register']==="complete"){
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 mt-3">
                    <div class="alert alert-success" role="alert">
                        ¡Registro exitoso!
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
                        El Registro falló. Introduce correctamente los datos.
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
Utils::deleteSession('register');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="row bg-blue mt-3 p-2">
                <div class="col-12">
                    <?php if(isset($editar) && isset($menu_find) && is_object($menu_find)): 
                        $url_action = base_url."Menu/store&id=".$menu_find->id; ?>
                        <h5 class="text-white">Editar menú: <?=$menu_find->nombre?></h5>
                    <?php else: 
                        $url_action = base_url."Menu/store"; ?>
                        <h5 class="text-white">Alta de menú</h5>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-12">
                    <form action="<?=$url_action?>" method="post">
                        <div class="row mb-3">
                            <label for="inputFather" class="col-sm-2 col-form-label text-right">Menú Padre</label>
                            <div class="col-sm-6">
                                <select id="inputFather" class="form-select" name="menu_id">
                                    <option value="0" selected>Seleccione una opción</option>
                                    
                                <?php foreach($menus as $menu){ 
                                    if(!isset($menu_find)){ ?>
                                        <option value="<?=$menu['id']?>"><?=$menu['nombre']?></option>
                                <?php 
                                    }else if(isset($menu_find) && $menu['id']!==$menu_find->menu_id){ ?>
                                        <option value="<?=$menu['id']?>" <?=isset($menu_find) && is_object($menu_find) && $menu['id']==$menu_find->menu_id ? 'selected' : '';?>><?=$menu['nombre']?></option>
                                <?php
                                    }else{
                                        //
                                    }
                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputName" class="col-sm-2 col-form-label text-right">Nombre</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputName" name="nombre" value="<?=isset($menu_find) && is_object($menu_find) ? $menu_find->nombre : ''; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDescription" class="col-sm-2 col-form-label text-right">Descripcion</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="inputDescription" name="descripcion"><?=isset($menu_find) && is_object($menu_find) ? $menu_find->descripcion : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?=base_url?>" type="button" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'views/layout/footer.php';
?>