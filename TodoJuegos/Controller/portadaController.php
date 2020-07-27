<?php
    require_once("Model/noticia.php");
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
                $noticias = new Noticia($enlaceBD);
                $noticias->Seleccionar("1=1");
                $numeroFilas = $noticias->TotalFilasConsulta();
                $noticias->Seleccionar("1=1 LIMIT $empezar_desde,$tamanyo_paginas");
                $total_paginas = ceil($numeroFilas / $tamanyo_paginas);
                require_once('View/Portada/index.phtml');
            }
            if($_GET['action'] == 'noticia'){
                $noticias = new Noticia($enlaceBD);
                $noticias->Seleccionar("nombre_noticia = '" . $_GET['nombre_noticia'] . "'");
                require_once('View/Portada/noticia.phtml');
            }
        }else{
            header("Location:index.php");
        }
        
    }else{
        header("Location:index.php?controller=portada&action=index");
    }
?>