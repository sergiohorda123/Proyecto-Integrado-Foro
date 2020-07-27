<?php
    require_once("Model/login.php");
    if(isset($_GET['action'])){
        if(isset($_GET['sesion'])){
            session_destroy();
            header("Location:index.php");
        }
        if(isset($_SESSION["usuario"])){
            if($_SESSION['rol'] == 0){
                if($_GET['action'] == 'index'){
                    $tamanyo_paginas=10;
                    $pagina=1;
                    if(isset($_GET["pagina"])){
                        $pagina = $_GET["pagina"];
                    }
                    $empezar_desde = ($pagina-1) * $tamanyo_paginas;
                    $usuario = new Login($enlaceBD);
                    $usuario->Seleccionar("1=1");
                    $numeroFilas = $usuario->TotalFilasConsulta();
                    $usuario->Seleccionar("1=1 LIMIT $empezar_desde,$tamanyo_paginas");
                    $total_paginas = ceil($numeroFilas / $tamanyo_paginas);
                    $usuario->Seleccionar("1=1");
                    require_once("View/Gestion_usuario/index.phtml");
                }elseif($_GET['action'] == 'ver'){
                    $usuario = new Login($enlaceBD);
                    if(isset($_GET['nombre'])){
                        $nombre = $_GET['nombre'];
                        $usuario->Seleccionar("nombre_usuario = '$nombre'");
                        require_once("View/Gestion_usuario/ver.phtml");
                    }else{
                        echo "<h1>No existe ese usuario con ese nombre</h1>";
                    }
                    
                }elseif($_GET['action'] == 'eliminar'){
                    $nombre = $_GET['nombre'];
                    $usuario = new Login($enlaceBD);
                    $usuario->Eliminar("nombre_usuario = '$nombre'");
                    header("Location:index.php?controller=admin&action=index");
                }
            }else{
                header("Location:index.php");
            }
            
        }else{
            header("Location:index.php");
        }
        
    }else{
        header("Location:index.php?controller=admin&action=index");
    }
?>