<?php
    require_once("Model/foro.php");
    require_once("Model/login.php");
    if(isset($_GET['action'])){
        if(isset($_GET['sesion'])){
            session_destroy();
            header("Location:index.php");
        }
        if(isset($_SESSION["usuario"])){
            if($_GET['action'] == 'index'){
                $tamanyo_paginas=6;
                $pagina=1;
                if(isset($_GET["pagina"])){
                    $pagina = $_GET["pagina"];
                }
                
                $empezar_desde = ($pagina-1) * $tamanyo_paginas;
                $foro = new Foro($enlaceBD);
                $foro->Seleccionar("1=1");
                $numeroFilas = $foro->TotalFilasConsulta();
                $foro->Seleccionar("1=1 LIMIT $empezar_desde,$tamanyo_paginas");
                $total_paginas = ceil($numeroFilas / $tamanyo_paginas);
                require_once('View/Foro/index.phtml');
            }
            if($_GET['action'] == 'comentario'){
                if (isset($_GET['id'])) {
                    $id_foro = $_GET['id'];
                    
                    if(isset($_POST['comentario_usuario'])){
                        $usuarioComent = new Login($enlaceBD);
                        $nombreUsuario = $_SESSION["usuario"];
                        $usuarioComent->Seleccionar("nombre_usuario = '$nombreUsuario'");
                        $usuarioComent->CargarDatos(0);
                        $idUsuario = $usuarioComent->getId();
                        $mensaje = $_POST['comentario_usuario'];
                        $foroComent = new Foro($enlaceBD,0,$idUsuario,null,null,$mensaje,$id_foro);
                        $foroComent->InsertarComentario(); 
                    }
                    $foro = new Foro($enlaceBD);
                    require_once('View/Foro/comentario.phtml');
                }else{
                    header("Location:index.php");
                }
                
            }
        }else{
            header("Location:index.php");
        }
        
    }else{
        header("Location:index.php?controller=foro&action=index");
    }
?>