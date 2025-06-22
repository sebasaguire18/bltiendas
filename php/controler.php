<?php


// error_reporting(0);  
include 'modelo.php';


$tipo = $_POST['tipo'];

// -----------------------------DATOS----------------------------- //

    if ($tipo == 'nuevaDato') {
        
        $datos = $_POST['datos'];
        
        if ($datos == "")  {
            $html = 'info';
            echo $html;
        }else {
            $nuevaDato=nuevaDato($datos);

            if ($nuevaDato === true) {
                $html = 'success';
                echo $html;
            }else {
                $html = 'error';
                echo $html;
            }
        }
    }

    if ($tipo == 'editarDato') {
        
        $datos = $_POST['datos'];
        
        if ($datos == "")  {
            $html = 'info';
            echo $html;
        }else {
            $editarDato=editarDato($datos);

            if ($editarDato === true) {
                $html = 'success';
                echo $html;
            }else {
                $html = 'error';
                echo $html;
            }
        }

    }

    if ($tipo == 'eliminarDato') {
        
        $idEliminar = $_POST['idEliminar'];
        
        $eliminarDato=eliminarDato($idEliminar);

        if ($eliminarDato === true) {
            $html = 'success';
            echo $html;
        }else {
            $html = 'error';
            echo $html;
        }

    }

    // ----------------------------- ENVIO DE DATOS DEL FORMULARIO DE CONTACTO ----------------------------- //
    if ($tipo == 'EnviarDatosContacto') {
        
        $emailContacto = $_POST['emailContacto'];
        $asuntoContacto = $_POST['asuntoContacto'];
        $mensajeContacto = $_POST['mensajeContacto'];
        
        $enviarDatosContacto=enviarDatosContacto($emailContacto, $asuntoContacto, $mensajeContacto);

        if ($enviarDatosContacto === true) {
            $html = 1;
            echo $html;
        }else {
            $html = 'error';
            echo $html;
        }

    }
    
// -----------------------------DATOS----------------------------- //