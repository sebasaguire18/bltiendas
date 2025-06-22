<?php
    session_start();
    error_reporting(0);
    
    include 'includes/resources.php';

    if($_SESSION['id_user']){
        $idUserSession=$_SESSION['id_user'];

  	    header("location: welcome.php");

    }else{
?>

<!doctype html>
<html lang="es">
    <head>
        <title id="titlePageNS">Inicio</title>
        <?php include 'includes/link.php'; ?>
    </head>
    <body>
        <div id="app">
            <i class="ir-arriba fa fa-chevron-up shadow"></i>
            <i class="carrito fa fa-cart-plus shadow"></i>

            <?php include 'includes/nav.php'; ?>
        
            <div id="main">        
                <section id="contentNavNoSession">

                </section>
                
                <!-- Page Content  -->
                <div class="page-content" id="contentPrincipalNoSession">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-3">
                            <div id="preloder">
                                <div class="loader"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
        
        <?php include 'includes/script.php'; ?>
    
    <!-- modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b></b> Inicia sesión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center mt-2">
                        <form id="formInicioSesion">
                            <div class="form-floating mb-3">
                                <label for="usernameLoging">Email</label>
                                <input class="form-control" id="usernameLoging" type="text" placeholder="tunombre@correo.com" />
                                <div class="text-danger d-none" id="spanUserLoging"> Por favor ingresa un email valido</div>
                                <span class="text-danger d-none" id="spanUserLogingError">Email no encontrado</span>
                            </div>
                            <div class="form-floating mb-5">
                                <label for="passLoging">Contraseña</label>
                                <input class="form-control" id="passLoging" type="password" placeholder="*************" />
                                <div class="text-danger d-none" id="spanPassLoging">Por favor ingresa la contraseña</div>
                                <span class="text-danger d-none" id="spanPassLogingError">Contraseña erronea</span>
                            </div>
                            <a id="btnIniciarSesion" class="btn btn-lg btn-block btn-outline-primary mt-5">Iniciar sesión</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- fin modal -->    
    </body>
    
</html>

<?php
    }
?>