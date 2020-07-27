<?php
    require_once("Model/chat.php");
    if(isset($_GET['action'])){
        if(isset($_GET['sesion'])){
            session_destroy();
            header("Location:index.php");
        }
        if(isset($_SESSION["usuario"])){
            if($_GET['action'] == 'index'){
                if(isset($_GET['sala'])){
                    $sala = $_GET['sala'];
                    if(isset($_POST['btn-enviar'])){
                        if(isset($_POST['mensaje'])){
                            $hora = date("H:i:s d.m");
                            $mensaje = new Chat($enlaceBD,null,$_POST['mensaje'],$hora,$_SESSION['usuario'],$sala);
                            $mensaje->Insertar();
                        }
                    }
                    require_once("View/Chat/index.phtml");
                }else{
                    echo "<h1 class='text-center text-white'>Esta sala no existe</h1>";
                }
            }
        }else{
            header("Location:index.php");
        }
        
    }else{
        header("Location:index.php?controller=chat&action=index");
    }
?>