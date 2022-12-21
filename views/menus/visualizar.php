<?php
require_once 'views/layout/header.php';
?>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Evaluación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php foreach($menus as $menu){ 
                    if(count($menu['hijos']) == 0){
                ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" onclick="show('<?=$menu["descripcion"]?>');"><?=$menu['nombre']?></a>
                        </li>
                <?php
                    }else{
                ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$menu['nombre']?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach($menu['hijos'] as $hijo){ ?>
                                    <li><a class="dropdown-item" href="#" onclick="show('<?=$hijo["descripcion"]?>');"><?=$hijo['nombre']?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                <?php
                    }
                }
                ?>
                    
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 p-5 m-5">
            <div id="descripcion">
        
            </div>
        </div>
    </div>
</div>

<script>
    let descripcion = document.getElementById("descripcion");
    function show(text){
        descripcion.innerHTML = "";
        let p = document.createElement('h1');
        var textnode = document.createTextNode(text);
        p.appendChild(textnode);
        descripcion.appendChild(p);
    }
</script>
    
<?php
require_once 'views/layout/footer.php';
?>